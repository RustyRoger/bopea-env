# LC Football — Changelog

## [0.5.2] — 2026-08-07

### Uniformazione liste admin su `LC_List_Table` generica

- [x] **`LC_List_Table` estesa** (base generica): nuove capability opzionali e backward-compatible — `select_cols`/`from`/`from_query` per SELECT e JOIN custom, `filters` per filtri GET (`type=int|str`), `render` per colonne con callable, checkbox+bulk configurabili via `bulk_actions`/`cb`; clausole `searchable` con alias (es. `p.name`)
- [x] **`Player_List_Table` migrata** sulla base generica: sparite query duplicata, `build_where_sql` e `column_*` ridondanti; resta solo la configurazione (join squadra/ruolo, filtri `lc_team`/`lc_pos`, renderer `#`)
- [x] Ordine dei `require_once` riordinato (`LC_List_Table` prima delle sottoclassi)
- [x] Verifica: php -l OK; pagina Giocatori HTTP 200 (50 righe, link modifica, ricerca e filtri squadra/ruolo funzionanti); pagina Partite HTTP 200 con wrap `<form>` e `cb-select-all` intatti

### Redesign widget "Prossima partita" (`[lc_next_match]` / Elementor)

- [x] **Layout verticale a 3 sezioni** (`templates/next-match.php` riscritto): sez. loghi (casa | badge VS | ospite), sez. info verticali (`NomeCasa vs NomeOspite`, ora HH:MM, data dd/mm/yyyy, stadio), sez. countdown 4 celle (giorni/ore/minuti/secondi)
- [x] **Dati**: query estesa con `logo_url` (casa/ospite) e `home_venue` come fallback stadio; `$match->remaining` calcolato a render (differenza server) per il countdown
- [x] **Fallback logo**: cerchio `#CD1316` con iniziali del nome squadra se manca `logo_url`
- [x] **Countdown real-time vanilla** (`assets/js/lc-football.js`): snapshot `Date.now()` + tick 1s su differenza server (nessun problema di fuso client/server); **count-down fino al kickoff, poi switch automatico a count-up** (tempo trascorso); titolo "Prossima partita" → "Partita in corso" + bordo timer rosso (`lc-live`) finché lo status non viene aggiornato
- [x] **Fix conflitto attributo `data-countdown` col tema**: lo script jQuery del tema (`$("[data-countdown]")`) interpretava il valore come data e **riscriveva l'interno del widget** (il tema passa un datetime `2026/08/28 13:40:46`, il nostro un numero di secondi → `NaN` → "00 00 00 00"). Rinominato l'attributo in `data-lc-countdown` → il tema non tocca più il widget (verificato: dopo 6s logos+info+countdown preservati e tick corretti `14g 04h 10m 23s`)
- [x] **Cifre iniziali lato server** (`templates/next-match.php`): giorni/ore/minuti/secondi e titolo calcolati a render da `$match->remaining` → il primo HTML non mostra mai segnaposto `00` anche senza JS
- [x] **Modalità scura verificata**: computed style con `body.wp-night-mode-on` → card `#302E28`, bordo `#4a4943`, testo `#fff`, etichette `#ccc`, sub-box `#3a3832` (verificato via Chrome headless + iframe same-origin)
- [x] **Font-size allineati a SportsPress** (misurati via computed style sul widget SP home): titolo 13px, nome 15px, ora 18px, data 18px, stadio 13px, cifre countdown 15px (ridotte da 24), etichette 12px; layout countdown numero sopra / etichetta sotto in 4 celle orizzontali
- [x] **Design a tema home** (`assets/css/lc-football.css`): card `rgba(255,255,255,.75)`/radius 10/ombra soft, sub-box `rgba(255,255,255,.25)`, font `--jl-*`, accent `#CD1316`; **modalità scura** `body.wp-night-mode-on`; responsive 767/480px; rimossi selettori condivisi non più usati dal template
- [x] **Responsive a larghezza del widget (sidebar)** (`assets/css/lc-football.css`): `container-type: inline-size` sul widget + blocco `@container (max-width:340px)` — tracce grid restringibili (`minmax(0,1fr)`), box logo fluidi (`aspect-ratio:1`, max 50px in modalità stretta), "vs" 15px, cifre countdown 13px, etichette 8px, gap/padding compattati; `overflow:hidden` sulle celle countdown. Prima l'overflow era fisso (grid `auto`/`1fr` non restringibili + valori px): in sidebar a 223px loghi e label/"secondi" uscivano dal contenitore
- [x] **Riquadri interni rimossi ovunque** (`assets/css/lc-football.css`): via il box bianco attorno ai singoli loghi e via le celle bianche attorno a numeri/etichette del countdown → più spazio → **cifre 15→18px / etichette 12px** (modalità stretta: cifre **16px**, etichette **9px**, loghi **56px** vs 48); **loghi centrati** (`.lc-logos` da grid a flex con `justify-content:center`, dimensioni box 88px base / 56px stretta, `padding` immagine rimosso)
- [x] **Fix spazio vuoto sotto il widget su mobile** (`assets/css/lc-football.css`): su ≤767px Elementor forza `--flex-wrap: wrap` sui `.e-con`; unito a `justify-content: center` di un container colonna, il browser gonfiava l'altezza dell'ultimo widget (541px contro card 285px → ~236px di vuoto sotto). Forzato `flex-wrap: nowrap` via `.e-con:has(.elementor-widget-lc_next_match)` in `@media (max-width:767px)` (stato già presente su desktop) → widget 305px, container 720px (era 955px), nessuno spazio fantasma
- [x] Verifica: php -l, node --check, HTTP home HTTP 200 con nuovo markup (fallback "V" + logo Catanzaro, `20:30`, `21/08/2026`, `data-lc-countdown`) e CSS combinato aggiornato dopo `sg purge`
- [x] Verifica overflow e centraggio (Chrome headless + iframe same-origin, `scrollWidth ≤ clientWidth`): a **223px** card 221 · loghi 189/189 · box 56/56 · "vs" 21/21 · celle countdown 42/42 (etichetta "secondi" 39/39, cifre 19/19 a 16px) · info 187/187 · nome 174/174 · **margini loghi L/R = 16/16**; a **700px** loghi 88/88 · celle 156/156 (label 55/55) · cifre 18px/etichette 12px · margini L/R = 206/206 — nessun elemento sfora il container; file probe rimosso

