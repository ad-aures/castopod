---
title: Installering
sidebarDepth: 3
---

# Korleis installerer eg Castopod?

Det er meininga at Castopod skal vera lett å installera. Uansett om du bruker
eige eller delt vevhotell, kan du installera på dei fleste maskiner som har PHP
og MySQL.

## Krav

- PHP v8.0 eller nyare
- MySQL versjon 5.7 eller nyare, eller MariaDB versjon 10.2 eller nyare
- Støtte for HTTPS

### PHP v8.0 eller nyare

PHP versjon 8.0 er eit krav, med desse utvidingane:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) med **JPEG**-,
  **PNG**- og **WEBP**-biblioteka.
- [exif](https://www.php.net/manual/en/exif.installation.php)

I tillegg må du passa på at desse utvidingane er skrudde på i PHP-installasjonen
din:

- json (vanlegvis aktivt - ikkje skru det av)
- xml (vanlegvis aktivt - ikkje skru det av)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### MySQL-kompatibel database

> Me tilrår [MariaDB](https://mariadb.org).

::: warning Åtvaring

Castopod verkar berre med databasar som støttar MySQL 5.7 eller nyare. MySQL 5.6
eller eldre vil ikkje fungera, ettersom den versjonen vart forelda i
februar 2021.

:::

Du treng vertsnamnet til tenaren, databasenamnet, brukarnamnet og passordet til
databasen for å fullføra installeringa. Viss du ikkje har desse, må du kontakta
administratoren for tenarmaskina di.

#### Tilgangsrettar

Brukaren må minst ha desse tilgangsrettane på databasen for at Castopod skal
fungera: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`,
`UPDATE`.

### (Eventuelt) FFmpeg v4.1.8 eller nyare for filmklypp

Du treng [FFmpeg](https://www.ffmpeg.org/) versjon 4.1.8 viss du vil laga
filmklypp. Desse utvidingane må vera installerte:

- **FreeType 2**-biblioteket for
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Eventuelt) Andre tilrådingar

- Redis for betre bufring.
- Innhaldsnettverk (CDN) for å bufra statiske filer og betra ytinga.
- Epostløysing for å nullstilla passord.

## Korleis du installerer

### Føresetnader

0. Få tak i ein vevtenar som fyller [krava](#requirements)
1. Lag ein MySQL-database for Castopod der brukaren har tilgangs- og
   endringsløyve (les meir om [MySQL-database](#mysql-compatible-database)).
2. Ta i bruk HTTPS på domenet ditt ved hjelp av eit _SSL-sertifikat_.
3. Last ned og pakk ut den nyaste [Castopod-pakka](https://castopod.org/) på
   vevtenaren din, om du ikkje allereie har gjort det.
   - ⚠️ Set dokumentrota til vevtenaren til undermappa `public/` i
     `castopod`-mappa.
4. Lag **cron-oppgåver** på vevtenaren din for ulike bakgrunnsprosessar (byt ut
   stiane så dei passar til oppsettet ditt):

   - For at sosiale funksjonar skal fungera, trengst denne oppgåva for å
     kringkasta sosiale aktivitetar til fylgjarane dine på fødiverset:

   ```bash
      * * * * * /sti/til/php /sti/til/castopod/public/index.php scheduled-activities
   ```

   - For å kringkasta episodane på opne nettnav som bruker
     [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /usr/local/bin/php /castopod/public/index.php scheduled-websub-publish
   ```

   - For å laga filmklypp (sjå
     [FFmpeg-krava](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /sti/til/php /sti/til/castopod/public/index.php scheduled-video-clips
   ```

   > Desse oppgåvene blir utførte **kvart minutt**. Du kan setja opp kor ofte du
   > treng å utføra oppgåvene: kvart 5., 10. minutt eller meir.

### (Tilrådd) Autoinstallering

1. Køyr Castopod-installasjonen ved å gå til autoinstalleringssida
   (`https://domenet_ditt.no/cp-install`) i nettlesaren din.
2. Fylg framgangsmåten på skjermen.
3. Start å podkasta!

::: info

Installasjonsskriptet lagar ei`.env`-fil i rotmappa til pakka. Viss du ikkje kan
bruka autoinstalleringa, kan du
[oppretta og oppdatera `.env`-fila manuelt](#alternative-manual-configuration).

:::

## Pakker frå brukarsamfunnet

Viss du ikkje vil bry deg med å installera Castopod manuelt, kan du bruka ei av
pakkene som brukarsamfunnet har laga. Det er tilhengjarar og brukarar av open
kjeldekode som lagar og vedlikeheld desse pakkene.

### Installer med Yunohost

[Yunohost](https://yunohost.org/) er ein Linux-distribusjon som er bygd på
Debian GNU/Linux og som inneheld frie og opne program. Yunohost tek seg av det
meste som har med oppsett av eigen vevtenar å gjera.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Installer Castopod med Yunohost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github-arkiv</a>

</div>

### Installer med Docker

Viss du vil bruka Docker til å installera Castopod, er det mogleg takk vere
[Romain de Laage](https://mamot.fr/@rdelaage)!

<a href="https://gitlab.utc.fr/picasoft/projets/services/castopod" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 mx-auto font-semibold text-center text-white rounded-md shadow gap-x-1 bg-[#1282d7] hover:no-underline hover:bg-[#0f6eb5]">Installer
med
Docker<svg viewBox="0 0 24 24" width="1em" height="1em" class="text-xl text-pine-200"><path fill="currentColor" d="m16.172 11-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg></a>

::: info

Etter som mange spør etter Docker-installasjon, planlegg me å laga ei offisiell
Docker-pakke for Castopod her i vårt eige arkiv.

:::
