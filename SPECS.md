# LC Football — Specifica Tecnica (Spec-Driven)

| Campo | Valore |
|---|---|
| **Versione doc** | 1.2.0 |
| **Stato** | Draft — approvato per implementazione |
| **Ultimo aggiornamento** | 2026-08-03 |
| **Plugin** | lc-football v0.3.0 (target) |
| **Responsabile** | — |

Questo documento è una **specifica spec-driven**: definisce requisiti funzionali testabili (con criteri di accettazione), il modello dati definitivo, i contratti di ogni componente e le regole di integrità. Guida l'implementazione fase per fase: un requisito si considera **done** solo quando i suoi criteri di accettazione passano.

> **Storico del documento**
> - 1.2.0 (2026-08-03): raffinamento production-ready per lo usecase. Nuovo FR-26 (rigori decisivi con conteggio, D-14), forfait fuori scope (D-15), parametro `include_cup` (chiusa contraddizione AC-14.4/§7.1), sezione §6.7 validazione input, §8.5 catalogo messaggi, stack UI admin (Tom Select self-hosted + vanilla ES6, D-16), sezione Info completa in §8.2, contratto import rigori (CSV/Open Football/SportsPress), NFR estesi, roadmap riformulata come fasi di delivery pure.
> - 1.1.0 (2026-08-03): revisione di completezza/coerenza. Nuove decisioni D-10…D-13: colonna `outcome_override`, FR-12 esteso ai cartellini, parametri shortcode morti rimossi, FK di §5 allineate alla matrice §6.4. Aggiunti AC-05.5 (blocco duplicati), AC-05.6 (gol azzerati fuori da `played`), AC-12.5 (derivazione risultato dagli eventi), contratti §7 per `lc_match_day` e `lc_calendar`.
> - 1.0.0 (2026-08-03): riscrittura spec-driven. Decisioni confermate: Pt lordo/Pen/Pt Netto, autogol sotto la squadra che beneficia, nuova tabella `lc_match_cards`, cancellazioni RESTRICT, timezone UTC (migrazione v0.4.0), sync eventi→totali.
> - 0.x (2026-07-24): versione descrittiva iniziale.

---

## Indice