## [0.5.1] — 2026-08-07

### Fix import Open Football: campionato/stagione, mapping e giornate

- [x] **Split header campionato/stagione robusto** (`parse_openfootball`): accetta separatori `/ - . spazio` e anno a 2/4 cifre (`2026 27`, `2026.27`, `2026-2027`, `2026/27`); prima creava un campionato col nome intero del file e una stagione vuota per i formati senza slash
- [x] **Niente campionato/stagione vuoti**: `ensure_league()`/`ensure_season()` con slug vuoto restituiscono `0` (nessuna riga `name=''`); `process_match_data` segnala "campionato/stagione mancanti"
- [x] **Nome stagione leggibile**: slug `2026-27` → nome visualizzato `2026/27`
- [x] **Mapping affidabile** (`parse_of_mapping`): chiavi normalizzate con `Helpers::sanitize_slug` (non `sanitize_key`) → la selezione di un campionato/stagione esistente viene rispettata (prima la selezione poteva essere persa)
- [x] **Giornate su partite già presenti a scelta** (form anteprima): modalità `keep` (lascia invariate) / `update_if_empty` (assegna solo se giornata assente) / `update_all` (sovrascrivi col file); `apply_giornata_to_existing()` in `process_match_data`
- [x] **Shift+click selezione a intervallo** in "Partite": la lista tabella è ora racchiusa in un `<form>` (WP core `common.js` richiede il form per calcolare il range tra checkbox); i pulsanti bulk (già `type="button"` + `fetch`) non subiscono effetti
- [x] Verifica: php -l OK; test riflessione header (6 formati), mapping esistente vs auto-create, conflitti giornata in transazione (rollback, DB invariato a 769)

