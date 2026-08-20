# LC Football

**League Control Football** — Plugin WordPress sostitutivo di SportsPress.

## Cos'è

LC Football è un plugin WordPress che gestisce campionati, squadre, giocatori, partite e statistiche sportive. Nasce per sostituire completamente SportsPress in un sito editoriale calcistico con performance critiche dovute a:

- Query massicce non ottimizzate (`posts_per_page => -1`, loop PHP su 770+ eventi)
- Dati serializzati in `wp_postmeta` (EAV) che impediscono aggregazioni SQL dirette
- Picchi di RAM fino a 1.5G per page load della homepage

## Filosofia

| Principio | Descrizione |
|---|---|
| **Tabelle normalizzate** | Dati in colonne tipizzate, niente EAV, niente serializzazione PHP |
| **Query SQL dirette** | Una query = un risultato. Zero loop PHP su dataset completi |
| **Performance prima di tutto** | Le query aggreganti girano in MySQL, non in PHP |
| **Coesistenza** | Funziona fianco a fianco con SportsPress, migrazione graduale |
| **Niente sorprese** | Modifiche a giocatori/squadre non alterano lo storico delle partite |

## Confronto con SportsPress

| Aspetto | SportsPress | LC Football |
|---|---|---|
| **Classifica** | 4+ query `get_posts(-1)` + loop PHP su 770 eventi × N meta | 1 query SQL aggregata — ~5ms |
| **RAM per homepage** | ~1.5 GB | ~5-10 MB |
| **Archiviazione risultati** | `sp_results` serializzato in post_meta | `home_goals INT`, `away_goals INT` in tabella dedicata |
| **Autogol** | Non gestiti esplicitamente | Colonna `own_goals INT` in `lc_match_players` |
| **Cambio squadra giocatori** | Complesso (post_meta da aggiornare ovunque) | `team_id` su `lc_players` = squadra attuale. Storico in `lc_match_players.team_id` |
| **Import esterni** | Solo manuale | CSV, Open Football .txt, SportsPress migration |
| **Widget Elementor** | Solo shortcode | Widget Elementor nativi + shortcode |

## Versioni

- **0.5.0** (corrente): Fase 1 completa + rigori decisivi (FR-26), contratti shortcode §7, validazione §6.7, catalogo messaggi §8.5, form match §8.2, UI admin D-16 (Tom Select self-hosted + vanilla ES6), import §9. Schema DB `lc_football_db_version=0.5.0`.

## Rigori decisivi (FR-26)

Per i match a eliminazione (`cup`/`playoff`/`playout`) giocati in parità, la serie è registrata con conteggio (`penalties_home`/`penalties_away`) ma **non** modifica gol né statistiche (un tiro in dcr non è un gol). L'esito del match è derivato dal vincente della serie e viene mostrato come `2-2 (4-3 dcr)` nei widget `lc_last_match` e `lc_match_day`. I rigori si inseriscono dal form partita (sezione "Rigori decisivi") o via import (CSV `penalties_home,penalties_away`; Open Football `H-A (P-Q dcr)`; SportsPress `sp_results`).

## Shortcode

| Shortcode | Parametri |
|---|---|
| `[lc_next_match]` | `league`, `season` (INT>0 obbligatori), `include_friendly`, `include_postseason`, `include_cup`, `include_postponed` |
| `[lc_last_match]` | `league`, `season`, `include_friendly`, `include_postseason`, `include_cup` |
| `[lc_league_table]` | `league`, `season`, `limit`, `show_penalties` |
| `[lc_top_scorers]` | `league`, `season`, `limit`, `show_penalties` |
| `[lc_match_day]` | `league`, `season`, `day` |
| `[lc_calendar]` | `league`, `season`, `current` |

Le coppe/playoff sono **escluse di default** e vanno abilitate con i flag espliciti (AC-14.4).

## Import

- **CSV partite**: `league,season,match_type,match_date,giornata,home_team,away_team,home_goals,away_goals,status,venue` (+ `penalties_home,penalties_away`). Header case-insensitive, dedup idempotente, validazione per riga con messaggi `Riga N: [motivo].`
- **Open Football .txt**: header `= League, Season`, `Matchday N` / `▪ Round`, date con rollover mese, `HH:MM Home v Away`, `Home X-Y Away`, rigori `Home X-Y (P-Q dcr) Away`.
- **SportsPress**: migrazione completa (lega/stagione/squadre/giocatori/eventi/statistiche) con rigori decisivi da `sp_results`.

## Brand

| | |
|---|---|
| **Nome** | LC Football |
| **Acronimo** | LC (League Control) |
| **Slug** | `lc-football` |
| **Dominio consigliato** | lcfootball.com / lcfootball.it |
| **Target** | Siti editoriali calcistici, gestori di campionati amatoriali, giornalisti sportivi |
