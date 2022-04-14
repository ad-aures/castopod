---
title: Oppdatering
sidebarDepth: 3
---

# Korleis oppdaterer eg Castopod?

Når du har installert Castopod, kan det vera lurt å oppdatera nettstaden din til
siste versjonen for å få nye funksjonar, ✨, feilrettingar 🐛 og betre yting ⚡.

## Framgangsmåte for å oppdatera automatisk

> Kjem snart... 👀

## Framgangsmåte for å oppdatera manuelt

1. Gå til
   [sida med utgjevingar](https://code.castopod.org/adaures/castopod/-/releases)
   og sjå om nettstaden din bruker siste utgåva av Castopod

   - jfr.
     [Kvar finn eg Castopod-versjonsnummeret?](#where-can-i-find-my-castopod-version)

2. Last ned den nyaste pakka som heiter `Castopod Package`, du kan velja mellom
   `zip`- eller `tar.gz`-arkiva

   - ⚠️ Pass på at du lastar ned programpakka, og **IKKJE** kjeldekoden

3. På vevtenaren din:

   - Fjern alle filene utanom `.env` og `public/media`
   - Kopier dei nye filene frå den nedlasta pakka til vevtenaren din

     ::: info

     Det kan henda du må nullstilla filtilgangsrettar slik du gjer når du
     installerer. Sjå [Tryggleiksspørsmål](./security.md).

     :::

4. Nokre utgjevingar kan ha fleire oppdateringsinstruksar (sjå
   [sida med utgjevingar](https://code.castopod.org/adaures/castopod/-/releases)).
   Det gjeld vanlegvis migreringsskript i `.sql`-format for å oppdatera
   databaseskjemaet ditt.

   - 👉 Pass på at du køyrer skripta i phpmyadmin-panelet ditt eller
     kommandolina for å oppdatera databasen i tillegg til pakkefilene!
   - jfr.
     [Eg har ikkje oppdatert på lenge… Kva skal eg gjera?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

5. Viss du bruker redis, må du tøma bufferen.
6. ✨ Ferdig!

## Vanlege spørsmål (FAQ)

### Kvar finn eg Castopod-versjonsnummeret?

Gå til styringspanelet for Castopod. Versjonsnummeret står i nedste venstre
hjørnet.

Du kan òg finna versjonsnummeret i `app > Config > Constants.php`-fila.

### Eg har ikkje oppdatert på lenge… Kva skal eg gjera?

Ingen problem! Berre last ned den siste utgåva som skildra over. Hugs berre at
når du går gjennom utgjevingsinstruksane (4), går du gjennom dei frå eldst til
nyast.

> Du bør truleg tryggingskopiera nettstaden din, avhengig av kor lenge sidan det
> er du oppdaterte Castopod.

Til dømes viss du er på `v1.0.0-alpha.42` og vil oppgradera til `v1.0.0-beta.1`:

0. (stekt tilrådd) Ta ein tryggingskopi av filene og databasen din.

1. Last ned siste utgåva, erstatt alle filene utanom `.env` og `public/media`.

2. Gå gjennom alle oppdateringsinstruksane frå eldst til nyast. Start med
   `v1.0.0-alpha.43`, `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Ferdig!

### Bør eg tryggingskopiera før eg oppdaterer?

Det bør du. Viss ikkje, kan du mista heile Castopod-nettstaden dersom noko går
gale!

I det heile bør du ta jamnlege tryggingskopiar av Castopod-filene og databasen
for å unngå å mista noko…