## [0.5.0] — 2026-08-03

### Fase 1 completa + FR-26 rigori decisivi + contratti §7 + UI D-16

- [x] **Schema DB** (`lc_football_db_version=0.5.0`): `lc_matches.outcome_override` TINYINT(1), `penalties_home`/`penalties_away`, indice `idx_search`; `lc_teams.idx_short_name`; `lc_penalties.points` INT SIGNED; migrazioni incrementali idempotenti (`maybe_upgrade` + step 0.5.0)
- [x] **FR-26 rigori decisivi**: serie registrata con conteggio senza effetto su gol/statistiche; validazione AC-26.1; outcome dal vincente della serie (AC-26.3); rendering `(X-Y dcr)` in `lc_last_match`/`lc_match_day` (AC-26.4)
- [x] **Validazione §6.7**: nuova classe `Validator` (home≠away, gol 0-99, gol solo su `played`, rigori, duplicato AC-05.5, date, giornata, warning doppia giornata)
- [x] **Catalogo messaggi §8.5**: messaggi esatti RESTRICT per entità, duplicato, rigori non validi, gol fuori `played`, import
- [x] **Salvataggio match transazionale** (FR-05 AC-05.3): match + rigori + formazioni + eventi gol + cartellini; sync totali da eventi (FR-12 AC-12.1/12.2/12.4), risultato derivato dagli eventi (AC-12.5), zeroing gol fuori `played` (AC-05.6)
- [x] **Contratti shortcode §7**: rimozione parametri morti, `include_cup`, validazione league/season/day INT>0, calendar senza giornata 0 (AC-19.2), ranking ex-aequo top scorer (AC-17.4)
- [x] **Form match §8.2**: sezione Info con `note`, Risultato con dropdown outcome "Auto"/esiti (FR-06), sezione 2b Rigori decisivi condizionale, formazioni con Titolare/Minuti (`minutes_played`/`started`)
- [x] **D-16 stack UI admin**: Tom Select 2.3.1 self-hosted (`admin/vendor/tom-select/`), JS vanilla ES6 senza CDN/jQuery (admin, match form, calendario AJAX frontend)
- [x] **Import §9**: CSV header case-insensitive, colonne `league,season` e `penalties_home/away`, validazione per riga; Open Football con `▪ Round`, notazione `H-A (P-Q dcr)`, rollover mese, inferenza coppa; SportsPress con rigori da `sp_results`; report `Import completato. Create X, saltate Y, errori Z.`
- [x] Widget Elementor: parametro `include_cup` in `lc_next_match`/`lc_last_match`
- [x] **Verifica**: php -l, node --check, smoke test Validator/Importer/form/shortcode e HTTP end-to-end del form match su Docker live

### Fase 2 completa (AC-14.1 → 0.5.1)

- [x] **AC-14.1** `[lc_next_match]`: badge "giorni mancanti" ("Oggi"/"Domani"/"Tra N giorni") rispetto alla data/ora del match, usando timezone WP (`current_time`)

### Fase 3 — Admin avanzato (completata)

- [x] **FR-24 AC-24.1** pagina "Rivedi auto-create": elenco `lc_teams` con `auto_created=1`; azioni conferma (`→ auto_created=0`), rinomina (→ form), elimina (→ RESTRICT FR-25); notifica confermata
- [x] **FR-20 AC-20.2** bulk trasferimento giocatori: form in "Giocatori" (da squadra → a squadra) → `UPDATE lc_players.team_id`; storico `lc_match_players` invariato (AC-20.1)
- [x] **FR-22 AC-22.4** import Open Football con preview/dry-run: parser estratto in `parse_openfootball()` (riutilizzato da import e preview), anteprima con conteggi (nuove leghe/stagioni/squadre/partite, duplicate) senza scrittura DB, conferma con token transient → `from_openfootball_content()`
- [x] Correzione bug parser: la regex `= League, Season` ora accetta il formato spec senza `=` finale (le leghe/stagioni auto-create avevano slug vuoto)
- [x] **AC-05.4** pulsante "Importa da formazione (11 titolari)" nel form partita → popola 11 righe formazione (Titolare spuntato) per squadra, dati da `_lcTeamPlayers`; conferma JS
- [x] Verifica: lint (php -l, node --check), nnessun CDN/jQuery, smoke test log + HTTP su Docker live (preview→confirm, conferma team, bulk form)

