---
title: Oppdatering
sidebarDepth: 3
---

# Korleis oppdaterer eg Castopod?

Når du har installert Castopod, kan det vera lurt å oppdatera nettstaden din til
siste versjonen for å få nye funksjonar, ✨, feilrettingar 🐛 og betre yting ⚡.

## Korleis du oppdaterer

0. ⚠️ Før du oppdaterer, rår me sterkt til at du tek ein tryggingskopi av filene
   og databasen til Castopod.

   - Les
     [bør eg ta ein tryggingskopi før eg oppdaterer?](#should-i-make-a-backup-before-updating)

1. Gå til
   [utgjevingssida](https://code.castopod.org/adaures/castopod/-/releases) og
   sjå om nettstaden din er oppdatert til den siste utgåva av Castopod

   - Les
     [Kvar finn eg Castopod-versjonen min?](#where-can-i-find-my-castopod-version)

2. Last ned den siste utgåva som heiter `Castopod Package`, du kan velja mellom
   `zip`- eller `tar.gz`-arkiv

   - ⚠️ Pass på at du lastar ned Castopod-pakka, og **IKKJE** kjeldekoden
   - Hugs at du kan lasta ned den nyaste programpakka frå
     [castopod.org](https://castopod.org/)

3. Gjer dette på tenaren din:

   - Slett alle filene utanom `.env` og `public/media`
   - Kopier dei nye filene frå den nedlasta programpakka over til tenaren din

     ::: Hugs

     Det kan henda du må nullstilla filtilgangane til det dei var under
     installasjonsprosessen. Les [tryggingsspørsmåla](./security.md).

     :::

4. Oppdater databaseskjemaet ditt på `Castopod admin` > `Om`-sida, eller ved å
   køyra:

   ```bash
   php spark castopod:database-update
   ```

5. Tøm mellomlageret på `Castopod admin` > `Innstillingar` > `generelt` >
   `Opprydding`
6. ✨ No er du ferdig og kan bruka den flotte nye nettstaden din!

::: Hugs

Det hender at ugjevingar har sine eigne oppdateringsinstruksar (sjå
[utgjevingssida](https://code.castopod.org/adaures/castopod/-/releases)).

- sjå
  [Eg har ikkje oppdatert nettstaden min på lenge… Kva bør eg gjera?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

:::

## Heilautomatiske oppdateringar

> Kjem snart... 👀

## Vanlege spørsmål (FAQ)

### Kvar finn eg Castopod-versjonsnummeret?

Gå til styringspanelet for Castopod. Versjonsnummeret står nede i venstre
hjørna.

Eventuelt kan du finna versjonsnummeret i `app > Oppsett > Constants.php`-fila.

### Eg har ikkje oppdatert på lenge… Kva skal eg gjera?

Ingen problem! Berre få tak i siste utgåva som skildra over. Hugs berre å utføra
utgjevingsinstruksjonane (4) i rekkjefylgje frå eldst til nyast.

> Du bør truleg tryggingskopiera nettstaden din, avhengig av kor lenge sidan det
> er du oppdaterte Castopod.

Viss du til dømes er på `v1.0.0-alpha.42` og vil oppgradera til `v1.0.0-beta.1`:

0. (stekt tilrådd) Ta ein tryggingskopi av filene og databasen din.

1. Last ned siste utgåva, erstatt alle filene utanom `.env` og `public/media`.

2. Gå gjennom alle oppdateringsinstruksane frå eldst til nyast. Start med
   `v1.0.0-alpha.43`, `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Ferdig!

### Bør eg tryggingskopiera før eg oppdaterer?

Gjer det, slik at du ikkje mistar alt viss noko går gale!

Generelt rår me til at du tek tryggingskopi av Castopod-filene og databasen din
slik at du ikkje mistar alt…