1. [Obiettivi e non-obiettivi](#1-obiettivi-e-non-obiettivi)
2. [Performance budget](#2-performance-budget)
3. [Terminologia](#3-terminologia)
4. [Requisiti funzionali](#4-requisiti-funzionali)
5. [Modello dati](#5-modello-dati)
6. [Regole di integrità e coerenza](#6-regole-di-integrità-e-coerenza)
7. [Contratti shortcode e widget](#7-contratti-shortcode-e-widget)
8. [Contratto admin](#8-contratto-admin)
9. [Contratti import](#9-contratti-import)
10. [Requisiti non funzionali](#10-requisiti-non-funzionali)
11. [Piano di test](#11-piano-di-test)
12. [Deploy e rollback](#12-deploy-e-rollback)
13. [Decision log](#13-decision-log)
14. [Roadmap](#14-roadmap)

---

## 1. Obiettivi e non-obiettivi

### 1.1 Obiettivo

Sostituire SportsPress in un sito editoriale calcistico con un plugin WordPress custom a **tabelle normalizzate**, **query SQL aggregate** e **zero loop PHP su dataset completi**, eliminando picchi di RAM fino a 1.5 GB in homepage.

### 1.2 Obiettivi misurabili

- Homepage con i 6 widget attivi: **≤ 8 query totali** verso tabelle LC.
- **≤ 50 ms** di tempo DB cumulato per la homepage.
- **≤ 30 MB** RAM aggiuntiva per page load.
- Zero `get_posts()`/`WP_Query` sulle tabelle LC nel frontend. Solo `$wpdb->prepare()`.
- Coesistenza totale con SportsPress: LC Football non legge, modifica o elimina mai i dati SP.

### 1.3 Non-obiettivi (fuori MVP)

- Gestione **staff tecnico** (exclusa per scelta — opzione futura).
- Cronologia trasferimenti persistente (`lc_player_transfers` rinviata; il cambio squadra aggiorna solo `lc_players.team_id`).
- Multi-lingua (solo `.pot` generato, stringhe UI in italiano).
- PWA, App, REST API pubblica, webhook.
- Gestione arbitri / dirigenti.
- Statistiche avanzate per giocatore oltre a gol/assist/cartellini/minuti.
- **Risultati a tavolino / forfait** (status dedicato): un eventuale "0-3 a tavolino" si registra come risultato normale (`played`, gol 0-3).
- **Pagine archive del sito** (dettaglio giocatore/squadra/partita, slug, permalink): il plugin espone **solo widget Elementor e shortcode**, nessuna pagina pubblica proprietaria.

### 1.4 Principi guida

| Principio | Regola |
|---|---|
| Tabelle normalizzate | Dati in colonne tipizzate, mai EAV, mai serializzazione PHP in DB |
| Aggregazioni in SQL | Le query aggreganti girano in MySQL, non in PHP |
| Storico immutabile | Cambiare squadra/giocatore non altera i dati dei match passati |
| Idempotenza import | Ripetere un import non produce duplicati |
| Sicurezza dati | Nessuna cancellazione a cascata implicita: sempre RESTRICT o conferma |

---

## 2. Performance budget

Definizione di **SRP** (System & Performance Requirements) da verificare in Fase 6/7.

| Metrica | Budget | Come si misura |
|---|---|---|
| Query frontend (6 widget) | ≤ 8 | `Query Monitor` / `$wpdb->num_queries` |
| Tempo DB homepage | ≤ 50 ms | log lento / QM |
| RAM aggiuntiva | ≤ 30 MB | `memory_get_peak_usage()` delta |
| Tempo migrazione SP (769 partite) | ≤ 5 min | cronometro admin |
| Peak RAM migrazione | ≤ 256 MB | misura in contesto migrazione |

**Vincoli architetturali:**
- Nessun loop PHP su più di 100 righe di tabella LC.
- Le classi di calcolo (`Standings`, `Top_Scorers`) devono fare **1 query SQL aggregate** + al più **1 query ausiliaria** (penalità/marcatori-rigori), mai query per-riga.
- Nessun caching obbligatorio: i dati sono ricalcolati live. Il caching opzionale (transient) è un'ottimizzazione successiva e deve avere invalidation su save.

---

## 3. Terminologia

| Termine | Definizione |
|---|---|
| **League** | Campionato/competizione (Serie A, Coppa Italia). |
| **Season** | Stagione (2026-2027). |
| **Match type** | `league`, `friendly`, `playoff`, `playout`, `cup`. |
| **Outcome** | Esito lato squadra: `win`, `draw`, `loss`, `NULL`. |
| **Giornata** | Numero positivo di turno campionato; `0` per amichevoli/playoff/coppa. |
| **Rinvio** | Match `postponed` con `original_date` = data originale. |
| **Pt lordo** | Punti calcolati dai risultati (3/1/0), senza penalità. |
| **Pt netto** | Pt lordo − penalità. |
| **Beneficia** | Squadra che riceve il punto a favore (per un autogol è l'avversario del marcatore). |
| **Rigori decisivi (dcr)** | Serie di tiri dal dischetto dopo 120' in parità (match a eliminazione). I tiri **non** sono gol: non entrano in `lc_match_goals`, non contano per marcatori/carriera; determinano solo il vincente per il passaggio del turno. |

---

## 4. Requisiti funzionali

Ogni FR ha criteri di accettazione (Given/When/Then). Un FR è **done** quando tutti i criteri passano.

### FR-01 — Gestione campionati
**Dato** l'admin, posso creare/modificare/eliminare campionati (nome, slug auto da nome).
- **AC-01.1** Creando "Serie A" lo slug è `serie-a`.
- **AC-01.2** Due campionati non possono avere lo stesso slug.
- **AC-01.3** L'eliminazione di un campionato con partite collegate è **RESTRICT**: fallisce con messaggio chiaro.

### FR-02 — Gestione stagioni
Come FR-01 per `lc_seasons` (nome "2026-2027", slug auto). Stesse regole RESTRICT.

### FR-03 — Gestione squadre
- **AC-03.1** Campo `home_venue` salvato; usato come default per i match (FR-08).
- **AC-03.2** Flag `auto_created` visibile in lista; pagina "Rivedi auto-create" (FR-24).
- **AC-03.3** Eliminazione RESTRICT se la squadra ha match o giocatori (FR-25).

### FR-04 — Gestione giocatori e ruoli
- **AC-04.1** Ruoli normalizzati in `lc_positions` (Portiere, Difensore, Centrocampista, Attaccante).
- **AC-04.2** `birth_date` opzionale (DATE NULL).
- **AC-04.3** Slug univoco; in caso di collisione al salvataggio manuale l'utente è avvisato.

### FR-05 — Gestione partite (form completo)
Il form partita ha tre sezioni:
1. **Info**: league, season, match_type, data/ora, giornata, squadre, stadio, status, note.
2. **Risultato**: gol casa/ospite, outcome (auto o override — FR-06).
3. **Tabellino**: statistiche per giocatore (3A) + eventi gol (3B) + cartellini (3C).
- **AC-05.1** Se status = `postponed`, il form mostra "Nuova data" e "Data originale" (readonly).
- **AC-05.2** Gol validi solo se status = `played` (0 ≤ gol ≤ 99).
- **AC-05.3** Il salvataggio delle sezioni 3A/3B/3C avviene **in una transazione**; un errore non lascia dati parziali.
- **AC-05.4** Il pulsante "Importa da formazione" popola 11 titolari (fase 3 roadmap).
- **AC-05.5** Al salvataggio manuale, una partita con la stessa coppia `(league_id, season_id, home_team_id, away_team_id, match_date)` già esistente è **bloccata** con messaggio esplicito (stessa regola del dedup import, AC-21.3). *(roadmap fase 1)*
- **AC-05.6** Portando lo status da `played` a `scheduled`/`postponed`, `home_goals`/`away_goals`/`home_outcome`/`away_outcome`/`outcome_override` vengono **azzerati** (eventi `lc_match_goals`/`lc_match_cards` e tabellino `lc_match_players` restano invariati). Al ritorno a `played` con `outcome_override=0`, risultato e totali sono ricalcolati dagli eventi (FR-12 AC-12.5). *(roadmap fase 1)*

### FR-06 — Calcolo outcome e override
- **AC-06.1** Con gol inseriti e `outcome_override = 0` (auto), l'outcome è calcolato da `calculate_outcome` (win/draw/loss per entrambe le squadre) e salvato in `home_outcome`/`away_outcome`.
- **AC-06.2** L'override manuale (dropdown) imposta `outcome_override = 1`: l'outcome scelto persiste e **non** viene ricalcolato ai salvataggi successivi, anche se i gol cambiano. Riportando su "auto" si imposta `outcome_override = 0`, si ricalcola dai gol correnti. *(UI in roadmap fase 2; colonna nel modello v0.3.0)*
- **AC-06.3** Con `home_goals`/`away_goals` NULL l'outcome è NULL e `outcome_override` è forzato a 0.

### FR-07 — Ciclo di vita del rinvio
```
1. scheduled:    status='scheduled',  match_date=T0, original_date=NULL
2. posticipata:  status='postponed',  match_date=T0, original_date=T0
3. riprogrammata: status='scheduled', match_date=T1, original_date=T0
4. confermata:   status='played',     match_date=T1, original_date=T0
```
- **AC-07.1** Impostando status `postponed` la `original_date` viene auto-valorizzata con la data precedente se vuota. *(roadmap fase 2)*
- **AC-07.2** I widget trattano i postponed come da §7.7.
- **AC-07.3** I rinvii NON compaiono in "ultima partita" e sono esclusi da "prossima partita" di default.
- **AC-07.4** Qualsiasi transizione verso `scheduled`/`postponed` azzera gol/outcome (AC-05.6); lo step 4 mantiene l'`original_date` come dato informativo.

### FR-08 — Stadio auto-fill
- **AC-08.1** Selezionando la squadra casa, `venue` si precompila con `lc_teams.home_venue`.
- **AC-08.2** Il campo resta modificabile manualmente. *(roadmap fase 2)*

### FR-09 — Statistiche per partita (`lc_match_players`)
Un record per giocatore sceso in campo. Colonne: gol, autogol, assist, gialli, rossi, minuti, titolare.
- **AC-09.1** `team_id` = squadra **storica** del giocatore in quella partita (non quella attuale).
- **AC-09.2** `UNIQUE(match_id, player_id)`: un giocatore una sola riga per partita.
- **AC-09.3** Un giocatore con trasferimento successivo mantiene i suoi record storici (FR-20).

### FR-10 — Eventi gol (`lc_match_goals`)
- **AC-10.1** Ogni evento ha `minute` (testo: "23", "45+2", "90+4") e `goal_type` limitato a `open_play`, `penalty`, `free_kick`, `own_goal`.
- **AC-10.2** `goal_type` non può assumere valori di cartellino (vincolo CHECK).
- **AC-10.3** L'autogol è un evento del giocatore che lo ha commesso, ma conta come gol per l'avversario.

### FR-11 — Cartellini (`lc_match_cards`)
Tabella separata dagli eventi gol.
- **AC-11.1** Ogni cartellino ha `card_type` ∈ {`yellow`, `red`} e `minute`.
- **AC-11.2** I totali in `lc_match_players.yellow_cards`/`red_cards` sono sincronizzati dagli eventi cartellino quando presenti (FR-12 AC-12.4); in assenza di eventi restano i totali manuali.
- **AC-11.3** I cartellini NON compaiono mai nella lista marcatori né in "ultima partita" come gol.

### FR-12 — Sync totali gol e cartellini da eventi
- **AC-12.1** Al salvataggio di un match, se esistono eventi gol per quel match, `lc_match_players.goals` = numero eventi non-autogol e `own_goals` = numero autogol, per ogni giocatore coinvolto.
- **AC-12.2** Se un giocatore ha totali manuali ma nessun evento, i totali restano quelli manuali.
- **AC-12.3** La sincronizzazione avviene nella stessa transazione del salvataggio.
- **AC-12.4** Simmetria cartellini: se esistono eventi in `lc_match_cards` per il match, `lc_match_players.yellow_cards`/`red_cards` sono ricalcolati dagli eventi (count per giocatore per tipo), sempre nella stessa transazione; in assenza di cartellini restano i totali manuali. *(roadmap fase 1)*
- **AC-12.5** Derivazione risultato: con `status='played'` e `outcome_override=0`, se il match ha eventi gol, `home_goals`/`away_goals` sono ricalcolati dagli eventi (gol per squadra; gli autogol contano per la squadra che beneficia). Senza eventi, il risultato resta quello manuale. *(completa AC-05.6: il ritorno a `played` ripristina risultato e totali dagli eventi)* *(roadmap fase 1)*

### FR-13 — Penalità di punti
- **AC-13.1** Una penalità è legata a team + league + season, punti > 0, motivo, data.
- **AC-13.2** In classifica: `Pt lordo − penalità = Pt netto`. Colonne mostrate: `Pt`, `Pen`, `Pt Netto`.
- **AC-13.3** La penalità può rendere il netto negativo (valori interi con segno).

### FR-14 — Prossima partita (`[lc_next_match]`)
- **AC-14.1** Mostra il match futuro più vicino (data/ora, squadre, stadio; "giorni mancanti" in fase 2).
- **AC-14.2** Esclude postponed di default; `include_postponed="yes"` li include con etichetta "Posticipata" + data originale.
- **AC-14.3** Stato vuoto: messaggio "Nessuna partita in programma".
- **AC-14.4** Amichevoli, playoff/playout e coppe inclusi solo con flag espliciti (`include_friendly`, `include_postseason`, `include_cup`); default esclusi.

### FR-15 — Ultima partita (`[lc_last_match]`)
Layout speculare: marcatori casa a sinistra, ospiti a destra.
- **AC-15.1** Mostra l'ultima partita giocata (status `played`) con risultato.
- **AC-15.2** Marcatori da `lc_match_goals` con minuto e tipo; "(R)" per rigore, "(autogol)" per autogol.
- **AC-15.3** Un autogol è mostrato **sotto la squadra che beneficia** (es. autogol di un ospite appare lato casa), con il nome del giocatore che l'ha commesso.
- **AC-15.4** Fallback: senza eventi, mostra i totali da `lc_match_players` (senza minuti/tipo).
- **AC-15.5** Stato vuoto: "Nessuna partita giocata".

### FR-16 — Classifica (`[lc_league_table]`)
- **AC-16.1** Colonne: Pos, Squadra, PG, V, N, P, GF, GS, DR, Pt.
- **AC-16.2** Con `show_penalties="yes"`: colonne aggiuntive Pen e Pt Netto; `Pt` resta il lordo.
- **AC-16.3** Ordinamento: **Pt (netto) → DR → GF**; a parità di tutto, stessa posizione (competition ranking 1,1,3).
- **AC-16.4** Conta solo match `status='played'` e `match_type='league'`.
- **AC-16.5** Una query SQL aggregata; penalità in una seconda query; assemblaggio e ordinamento in PHP.
- **AC-16.6** Squadre senza partite giocate non compaiono (HAVING played > 0).

### FR-17 — Classifica marcatori (`[lc_top_scorers]`)
- **AC-17.1** Colonne: Pos, Giocatore, Squadra, Gol. `show_penalties="yes"` aggiunge colonna "di cui R".
- **AC-17.2** Gli autogol NON contano come gol; i rigori sì. Il conteggio rigori viene **esclusivamente dagli eventi** `lc_match_goals` con `goal_type='penalty'` (per i soli giocatori in classifica): se il match ha solo totali manuali senza eventi, il rigore è 0 (limite documentato).
- **AC-17.3** La squadra mostrata è quella **attuale** del giocatore (dato informativo; lo storico resta in `lc_match_players.team_id`).
- **AC-17.4** Ordina per gol decrescenti; a pari gol, stesso numero di posizione.

### FR-18 — Giornata (`[lc_match_day]`)
- **AC-18.1** Mostra le partite di una giornata con risultato (giocate), orario (future), "Post." + data originale (rinviate).
- **AC-18.2** Il filtro tipologia (friendly/postseason/cup) è applicato in modo coerente con gli altri widget. *(roadmap fase 2)*

### FR-19 — Calendario (`[lc_calendar]`)
- **AC-19.1** Navigazione per giornate (link + AJAX).
- **AC-19.2** La giornata `0` (amichevoli/coppa) non compare nella navigazione del calendario campionato.
- **AC-19.3** Stato vuoto: "Nessuna giornata disponibile".

### FR-20 — Calciomercato (cambio squadra)
- **AC-20.1** Cambiando `lc_players.team_id`, i record `lc_match_players` e `lc_match_goals`/`lc_match_cards` restano invariati (storico preservato).
- **AC-20.2** Operazione bulk "sposta tutti i giocatori di una squadra" disponibile in admin (roadmap fase 3).
- **AC-20.3** Nessuna registrazione di trasferimento richiesta nell'MVP.

### FR-21 — Import CSV
- **AC-21.1** Formati definiti in §9.1; header case-insensitive; colonne richieste validate per riga con report errori (numero riga).
- **AC-21.2** Squadre/giocatori: match su slug; se esistente → skip (report), se nuovo → crea.
- **AC-21.3** Partite: dedup su (league, season, home, away, match_date); re-import non duplica.
- **AC-21.4** Report finale: "Create X, saltate Y, errori Z".

### FR-22 — Import Open Football
- **AC-22.1** Parser del formato §9.2: league+season da riga `=`, Matchday, date, match "HH:MM Home v Away".
- **AC-22.2** Squadre mancanti create con `auto_created = 1` e slug normalizzato; collisioni risolte con suffisso `-2` (roadmap fase 4).
- **AC-22.3** Gestione anno al cambio di mese (Dec→Jan incrementa anno).
- **AC-22.4** Preview con conteggio prima della conferma (roadmap fase 3).

### FR-23 — Migrazione SportsPress
- **AC-23.1** Copia, mai spostamento: i dati SP restano intatti.
- **AC-23.2** Team/game keys (`sp_home`/`sp_away`, `sp_results`, `sp_players`, `sp_timeline`) rilevate automaticamente.
- **AC-23.3** Processa a **lotti** (batch 50, AJAX) senza `posts_per_page=-1` su dataset completi; report progressivo. *(roadmap fase 4)*
- **AC-23.4** I dettagli gol migrano con `minute='—'` placeholder e `goal_type='open_play'`; i cartellini migrano in `lc_match_cards`.

### FR-24 — Rivedi squadre auto-create
- **AC-24.1** Pagina admin che elenca `lc_teams` con `auto_created=1`, con azioni conferma/rinomina/elimina. *(roadmap fase 3)*

### FR-25 — Sicurezza cancellazioni
- **AC-25.1** Squadra con match o giocatori → RESTRICT (non eliminabile) con messaggio esplicativo.
- **AC-25.2** Giocatore con record in `lc_match_players` → RESTRICT; il flusso documentato è eliminare prima i match.
- **AC-25.3** Match → CASCADE su `lc_match_players`, `lc_match_goals`, `lc_match_cards`.
- **AC-25.4** League/Season con match → RESTRICT.
- **AC-25.5** Posizione in uso → RESTRICT.

### FR-26 — Rigori decisivi (dcr)
Solo per match a eliminazione (`match_type ∈ {cup, playoff, playout}`). Dopo 120' in parità, l'esito è deciso dai tiri dal dischetto. La serie è registrata con conteggio ma **non modifica gol né statistiche**.
- **AC-26.1** `penalties_home`/`penalties_away` (TINYINT UNSIGNED, NULL) sono ammessi solo con `match_type ∈ {cup, playoff, playout}`, `status='played'` e `home_goals = away_goals`; in ogni altro caso sono rifiutati (errore di validazione §6.7).
- **AC-26.2** I tiri della serie NON generano record in `lc_match_goals` e non contano come gol in classifica marcatori né in carriera (un tiro segnato in dcr non è un gol).
- **AC-26.3** `home_outcome`/`away_outcome` del match riflettono il **vincente della serie** (win/loss) quando `penalties_home`/`penalties_away` sono valorizzati; senza serie, restano derivati dai gol. Nessun effetto sulle classifiche (le coppe ne sono già escluse, AC-16.4).
- **AC-26.4** Nei widget il match è mostrato come `2-2 (4-3 dcr)` (risultato dopo 120' + serie tra parentesi). `lc_last_match` e `lc_match_day` mostrano sempre l'indicazione "dcr" per i match decisi ai rigori.
- **AC-26.5** Con serie valorizzata, `home_goals`/`away_goals` restano il risultato dopo 120' (spesso un pareggio): mai "sommare" i tiri al risultato.

---

## 5. Modello dati

**10 tabelle.** Prefisso: `$wpdb->prefix . 'lc_'`. Engine InnoDB, charset `utf8mb4`, collate default WP.

Schema versioning: opzione `lc_football_db_version`. La migrazione è **incrementale**: `upgrade()` viene eseguita alla **activation** E a ogni richiesta admin (`admin_init`) quando la versione è inferiore alla target.

> **Nota FK**: `dbDelta()` non gestisce le FOREIGN KEY. Il plugin **non esegue** `ALTER TABLE ... ADD CONSTRAINT FOREIGN KEY`: le `ON DELETE` riportate di seguito sono il **contratto di integrità** che l'applicazione deve garantire a livello dei delete handler e delle CRUD (matrice §6.4). Dove la colonna lo richiede, è comunque presente un indice.

### 5.1 `lc_leagues`

| Colonna | Tipo | Vincoli |
|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT |
| `name` | VARCHAR(200) | NOT NULL |
| `slug` | VARCHAR(200) | NOT NULL UNIQUE |

```sql
CREATE TABLE {prefix}leagues (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 5.2 `lc_seasons`

Stessa struttura di `lc_leagues` (nome "2026-2027", slug univoco).

### 5.3 `lc_positions`

| Colonna | Tipo | Vincoli |
|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT |
| `name` | VARCHAR(100) | NOT NULL |
| `slug` | VARCHAR(100) | NOT NULL UNIQUE |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

### 5.4 `lc_teams`

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `name` | VARCHAR(200) | NOT NULL | |
| `short_name` | VARCHAR(100) | DEFAULT '' | |
| `slug` | VARCHAR(200) | NOT NULL UNIQUE | |
| `logo_url` | VARCHAR(500) | DEFAULT '' | |
| `home_venue` | VARCHAR(200) | DEFAULT '' | default per i match |
| `auto_created` | TINYINT(1) | DEFAULT 0 | import |
| `created_at` / `updated_at` | TIMESTAMP | defaults | |

Indici: `INDEX(auto_created)`, `INDEX(short_name)`.

### 5.5 `lc_players`

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `team_id` | INT UNSIGNED | DEFAULT NULL, FK→lc_teams ON DELETE RESTRICT | squadra **attuale** |
| `name` | VARCHAR(200) | NOT NULL | |
| `slug` | VARCHAR(200) | NOT NULL UNIQUE | |
| `number` | INT | DEFAULT 0 | |
| `position_id` | INT UNSIGNED | DEFAULT NULL, FK→lc_positions ON DELETE RESTRICT | |
| `nationality` | VARCHAR(100) | DEFAULT '' | codice 3 lettere |
| `photo_url` | VARCHAR(500) | DEFAULT '' | |
| `birth_date` | DATE | NULL | opzionale |
| `created_at` / `updated_at` | TIMESTAMP | defaults | |

Indici: `INDEX(team_id)`, `INDEX(position_id)`.

### 5.6 `lc_matches`

Tabella centrale.

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `league_id` | INT UNSIGNED | DEFAULT NULL, FK→lc_leagues ON DELETE RESTRICT | |
| `season_id` | INT UNSIGNED | DEFAULT NULL, FK→lc_seasons ON DELETE RESTRICT | |
| `match_type` | VARCHAR(20) | NOT NULL DEFAULT 'league' | league/friendly/playoff/playout/cup |
| `match_date` | DATETIME | NOT NULL | **UTC** (v0.4.0) |
| `giornata` | INT | DEFAULT 0 | 0 = amichevoli/coppa/playoff |
| `home_team_id` | INT UNSIGNED | NOT NULL, FK→lc_teams ON DELETE RESTRICT | |
| `away_team_id` | INT UNSIGNED | NOT NULL, FK→lc_teams ON DELETE RESTRICT | |
| `home_goals` | INT | NULL | NULL = non giocata |
| `away_goals` | INT | NULL | |
| `home_outcome` | VARCHAR(20) | NULL | win/draw/loss, calcolato o manuale |
| `away_outcome` | VARCHAR(20) | NULL | |
| `outcome_override` | TINYINT(1) | DEFAULT 0 | 1 = outcome manuale (FR-06); azzerato fuori da `played` |
| `status` | VARCHAR(20) | NOT NULL DEFAULT 'scheduled' | scheduled/played/postponed |
| `original_date` | DATETIME | NULL | data prima del rinvio |
| `venue` | VARCHAR(200) | DEFAULT '' | precompilato, modificabile |
| `notes` | TEXT | NULL | |
| `penalties_home` / `penalties_away` | TINYINT UNSIGNED | NULL | rigori decisivi (FR-26); solo `match_type ∈ {cup, playoff, playout}` con gol pari |
| `created_at` / `updated_at` | TIMESTAMP | defaults | |

Indici: `idx_league_season(league_id, season_id)`, `idx_team_home`, `idx_team_away`, `idx_date(match_date)`, `idx_giornata`, `idx_status`, `idx_match_type`, `idx_search(league_id, season_id, status, match_type, giornata)`.

### 5.7 `lc_match_players`

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `match_id` | INT UNSIGNED | NOT NULL, FK→lc_matches ON DELETE CASCADE | |
| `player_id` | INT UNSIGNED | NOT NULL, FK→lc_players ON DELETE RESTRICT | |
| `team_id` | INT UNSIGNED | NOT NULL | squadra **storica** |
| `goals` | INT | DEFAULT 0 | auto-sync da eventi (FR-12) |
| `own_goals` | INT | DEFAULT 0 | |
| `assists` | INT | DEFAULT 0 | |
| `yellow_cards` | INT | DEFAULT 0 | |
| `red_cards` | INT | DEFAULT 0 | |
| `minutes_played` | INT | DEFAULT 0 | |
| `started` | TINYINT(1) | DEFAULT 0 | 1 = titolare |

Vincoli: `UNIQUE(match_id, player_id)`. Indici: `idx_player`, `idx_team`, `idx_goals`, `idx_owngoals`.

### 5.8 `lc_match_goals`

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `match_id` | INT UNSIGNED | NOT NULL, FK→lc_matches ON DELETE CASCADE | |
| `player_id` | INT UNSIGNED | NOT NULL, FK→lc_players ON DELETE RESTRICT | |
| `team_id` | INT UNSIGNED | NOT NULL | storico |
| `minute` | VARCHAR(10) | NOT NULL | "23", "45+2" |
| `goal_type` | VARCHAR(20) | NOT NULL DEFAULT 'open_play', **CHECK** ∈ (open_play, penalty, free_kick, own_goal) | |

Indici: `idx_match`, `idx_player`, `idx_goal_type`.

### 5.9 `lc_match_cards` *(v0.3.0)*

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `match_id` | INT UNSIGNED | NOT NULL, FK→lc_matches ON DELETE CASCADE | |
| `player_id` | INT UNSIGNED | NOT NULL, FK→lc_players ON DELETE RESTRICT | |
| `team_id` | INT UNSIGNED | NOT NULL | storico |
| `minute` | VARCHAR(10) | NOT NULL | |
| `card_type` | VARCHAR(10) | NOT NULL, **CHECK** ∈ (yellow, red) | |

Indici: `idx_match`, `idx_player`, `idx_card_type`.

### 5.10 `lc_penalties`

| Colonna | Tipo | Vincoli | Note |
|---|---|---|---|
| `id` | INT UNSIGNED | PK AUTO_INCREMENT | |
| `team_id` | INT UNSIGNED | NOT NULL, FK→lc_teams ON DELETE RESTRICT | |
| `league_id` | INT UNSIGNED | NOT NULL, FK→lc_leagues ON DELETE RESTRICT | |
| `season_id` | INT UNSIGNED | NOT NULL, FK→lc_seasons ON DELETE RESTRICT | |
| `points` | INT SIGNED | NOT NULL | > 0 per penalità |
| `reason` | VARCHAR(255) | DEFAULT '' | |
| `date_applied` | DATE | NULL | |
| `notes` | TEXT | NULL | |

Indici: `idx_team`, `idx_league_season`.

### 5.11 Schema versioning e migrazioni

| Versione | Modifica |
|---|---|
| 0.1.0 | Baseline: leagues, seasons, teams, players (position VARCHAR), matches, match_players, match_goals, penalties |
| 0.2.0 | Aggiunta `lc_positions`; `players.position` → `players.position_id`; dati migrati per slug |
| **0.3.0** | Aggiunta `lc_match_cards`; righe `yellow_card`/`red_card` spostate da `lc_match_goals`; `goal_type` limitato ai soli gol; **backfill outcome** (`home_outcome`/`away_outcome` calcolati dai gol per i match giocati senza outcome); nuova colonna `lc_matches.outcome_override` (DEFAULT 0) |
| 0.4.0 (fase 5) | `match_date`/`original_date` in UTC; conversione dati esistenti |
| 0.5.0 | Rigori decisivi (FR-26): colonne `lc_matches.penalties_home`/`penalties_away` |

`upgrade()` è invocata su **activation** e su **admin_init** (confronto `lc_football_db_version`). Ogni step è idempotente (`IF NOT EXISTS`, controlli `SHOW COLUMNS`).

---

## 6. Regole di integrità e coerenza

### 6.1 Outcome vs gol

- `calculate_outcome(h,a)`: h>a → win/loss; h<a → loss/win; h=a → draw/draw; NULL → NULL/NULL.
- In classifica **wins/draws/losses/punti usano gli outcome** (`home_outcome`/`away_outcome`), non il confronto dei gol. La colonna draw del count deve quindi usare `home_outcome = 'draw'`, coerente con il calcolo punti.

### 6.2 Eventi vs totali (FR-12)

Regola a precedenza, applicata sia ai gol sia ai cartellini:
1. Se il match ha eventi (`lc_match_goals` per i gol, `lc_match_cards` per i cartellini), i totali in `lc_match_players` sono **ricalcolati** dagli eventi (autogol separati; gialli/rossi conteggiati per tipo). Eventi = fonte.
2. Se il match non ha eventi, i totali restano l'inserimento manuale.

### 6.3 Autogol

- Conta come gol per la squadra avversaria nel risultato (`home_goals`/`away_goals` già lo includono).
- **NON** conta nei gol del giocatore per la classifica marcatori.
- Nel widget ultima partita è mostrato sotto la squadra che **beneficia** (FR-15 AC-15.3).

### 6.4 Matrice cancellazioni (FR-25)

Le `ON DELETE` di seguito sono garantite **a livello applicativo** (delete handler §8), non da FK DB (nota §5).

| Entità | Effetto |
|---|---|
| Match | CASCADE → match_players, match_goals, match_cards |
| Giocatore | RESTRICT se ha record in match_players/match_goals/match_cards; altrimenti cancellabile |
| Squadra | RESTRICT se ha match (home/away) o giocatori; altrimenti cancellabile |
| Campionato / Stagione | RESTRICT se ha match; altrimenti cancellabile (penalità collegate) |
| Posizione | RESTRICT se usata da almeno un giocatore |
| Penalità | cancellabile liberamente (nessun dipendente) |

### 6.5 Trasferimenti (FR-20)

- `lc_players.team_id` = squadra attuale. Aggiornarlo **non tocca** `lc_match_players.team_id`, `lc_match_goals.team_id`, `lc_match_cards.team_id`.
- Niente cronologia trasferimenti nell'MVP.

### 6.6 Tie-breaker classifica (FR-16)

Ordinamento: **Pt netto desc → DR desc → GF desc**. Riga con stessi (Pt netto, DR, GF) → stessa posizione; la successiva salta (competition ranking: 1, 1, 3).

### 6.7 Validazione input

Regole applicate sia al form admin sia agli import (per riga, con numero riga nel report). Violazione di una regola **bloccante** → errore; di una regola **warning** → salvataggio consentito con avviso.

| Regola | Tipo | Note |
|---|---|---|
| `home_team_id ≠ away_team_id` | bloccante | una squadra non gioca contro se stessa |
| Gol: `0 ≤ gol ≤ 99`, interi | bloccante | |
| Gol e outcome valorizzabili **solo** con `status='played'` | bloccante | con `scheduled`/`postponed` i gol sono vuoti (FR-05 AC-05.2/AC-05.6) |
| `penalties_home`/`penalties_away` solo con `match_type ∈ {cup, playoff, playout}`, `played`, gol pari | bloccante | FR-26 AC-26.1 |
| Serie di rigori valorizzata → entrambi i valori presenti | bloccante | mai un solo lato |
| Duplicati manuali su `(league_id, season_id, home_team_id, away_team_id, match_date)` | bloccante | FR-05 AC-05.5 |
| Squadra con 2 match nella stessa `giornata` (stessa league/season) | warning | consentito, avvisato |
| `match_date`/`original_date`: formato data/ora valido, in **UTC** | bloccante | |
| `giornata`: `≥ 1` per `match_type='league'`; `0` per friendly/playoff/coppa | bloccante | |
| Slug univoci (league/season/team/player/position) | bloccante | garantito da vincolo UNIQUE (FR-01/02/04) |
| Messaggi utente: vedi catalogo §8.5 | | |

---

## 7. Contratti shortcode e widget

Tutti gli shortcode condividono il rendering con i widget Elementor (stessa classe `Shortcodes`).

### 7.0 Regole comuni validazione parametri

- `league`, `season`: INT obbligatori, `> 0`.
- Flag `yes/no`: valori ammessi `yes`, `no` (default `no`); ogni altro valore è trattato come `no`.
- `limit`, `day`, `current`: INT, `> 0`; `limit=0` = nessun limite (tutte).
- Parametri sconosciuti o non documentati sono ignorati (nessun errore).

### 7.1 `[lc_next_match]`

| Param | Tipo | Default | Note |
|---|---|---|---|
| `league` | INT | 0 | obbligatorio |
| `season` | INT | 0 | obbligatorio |
| `include_friendly` | yes/no | no | |
| `include_postseason` | yes/no | no | playoff+playout |
| `include_cup` | yes/no | no | coppe |
| `include_postponed` | yes/no | no | |

SQL (raggruppamento corretto; tipologia decisa solo dai flag, nessun parametro `match_type`):
```sql
SELECT m.*, ht.short_name AS home_short, at.short_name AS away_short
FROM {prefix}matches m
JOIN {prefix}teams ht ON m.home_team_id = ht.id
JOIN {prefix}teams at ON m.away_team_id = at.id
WHERE m.league_id = %d AND m.season_id = %d
  AND m.match_type IN (...)
  AND m.status IN (...)
  AND m.match_date >= UTC_TIMESTAMP()
ORDER BY m.match_date ASC
LIMIT 1
```

### 7.2 `[lc_last_match]`

| Param | Tipo | Default | Note |
|---|---|---|---|
| `league` | INT | 0 | obbligatorio |
| `season` | INT | 0 | obbligatorio |
| `include_friendly` | yes/no | no | |
| `include_postseason` | yes/no | no | playoff+playout |
| `include_cup` | yes/no | no | coppe |

`include_postponed` è accettato ma **senza effetto** (l'ultima partita è solo `status='played'`). Match: `status='played'`, `ORDER BY match_date DESC LIMIT 1`.

Query eventi gol (solo gol — mai cartellini):
```sql
SELECT g.minute, g.goal_type, p.name AS player_name, t.short_name AS team_short,
       CASE
         WHEN (g.team_id = m.home_team_id AND g.goal_type <> 'own_goal') OR
              (g.team_id = m.away_team_id AND g.goal_type = 'own_goal') THEN 'home'
         ELSE 'away'
       END AS side
FROM {prefix}match_goals g
JOIN {prefix}players p ON g.player_id = p.id
JOIN {prefix}teams t ON g.team_id = t.id
JOIN {prefix}matches m ON g.match_id = m.id
WHERE g.match_id = %d
ORDER BY g.id ASC
```
Fallback (nessun evento): totali da `lc_match_players` con `goals > 0`, `ORDER BY mp.goals DESC`.

**Regola side autogol**: `own_goal` → lato avversario della squadra del marcatore (squadra che beneficia).

### 7.3 `[lc_league_table]`

| Param | Tipo | Default |
|---|---|---|
| `league` | INT | 0 |
| `season` | INT | 0 |
| `limit` | INT | 0 (tutte) |
| `show_penalties` | yes/no | no |

Ordinamento fisso (nessun parametro `sort`): Pt netto → DR → GF (§6.6).

SQL aggregata (corretta, senza alias inesistenti):
```sql
SELECT
  t.id, t.name, t.short_name, t.logo_url,
  COUNT(m.id) AS played,
  SUM(CASE WHEN (m.home_team_id = t.id AND m.home_outcome = 'win')
             OR (m.away_team_id = t.id AND m.away_outcome = 'win') THEN 1 ELSE 0 END) AS wins,
  SUM(CASE WHEN (m.home_team_id = t.id AND m.home_outcome = 'draw')
             OR (m.away_team_id = t.id AND m.away_outcome = 'draw') THEN 1 ELSE 0 END) AS draws,
  SUM(CASE WHEN (m.home_team_id = t.id AND m.home_outcome = 'loss')
             OR (m.away_team_id = t.id AND m.away_outcome = 'loss') THEN 1 ELSE 0 END) AS losses,
  SUM(CASE WHEN m.home_team_id = t.id THEN m.home_goals ELSE m.away_goals END) AS goals_for,
  SUM(CASE WHEN m.home_team_id = t.id THEN m.away_goals ELSE m.home_goals END) AS goals_against
FROM {prefix}teams t
LEFT JOIN {prefix}matches m ON (t.id IN (m.home_team_id, m.away_team_id))
  AND m.league_id = %d AND m.season_id = %d
  AND m.status = 'played' AND m.match_type = 'league'
GROUP BY t.id
HAVING played > 0
```
Penalità: `SELECT team_id, SUM(points) AS total FROM {prefix}penalties WHERE league_id=%d AND season_id=%d GROUP BY team_id`.
Assemblaggio PHP: `points_raw = wins*3 + draws*1`, `points = points_raw − penalty`, `gd = gf − gs`; **ordinamento in PHP** per `points desc, gd desc, gf desc` con competition ranking.

### 7.4 `[lc_top_scorers]`

| Param | Tipo | Default |
|---|---|---|
| `league` | INT | 0 |
| `season` | INT | 0 |
| `limit` | INT | 10 |
| `show_penalties` | yes/no | no |

Query gol: `SUM(mp.goals)` da `lc_match_players` JOIN matches (`league`, `season`, `status='played'`, `match_type='league'`), `GROUP BY player`, `HAVING > 0`, `ORDER BY total_goals DESC`. Squadra mostrata: `lc_players.team_id` (attuale).
Rigori (solo se `show_penalties="yes"`): conteggio `goal_type='penalty'` da `lc_match_goals` limitato ai player in classifica. Nota: se l'utente usa solo totali manuali senza eventi, il conteggio rigori è 0 (limite documentato).

> **Nota semantica `show_penalties`**: in `lc_league_table` abilita le colonne **Pen**/**Pt Netto** (penalità di punti, FR-13); in `lc_top_scorers` abilita la colonna **"di cui R"** (rigori segnati). Stesso nome, significato diverso per widget.

### 7.5 `[lc_match_day]`

| Param | Tipo | Default | Note |
|---|---|---|---|
| `league` | INT | 0 | obbligatorio |
| `season` | INT | 0 | obbligatorio |
| `day` | INT | 0 | giornata richiesta |

SQL (nessun filtro tipologia: mostra tutto ciò che ha quella `giornata`):
```sql
SELECT m.*, ht.name AS home_name, ht.short_name AS home_short,
        at.name AS away_name, at.short_name AS away_short
FROM {prefix}matches m
JOIN {prefix}teams ht ON m.home_team_id = ht.id
JOIN {prefix}teams at ON m.away_team_id = at.id
WHERE m.league_id = %d AND m.season_id = %d AND m.giornata = %d
ORDER BY m.match_date ASC
```
Rendering: risultato se `played`, orario se future, "Post." + data originale se `postponed`.

### 7.6 `[lc_calendar]`

| Param | Tipo | Default | Note |
|---|---|---|---|
| `league` | INT | 0 | obbligatorio |
| `season` | INT | 0 | obbligatorio |
| `current` | INT | 0 | giornata iniziale; 0 = max `giornata` tra le giocate |

Navigazione giornate (esclude la `giornata 0`, FR-19 AC-19.2):
```sql
SELECT DISTINCT giornata FROM {prefix}matches
WHERE league_id = %d AND season_id = %d AND giornata > 0
ORDER BY giornata ASC
```
Giornata attiva di default: `SELECT COALESCE(MAX(giornata),0) FROM {prefix}matches WHERE league_id=%d AND season_id=%d AND status='played'`.
Il contenuto delle giornate è caricato via AJAX `lc_load_giornata` (rende `lc_match_day`, §8.3).

### 7.7 Comportamento rinvii nei widget

| Widget | Comportamento |
|---|---|
| `lc_next_match` | esclusi default; `include_postponed="yes"` → etichetta "Posticipata" + data originale |
| `lc_last_match` | mai inclusi (non giocate) |
| `lc_match_day` | mostrati con "Post." + "Rinviata dal [original_date]" |
| `lc_calendar` | mostrati con indicazione di rinvio |

**Rigori decisivi (FR-26 AC-26.4):** ogni widget che mostra un match deciso ai rigori rende `2-2 (4-3 dcr)` — risultato dopo 120' + serie tra parentesi con suffisso `dcr` ("dopo calci di rigore").

### 7.8 Stati vuoti

Ogni widget deve rendere un messaggio esplicito (`Nessuna partita in programma`, `Nessuna partita giocata`, `Nessuna partita in questa giornata`, `Nessuna giornata disponibile`, tabella classifica/marcatori vuota).

---

## 8. Contratto admin

### 8.1 Menu

```
LC Football
├── Dashboard
├── Campionati      (lc-football-leagues)
├── Stagioni        (lc-football-seasons)
├── Posizioni       (lc-football-positions)
├── Squadre         (lc-football-teams)
│   └── Rivedi auto-create (lc-football-teams-review)   [fase 3]
├── Giocatori       (lc-football-players)
│   └── Cambia squadra (lc-football-players-transfer)   [fase 3]
├── Partite         (lc-football-matches)
├── Penalità        (lc-football-penalties)
├── Importa         (lc-football-import)
└── Impostazioni    (lc-football-settings)
```

Tutte le pagine richiedono capacità `manage_options`. Form con `wp_nonce_field` e verifica (`lc_save_entity`, `lc_delete_entity`, `lc_penalty_action`, `lc_import`, `lc_settings`).

### 8.2 Form partita

Sezioni come da FR-05. Dettagli:
- **1 Info**: campionato, stagione, tipo (`match_type`), data/ora, giornata, squadra casa, squadra ospite, campo (`venue`), note, stato, data originale (rinvio). `note` è una TEXT libera sulla riga match.
- **2 Risultato**: gol casa/ospite + dropdown outcome per lato con opzione "Auto" (default) e i tre esiti. "Auto" imposta `outcome_override=0`; un esito esplicito imposta `outcome_override=1`. Il dropdown è disabilitato quando i gol sono vuoti. *(UI in roadmap fase 2)*
- **2b Rigori decisivi** (FR-26): campi `penalties_home`/`penalties_away`, visibili solo quando il match è `played`, con gol pari e `match_type ∈ {cup, playoff, playout}`; opzionali. Quando compilati, l'outcome è derivato dal vincente della serie (AC-26.3).
- **3A Formazioni**: righe ripetibili per lato (casa/ospite) con giocatore, gol, assist, autogol, gialli, rossi, titolare, minuti. (`minutes_played`/`started` in roadmap fase 2.)
- **3B Eventi gol**: minuto, giocatore, tipo (Open play/Rigore/Punizione/Autogol). Al salvataggio i totali vengono sincronizzati (FR-12).
- **3C Cartellini**: minuto, giocatore, tipo (Giallo/Rosso) → `lc_match_cards`.
- Il salvataggio dell'intero match (match + 2b + 3A + 3B + 3C) è **transazionale** (FR-05 AC-05.3).
- Controlli: dedup (AC-05.5), status/gol (AC-05.2), rigori (AC-26.1) — vedi §6.7 e messaggi §8.5.

### 8.3 AJAX

| Endpoint | Priv | Auth | Note |
|---|---|---|---|
| `wp_ajax_lc_search_players` | sì | manage_options + nonce | ricerca giocatori |
| `wp_ajax_lc_search_teams` | sì | manage_options + nonce | ricerca squadre |
| `wp_ajax_lc_load_giornata` / `nopriv` | no | nonce | rende una giornata per il calendario |

### 8.4 Dashboard

Card: squadre, giocatori, partite totali, partite giocate. (Espansione in roadmap.)

### 8.5 Catalogo messaggi

Messaggi utente esatti e testabili. Placeholder `[...]` sostituiti con i valori.

| Contesto | Messaggio |
|---|---|
| Duplicato manuale (AC-05.5) | `Esiste già una partita con le stesse squadre nella stessa data.` |
| Eliminazione RESTRICT squadra | `Squadra non eliminabile: ha partite o giocatori collegati. Elimina prima le entità correlate.` |
| Eliminazione RESTRICT campionato/stagione | `Campionato/Stagione non eliminabile: ha partite collegate. Elimina prima le partite.` |
| Eliminazione RESTRICT giocatore | `Giocatore non eliminabile: ha statistiche o eventi collegati. Elimina prima i match.` |
| Eliminazione RESTRICT posizione | `Posizione non eliminabile: ci sono giocatori con questo ruolo.` |
| Rigori non validi (AC-26.1) | `Rigori decisivi ammessi solo per coppe/playoff/playout giocati in parità.` |
| Serie incompleta (AC-26.1) | `Indica il risultato dei rigori per entrambe le squadre.` |
| Gol fuori da `played` (AC-05.2) | `I gol sono ammessi solo per partite giocate.` |
| Import completato | `Import completato. Create X, saltate Y, errori Z.` |
| Import nessun dato | `Nessun dato nuovo importato.` |
| Import errori per riga | `Riga N: [motivo].` |
| Stato vuoto `lc_next_match` | `Nessuna partita in programma.` |
| Stato vuoto `lc_last_match` | `Nessuna partita giocata.` |
| Stato vuoto `lc_match_day` | `Nessuna partita in questa giornata.` |
| Stato vuoto `lc_calendar` | `Nessuna giornata disponibile.` |

---

## 9. Contratti import

### 9.1 CSV

**Squadre** `name,short_name,home_venue,logo_url`
**Giocatori** `name,team_name,number,position,nationality,birth_date` (posizione auto-creata/riciclata)
**Partite** `league,season,match_type,match_date,giornata,home_team,away_team,home_goals,away_goals,status,venue` (+ opzionali `penalties_home,penalties_away` per rigori decisivi, FR-26; validate come §6.7)
**Tabellino** `match_id,player_name,team_name,goals,own_goals,assists,yellow_cards,red_cards,minutes_played,started`
**Eventi gol** `match_id,player_name,team_name,minute,goal_type` (goal_type ∈ 4 valori gol)

Regole: header case-insensitive; per riga validazione campi richiesti con numero riga; dedup partite su (league, season, home, away, date); re-import idempotente; report "Create X, saltate Y, errori Z".

### 9.2 Open Football

```
= Italian Serie A, 2026-27
Matchday 1
  Sun Aug 23 2026
    18:30  Udinese Calcio v Como 1907
    Bologna FC 1909 3-1 SS Lazio
= Coppa Italia 2026-27
▪ Round of 16
  Tue Dec 1 2026
    Milan FC 2-2 (4-3 dcr) Napoli
```
Parser: `=` → league+season (auto-create), `Matchday N` / `▪ Round` → giornata, giorno → data, `HH:MM Home v Away` → match, `Home X-Y Away` → match giocato. **Rigori decisivi**: notazione `H-A (P-Q dcr)` → `home_goals`/`away_goals` = `H-A` (dopo 120') e `penalties_home`/`penalties_away` = `P-Q` (FR-26). Squadre mancanti `auto_created=1`. Anno da contesto con rollover mese.

### 9.3 Migrazione SportsPress

- Rilevamento automatico keys (`sp_home`/`sp_away`, `sp_results`, `sp_players`, `sp_timeline`, venue/dob).
- **Giornata**: letta da meta `sp_matchday` (fallback `sp_day`); su match già esistenti il re-import aggiorna `giornata` (idempotente).
- **Batch AJAX** (50 elementi) senza `posts_per_page=-1` (roadmap fase 4).
- Cartellini → `lc_match_cards`; dettagli gol → `lc_match_goals` con `minute='—'`, `goal_type='open_play'`.
- **Rigori decisivi**: se il risultato "Penalties" è presente nelle meta `sp_results` (match a eliminazione in parità), migra in `penalties_home`/`penalties_away` (FR-26); il risultato `sp_goals` resta in `home_goals`/`away_goals`.
- Coesistenza: nessuna modifica ai dati SP.

---

## 10. Requisiti non funzionali

- **Security**: escaping output (`esc_html`, `esc_attr`, `esc_url`), prepared statements `$wpdb->prepare`, nonce su ogni form/endpoint, capability `manage_options` per admin.
- **Compatibilità**: WordPress ≥ 6.0, PHP ≥ 7.4 (target 8.x), Elementor ≥ 3.0 (solo se attivo).
- **Accessibilità**: tabelle con `<th scope>`, testo alternativo, contrasto base.
- **i18n**: stringhe UI via `__()` con dominio `lc-football`; `.pot` aggiornato.
- **Timezone**: dati in UTC (v0.4.0), rendering con timezone sito.
- **Performance**: rispettare il budget §2.
- **UI admin (D-16)**: Tom Select **self-hosted** (`admin/js/vendor/tom-select@2.x`, ~16 KB gz) per i select ricercabili; **vanilla ES6** per tutto il codice custom (righe ripetibili, sync eventi, AJAX); `admin.css` con CSS custom properties; **nessun CDN**, **nessun jQuery** nel codice del plugin. Nessun build step obbligatorio per gli asset.
- **Backup/restore**: i dati vivono nelle tabelle WP standard; il backup è quello DB di WordPress (es. `docker/backup.sql`); nessun file dati proprietario da sincronizzare.
- **Import robustezza**: import transazionale per file; una riga con errore viene **saltata e segnalata** (numero riga, motivo) senza interrompere il resto né lasciare dati parziali (§9.1).

---

## 11. Piano di test

Ambiente: WordPress Docker in `docker/wordpress` con backup reale (`docker/backup.sql`, 1GB).

| Livello | Copertura |
|---|---|
| **Unit** | `calculate_outcome`, `sanitize_slug`, tie-breaker classifica, sync eventi→totali, parser Open Football |
| **Integrazione** | CRUD entity, salvataggio match transazionale, RESTRICT deletes, shortcode rendering (stati vuoti) |
| **Performance** | Query Monitor: homepage ≤ 8 query / ≤ 50ms / ≤ 30MB; benchmark pre/post |
| **Migrazione** | Import backup.sql → migrazione SP 769 partite; confronto conteggi con SportsPress |

**Criteri di accettazione per release**: tutti gli AC dei FR-01…FR-26 verdi; budget §2 rispettato; nessun warning/error in log durante smoke test.

---

## 12. Deploy e rollback

1. Staging: installare LC Football, migrare dati SP, confrontare widget.
2. Benchmark homepage pre/post.
3. Produzione: attivare LC Football, sostituire i 6 widget in homepage, verificare.
4. **Coesistenza**: SportsPress resta attivo finché i dati non sono verificati.
5. **Rollback**: LC Football non cancella i dati SP né quelli LC (i delete sono RESTRICT/transazionali). Disattivazione senza drop (`lc_football_drop_tables` default `no`) = ritorno istantaneo.

---

## 13. Decision log

| # | Decisione | Esito |
|---|---|---|
| D-01 | Colonne punti classifica | Pt = lordo, Pen, Pt Netto |
| D-02 | Posizione autogol in ultima partita | Sotto la squadra che beneficia |
| D-03 | Rappresentazione cartellini | Nuova tabella `lc_match_cards` |
| D-04 | Semantica cancellazioni | RESTRICT (squadra/giocatore/league/season con dati) |
| D-05 | Fuso orario | UTC in DB, conversione in output (v0.4.0) |
| D-06 | Sorgente totali gol | Eventi se presenti, altrimenti manuale |
| D-07 | Squadra in classifica marcatori | Attuale (`lc_players.team_id`) |
| D-08 | Tie-breaker | Pt netto → DR → GF; competition ranking |
| D-09 | MVP | Staff escluso; trasferimenti senza log; niente coppe nei widget league di default |
| D-10 | Override outcome | Colonna `outcome_override` su `lc_matches` (1=manuale, 0=auto); migrazione v0.3.0, UI in fase 2 |
| D-11 | Sync cartellini | FR-12 esteso: `yellow_cards`/`red_cards` ricalcolati da `lc_match_cards` se presenti |
| D-12 | Parametri shortcode | Rimossi/documentati come non-supportati: `sort`, `match_type`, flag tipologia in `match_day` |
| D-13 | Coerenza schema | §5 allineato alla matrice §6.4 (RESTRICT applicativo; FK documentali) |
| D-14 | Rigori decisivi | Colonne `lc_matches.penalties_home`/`penalties_away` con conteggio; tiri mai gol; outcome dal vincente della serie (FR-26) |
| D-15 | Forfait / a tavolino | Fuori scope: registrato come risultato normale |
| D-16 | UI stack admin | Tom Select self-hosted + vanilla ES6 + CSS custom properties; niente CDN, niente jQuery, niente build step |

---

## 14. Roadmap

Fasi di **delivery pure** indipendenti dallo stato del codice: ogni fase ha criteri di accettazione (gli AC dei FR coinvolti, il budget §2 e i test §11) e si considera completata solo quando passano.

### Fase 0 — Baseline spec (fatta con questo documento)
- SPECS spec-driven (questo documento) come fonte di verità; decision log D-01…D-16.
- **AC**: documento coerente internamente (nessun FR/AC/§ contraddittorio); tutti i contratti §7/§8/§9 implementabili così come scritti.

### Fase 1 — Schema & integrità (~2 gg)
- Modello §5 completo: `lc_match_cards`, `lc_matches.outcome_override` (migrazione 0.3.0), `penalties_home`/`penalties_away` (migrazione 0.5.0); upgrade idempotente.
- Sync totali e risultato dagli eventi (FR-12 AC-12.4/AC-12.5), blocco duplicati manuali (AC-05.5), azzeramento gol/outcome fuori da `played` (AC-05.6).
- Contratti §7 conformi: rimozione parametri morti (D-12), `calendar` senza giornata 0 (AC-19.2).
- **AC**: FR-11, FR-12, FR-25, FR-26 verdi.

### Fase 2 — Coerenza dati (~2 gg)
- Outcome override UI (FR-06), venue auto-fill (FR-08), `original_date` auto (FR-07), `minutes_played`/`started` nel form, gestione `cup`/`match_type` unificata (FR-14/18 + FR-26), parametri `lc_match_day` coerenti con §7.5, "giorni mancanti" in `lc_next_match` (AC-14.1).
- **AC**: FR-05, FR-06, FR-07, FR-08, FR-14, FR-18, FR-26 verdi.

### Fase 3 — Admin avanzato (~3 gg)
- Teams-review (FR-24), players-transfer bulk (FR-20), import preview/dry-run, "Importa da formazione".
- **AC**: FR-20, FR-22, FR-24 verdi.

### Fase 4 — Import batch (~2 gg)
- Batching migrazione SP senza `posts_per_page=-1`; collisioni slug con suffisso `-2`; validazione dati import (§6.7, catalogo §8.5).
- **AC**: FR-21, FR-22, FR-23 verdi; migrazione 769 partite ≤ 5 min, ≤ 256MB.

### Fase 5 — Timezone + calendar (~2 gg)
- Migrazione v0.4.0 UTC; widget calendario senza giornata 0 (FR-19).
- **AC**: FR-19 verdi; date coerenti con timezone sito.

### Fase 6 — Test & benchmark (~3 gg)
- Test plan §11 completo sul Docker con backup reale.
- **AC**: budget §2 rispettato; nessun errore nei log.

### Fase 7 — Deploy (~1 gg)
- Rollout §12 completo.
- **AC**: homepage con widget LC attivi, SportsPress disattivato, benchmark migliorato.

**Totale stimato: ~16 giorni (Fase 0 inclusa).**