### Fase 4 — Import batch / slug collision -2 / validazione (completata)

- [x] **Slug collision -2**: `ensure_team($name, $unique=true)` per Open Football (suffisso `-2`/`-3` via `unique_slug()`); `get_team_id` name-first per risolvere squadre create con slug suffissato; CSV/FR-21.2 skip mantiene comportamento
- [x] **Validazione pre-create**: in `process_match_data` il blocco match_type/gol/penalties/status/data è stato spostato *prima* di `ensure_league/season/team_id`, così righe cattive (gol fuori 0-99, dati mancanti, rigori non validi) producono errore per-riga `"Riga N:"` senza creare entità orfane; aggiunta validazione conteggio colonne (array_combine) con `continue` in `from_csv`/`csv_import_generic`
- [x] **SportsPress batch (FR-23 AC-23.3)**: `migrate_sportspress_teams/players/events` paginati `posts_per_page=50`; nuovo `sp_events_query_args()` con rilevamento chiave data (`sp_date`/`_sp_date`); `migrate_sportspress_events_batch($page,50,...)` paginabile + `migrate_static_entities()` separa entità statiche da eventi; endpoint AJAX `wp_ajax_lc_sp_migrate_batch` in `Admin`
- [x] **Driver AJAX** `admin/js/admin.js`: toggle "Importa in background (AJAX, lotti da 50)" in `view_import` (consigliato dataset grandi), polling batch con report progressivo + contatori entità statiche (leghe/stagioni/squadre/giocatori) e processati/total stimato eventi
- [x] Verifica: php -l su class-importer/class-admin OK; node --check admin.js/match-form.js OK; grep conferma 0 `posts_per_page => -1`

### Fase 5 — Timezone + calendar (completata)

- [x] **FR-19 AC-19.2**: `calendar()` esclude giornata 0 (`giornata > 0`) e `lc_match_day` richiede `day > 0` (già implementato in Fase 1)
- [x] **Timezone coerente**: import Open Football usa `current_time('Y-m-d')` (locale, come admin) invece di `date('Y-m-d', strtotime(...))` (TZ PHP) — coerente con roadmap "date coerenti con timezone sito"; `next-match.php` usa `current_time('timestamp')`
- [x] Verifica: php -l OK

### Admin partite potenziata (#50)

- [x] `Match_List_Table` (`WP_List_Table` subclass) in `includes/class-matches-list-table.php`: sostituito `LIMIT 100` manuale con paginazione nativa (50 righe/pag)
- [x] Filtri GET: campionato/stagione/tipo/giornata via dropdown `onchange=submit`, viste per stato (Tutte/Programmate/Giocate/Rinviate)
- [x] Sort cliccabile: `match_date`, `giornata`, `id`; colonne id/data/giornata/tipo/casa/ris/ospite/campionato/stagione/stato/azioni
- [x] Bulk actions inline (JS vanilla ES6 in `class-admin.php:view_matches` via `admin.js`): "Imposta giornata su selezionate" (prompt numerico), "Elimina selezionate" (confirm)
  - Coerenza: set giornata solo su partite stesso `league_id`+`season_id` (verifica client-side via `data-ls` + server-side); altrimenti avviso
  - Delete con RESTRICT: non elimina se esistono `match_goals`/`match_cards`/`match_players` correlati
