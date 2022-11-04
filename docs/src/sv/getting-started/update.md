---
title: Uppdatera
sidebarDepth: 3
---

# Hur uppdaterar man Castopod?

Efter att du installerat Castopod, kanske du vill uppdatera din instans till den
senaste -versionen för att njuta av de senaste funktionerna ✨, buggfixar 🐛 och
prestanda förbättringar ⚡.

## Uppdatera instruktioner

0. ⚠️ Innan någon uppdatering rekommenderar vi starkt att du säkerhetskopierar
   dina Castopod-filer och databas.

   - cf.
     [Ska jag göra en säkerhetskopia innan jag uppdaterar?](#should-i-make-a-backup-before-updating)

1. Gå till
   [releaser sidan](https://code.castopod.org/adaures/castopod/-/releases) och
   se om din instans är uppdaterad med den senaste Castopod versionen

   - cf.
     [Var hittar jag min Castopod-version?](#where-can-i-find-my-castopod-version)

2. Ladda ner det senaste utgivningspaketet som heter `Castopod Package`, du kan
   välja mellan `zip` eller `tar.gz` arkiv

   - ⚠️ Kontrollera att du laddar ner Castopod-paketet och **INTE** källkoden
   - Observera att du även kan ladda ner det senaste paketet från
     [castopod.org](https://castopod.org/)

3. På din server:

   - Ta bort alla filer utom `.env` och `publik/media`
   - Kopiera de nya filerna från det nedladdade paketet till din server

     ::: info Notering

     Du kan behöva återställa filrättigheter som under installationsprocessen.
     Kontrollera [säkerhetsbekymmer](./security.md).

     :::

4. Uppdatera ditt databasschema från din `Castopod Admin` > `Om` sida eller kör:

   ```bash
   php spark castopod:database-update
   ```

5. Rensa din cache från `Castopod Admin` > `Inställningar` > `allmän` >
   `Hushållning`
6. ✨ Njut av din färska instans, du är alla klara!

::: info Notering

Utgåvor kan komma med ytterligare uppdateringsinstruktioner (se
[utgåvor sidan](https://code.castopod.org/adaures/castopod/-/releases)).

- cf.
  [Jag har inte uppdaterat min instans på länge… Vad ska jag göra?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

:::

## Helt automatiserade uppdateringar

> Kommer snart... 👀

## Vanliga frågor (FAQ)

### Var hittar jag min Castopod-version?

Gå till din Castopod admin-panel, versionen visas längst ner till vänster hörn.

Alternativt kan du hitta versionen i `appen > Config > Constants.php` filen.

### Jag har inte uppdaterat min instans på länge… Vad ska jag göra?

Inga problem! Bara få den senaste versionen som beskrivs ovan. Endast när du går
genom utgivningsinstruktionerna (4), utför dem sekventiellt, från de äldsta till
de nyaste.

> Du kanske vill säkerhetskopiera din instans beroende på hur länge du inte har
> uppdaterat Castopod.

Till exempel, om du är på `v1.0.0-alpha.42` och vill uppgradera till
`v1.0.0-beta.1`:

0. (rekommenderas starkt) Gör en säkerhetskopia av dina filer och databaser.

1. Ladda ner den senaste utgåvan, skriv över dina filer samtidigt som du
   behåller `.env` och `public/media`.

2. Gå igenom varje utgåva uppdateringsinstruktioner sekventiellt (från äldsta
   till nyaste) börjar med `v1.0.0-alpha. 3`, `v1.0.0-alpha.44`,
   `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Njut av din färska instans, du är alla klara!

### Ska jag göra en säkerhetskopia innan jag uppdaterar?

Vi råder dig att göra, så att du inte förlorar allt om något går fel!

Mer generellt, rekommenderar vi att du gör regelbundna säkerhetskopior av dina
Castopod filer och databas för att hindra dig från att förlora allt…