- [x] AJAX handler `wp_ajax_lc_bulk_match_action` in `class-admin.php` + nonce localizzato `lc_bulk`
- [x] **Fix conteggio paginazione**: `prepare_items()` calcola `COUNT(*)` riusando `build_where_sql()` — prima il totale restava fisso a 769 ignorando i filtri (verificato: `lc_league=1` → 8 elementi, `lc_giornata=78` → 4 righe / 1 pagina)
- [x] **Fix link Modifica**: in `render_row_actions()` l'URL di edit era `?page=lc-football` (slug non registrato → "Non hai il permesso"); corretto a `?page=lc-football-matches`
- [x] Verifica live (cache purgata, utente `rusty`): filtri per campionato/giornata OK, sort `giornata` ASC (p.1 solo giornata 0, oltre 50 partite) e DESC (78,78,38), AJAX `set_giornata` su partite pair misti → "Seleziona solo partite dello stesso campionato e stagione.", AJAX `delete` RESTRICT su partita 552 (8 gol) → rifiutato e partita ancora presente in DB
- [x] Verifica: php -l class-matches-list-table + class-admin OK; righe 0 `posts_per_page => -1`; lint JS inline via `node --check`

### Giocatori: ricerca + filtri + paginazione

- [x] Nuova `Player_List_Table` (`WP_List_Table` subclass) in `includes/class-players-list-table.php`: sostituita la tabella statica (caricava tutti i giocatori, `ORDER BY name` senza filtri) con 50 righe/pagina
- [x] **Barra di ricerca** (`lc_q`): LIKE su `name`/`slug`/`nationality` via `esc_like`; campo chiamato `lc_q` (non `s`) perché `s` viene rimosso dagli URL di paginazione da `wp_removable_query_args`
- [x] **Filtri GET**: squadra (`lc_team`) e ruolo (`lc_pos`) dropdown, form GET autonomo con `page=lc-football-players` (stile `.lc-players-filters`)
- [x] Sort cliccabile su `name`/`number`/`id` (default `name ASC`); `COUNT(*)` con lo stesso WHERE della query (nessun totale fisso); colonne id/nome/#/ruolo/squadra/naz./azioni
- [x] Override `get_column_info()` + `#[\AllowDynamicProperties]` come per le partite; bulk transfer FR-20 e "Aggiungi giocatore" invariati
- [x] Verifica live (cache purgata): ricerca Marco→20 / Rossi→0 (con "Nessun giocatore trovato") / Giuseppe→9 / "a"→784 coerenti con DB; team=7→19; paginazione "1 di 16" per `lc_q=a` con link pagina che preservano `lc_q` e `paged=2` → "2 di 16"; edit=312 apre `form_player`; sort `number DESC`; nessun warning PHP (i match "Warning/deprecated" sono stringhe di traduzione Elementor); `php -l` OK

### Penalità: CRUD completo (Update mancante aggiunto)

- [x] Prima mancava **l'Update**: `Penalties::update()` esisteva ma nessun codice admin lo chiamava (si poteva solo eliminare e ricreare). Aggiunto il pulsante "Modifica" per riga → form precompilato ("Modifica penalità", `sub_action=update`, `penalty_id`, pulsante "Salva modifiche" + link "Annulla")
- [x] **Migrazione a `admin-post.php`**: i form penalità ora postano a `admin_post_lc_penalty_action` (pattern del resto del plugin) con `sub_action` add/update/delete — prima il POST avveniva sulla stessa pagina admin dove `wp_safe_redirect` falliva con "headers already sent" (il callback gira dopo la shell admin); ora il redirect funziona
- [x] Redirect post-azione con notifica: `saved=1`/`updated=1`/`deleted=1` e filtri preservati; nuovi casi `updated` e `error=invalid` ("Compila tutti i campi obbligatori.") in `show_notices()`; validazione server-side (team/campionato/stagione/punti > 0)
- [x] Filtri rinominati da `league_id`/`season_id` a `lc_league`/`lc_season` (coerenza con Partite/Giocatori); hidden nei form per preservare il filtro dopo il redirect
- [x] **Layout pagina**: la lista "Penalità" ora è mostrata per prima e sempre (senza obbligo di filtro campionato+stagione, con stato vuoto "Nessuna penalità presente."), il form "Nuova penalità"/"Modifica penalità" è spostato sotto la lista — prima la pagina portava subito al form di creazione

### `LC_List_Table` generica (Campionati/Stagioni/Squadre/Posizioni)

- [x] Nuova classe riusabile `includes/class-lc-list-table.php` (`WP_List_Table` subclass): config dichiarativa (`table`, `columns`, `sortable`, `primary`, `searchable`, `order_default`, `flags`) → ricerca `lc_q` (LIKE), ordinamento cliccabile, paginazione 50/pag, `COUNT(*)` con lo stesso WHERE, colonna primaria link a Modifica, flag booleani Sì/No, azioni Modifica/Elimina generiche; override `get_column_info()` per pagine admin custom
- [x] Le 4 tabelle statiche (ex helper `list_table()` rimosso) ora usano `LC_List_Table`: Campionati, Stagioni (default `name DESC`), Squadre (ricerca su nome/nome breve, colonna Auto-creata), Posizioni — ogni pagina con "Aggiungi…" + barra di ricerca via helper `render_list_top()`
- [x] CSS: `.lc-generic-filters` condiviso con `.lc-players-filters`
- [x] Verifica live (cache purgata): 4 pagine HTTP 200 con `lc-generic-list` e righe corrette (3/2/27/4); ricerca squadre `lc_q=It` → 2 elementi; sort `name DESC` → Virtus Entella; link primario nome → edit=12 apre `form_team`; delete URL corretto (`lc_delete_entity` + nonce); nessun warning PHP; `php -l` OK

### Fix import SportsPress (fatal `$wpdb` null)

- [x] `migrate_sportspress_teams()` usava `$wpdb->update()` (riga ~539) senza `global $wpdb;` → "Undefined variable $wpdb" + fatal "Call to a member function update() on null" al primo import SP. Aggiunto `global $wpdb;` a inizio metodo.
- [x] Verifica: `migrate_sportspress_teams`/`players`/`events`/`performances` ora dichiarano tutti `global $wpdb`; migrazione SP completa live senza fatal (teams_skipped 27, 0 errori), DB invariato (769 partite / 796 giocatori / 27 squadre)
- [x] `view_import()`: dopo `<?php endif; ?>` (riga 1751) le righe `global $wpdb; $leagues = ...; $seasons = ...;` erano fuori da un blocco `<?php` → il sorgente PHP veniva stampato come testo sotto la pagina Import. Aggiunto `<?php` di riapertura. Scan automatizzato: nessun'altra occorrenza di statement PHP "nudi" dopo `?>` in tutto il plugin. Verificato live (cache purgata): testo leakato assente, dropdown Campionato/Stagione popolati.
- [x] Notice "wpdb::prepare: Tipo di valore non supportato (array)" a fine import: SportsPress salva `sp_results` con `outcome` come **array** (`["loss"]`); `migrate_single_event` lo assegnava direttamente a `home_outcome`/`away_outcome` → `$wpdb->insert` (che usa prepare internamente) riceveva un array come valore. Aggiunto helper `sp_outcome_scalar()` che riduce a stringa (`["loss"]` → `"loss"`), usato alla lettura di `$res['outcome']`. Verificato: re-import di una partita con risultato → `home_outcome=loss`, `away_outcome=win`, 0 notice; DB invariato (769 partite / 1796 stat / 1838 gol).
- [x] Verifica live (cache purgata): add→302 `saved=1` + "Salvato." + riga in lista; edit=4 prefill corretto; update a 7 punti→302 `updated=1` + "Aggiornato." + `-7` in DB/lista; delete→302 `deleted=1` + riga rimossa; add con points=0→302 `error=invalid` + "Compila tutti i campi obbligatori." senza scrittura DB; conteggio finale tornato a 0 (righe di test rimosse); `php -l` OK

### Import Open Football TXT con mapping (anteprima interattiva)

- [x] **Mapping squadre** (globale per nome squadra): nell'anteprima ogni nome squadra sorgente ha dropdown squadre esistenti (pre-selezionata se il nome coincide già in LC) + "— Crea nuova —" con campo testo pre-compilato e modificabile; su conferma la squadra mappata a un id esistente viene riusata, il nome nuovo viene creato riusando un'eventuale squadra già esistente con quel nome (collisione slug `-2` invariata)
- [x] **Mapping campionato/stagione** (per sezione `= League, Season`): per ogni sezione distinta del file, selettore campionato + stagione verso entità esistenti (pre-selezionate per slug) oppure "crea nuova" col nome pre-compilato
- [x] **Flusso**: `preview_openfootball()` → form di mapping server-side (nessun JS, coerente D-16) con conteggi + tabella partite read-only → conferma POST `team_map[]/team_new_name[]/league_map[]/season_map[]` → `parse_of_mapping()` (sanitize_key/sanitize_text_field, id esistente se >0 altrimenti nome nuovo) → `from_openfootball_content($content, $mapping)`
- [x] **Importer**: nuovi helper `resolve_of_team/resolve_of_league/resolve_of_season` (mapping → id/nome, fallback auto-create invariato); `process_match_data` accetta `$home_team_id/$away_team_id` risolti (altrimenti i team rinominati verrebbero cercati col nome sorgente); duplicate ricalcolate a runtime dopo il mapping
- [x] CSS `.lc-of-mapping`/`.lc-of-label`; `php -l` OK su entrambi i file

### Bulk edit data/ora partite (view Partite)

- [x] Nuovo pulsante "Imposta data/ora su selezionate" nella barra bulk di `view_matches`: modal overlay vanilla JS (niente CDN, coerente D-16) con `<input type="date">` (obbligatoria) + `<input type="time">` (facoltativa); Esc/click sfondo/Annulla per chiudere
- [x] Se l'ora è vuota, ogni partita mantiene la propria ora corrente; se presente, viene applicata a tutte (formato `Y-m-d H:i`, letti via `strtotime`)
- [x] Avviso conferma se tra le selezionate c'è ≥1 partita già giocata: "Questa partita è già giocata o conclusa, sei sicuro di voler cambiare data e ora?" (Sì/No via `confirm()`; No = nessuna modifica)
- [x] Server: branch `set_datetime` in `handle_bulk_match_action` (nonce `lc_bulk`, validazione data `Y-m-d`/ora `H:i`, `IN ($in)` con id int); `original_date` intoccata; `data-status` aggiunto al checkbox (`class-matches-list-table.php`)
- [x] CSS `.lc-modal-backdrop`/`.lc-modal`/`.lc-dt-*`; verifica live: data+ora su più partite → reload + DB aggiornato; sola data → ora preservate; avviso played presente; data non valida → errore JSON; `set_giornata`/`delete` invariati

## [0.1.0] — 2026-07-24

### Revisione specifica

- [x] Nome brand: **LC Football** (League Control)
- [x] Schema database: **8 tabelle** — aggiunta `lc_match_goals` (eventi gol) e `lc_penalties` (penalità punti)
- [x] `lc_penalties`: gestione punti di penalità per squadra/campionato/stagione con colonna separata in classifica
- [x] `lc_matches.original_date` per gestione partite rinviate
- [x] Specifica completa scritta in `SPECS.md`
- [x] Architettura plugin definita
- [x] Sistema import: CSV, Open Football .txt, SportsPress migration
- [x] 6 shortcode previsti (con parametri `include_postponed`, `show_penalties`)
- [x] 6 widget Elementor previsti
- [x] Calciomercato giocatori (storico preservato)
- [x] Outcome auto-calcolato con override manuale
- [x] Layout home/away mirror per ultima partita (marcatori casa a sinistra, ospiti a destra)
- [x] Roadmap 7 fasi (~17 giorni)

### Prossimo passo

**Fase 1: Scheletro plugin + Database** — in attesa di conferma dall'utente
