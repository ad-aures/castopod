---
title: Installering
sidebarDepth: 3
---

# Korleis installerer eg Castopod?

Det er meininga at Castopod skal vera lett å installera. Uansett om du bruker
eige eller delt vevhotell, kan du installera på dei fleste maskiner som har PHP
og MySQL.

::: tip Notat

Me har laga offisielle Docker-biletfiler for Castopod!

Viss du helst vil bruka Docker, kan du hoppa over dette og gå rett til
[docker-dokumentasjonen](./docker.md) for Castopod.

:::

## Krav

- PHP v8.1 only
- MySQL versjon 5.7 eller nyare, eller MariaDB versjon 10.2 eller nyare
- Støtte for HTTPS
- Ei [ntp-synkronisert klokke](https://wiki.debian.org/NTP) for å stadfesta
  innkomande førespurnader frå allheimen

### PHP v8.1 only

PHP version 8.1 is required, with the following extensions installed:

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
eller eldre vil ikkje fungera, ettersom den versjonen vart forelda 5.
februar 2021.

:::

Du treng vertsnamnet til tenaren, databasenamnet, brukarnamnet og passordet til
databasen for å fullføra installeringa. Viss du ikkje har desse, må du kontakta
administratoren for tenarmaskina di.

#### Tilgangsrettar

Brukaren må minst ha desse tilgangsrettane på databasen for at Castopod skal
fungera: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`,
`UPDATE`, `REFERENCES`, `CREATE VIEW`.

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
4. Add **cron tasks** on your web server for various background processes
   (replace the paths accordingly):

   ```bash
      * * * * * /path/to/php /path/to/castopod/spark tasks:run >> /dev/null 2>&1
   ```

   **Note** - If you do not add this cron task, the following Castopod features
   will not work:

   - Importing a podcast from an existing RSS feed
   - Broadcasting social activities to your followers in the fediverse
   - Broadcasting episodes to open hubs using
     [WebSub](https://en.wikipedia.org/wiki/WebSub)
   - Generating video clips -
     [requires FFmpeg](#optional-ffmpeg-v418-or-higher-for-video-clips)

### (Tilrådd) Autoinstallering

1. Køyr Castopod-installasjonen ved å gå til autoinstalleringssida
   (`https://domenet_ditt.no/cp-install`) i nettlesaren din.
2. Fylg framgangsmåten på skjermen.
3. Start å podkasta!

::: info Notat

Installasjonsskriptet lagar ei`.env`-fil i rotmappa til pakka. If you cannot go
through the install wizard, you can create and edit the `.env` file manually
based on the `.env.example` file.

:::

### Email/SMTP setup

Email configuration is required for some features to work properly (eg.
retrieving your forgotten password, sending instructions to premium subscribers,
…)

You may add your email configuration in your instance's `.env` like so:

```ini
# […]

email.fromEmail="your_email_address"
email.SMTPHost="your_smtp_host"
email.SMTPUser="your_smtp_user"
email.SMTPPass="your_smtp_password"
```

#### Email config options

| Variable name    | Type                 | Default      |
| ---------------- | -------------------- | ------------ |
| **`fromEmail`**  | string               | `undefined`  |
| **`fromName`**   | string               | `"Castopod"` |
| **`SMTPHost`**   | string               | `undefined`  |
| **`SMTPUser`**   | string               | `undefined`  |
| **`SMTPPass`**   | string               | `undefined`  |
| **`SMTPPort`**   | number               | `25`         |
| **`SMTPCrypto`** | [`"tls"` or `"ssl"`] | `"tls"`      |

### Media storage

By default, files are saved to the `public/media` folder using the file system.
If you need to relocate the `media` folder to a different location, you can
specify it in your `.env` file as shown below:

```ini
# […]

media.root="media"
media.storage="/mnt/storage"
```

In this example, the files will be saved to the /mnt/storage/media folder. Make
sure to also update your web server configuration to reflect this change.

### S3

If you prefer storing your media files on an S3 compatible storage, you may
specify it in your `.env`:

```ini
# […]

media.fileManager="s3"
media.s3.endpoint="your_s3_host"
media.s3.key="your_s3_key"
media.s3.secret="your_s3_secret"
media.s3.region="your_s3_region"
```

#### S3 config options

| Variable name       | Type   | Default     |
| ------------------- | ------ | ----------- |
| **`endpoint`**      | string | `undefined` |
| **`nykjel`**        | tekst  | `udefinert` |
| **`løyndom`**       | tekst  | `udefinert` |
| **`region`**        | tekst  | `udefinert` |
| **`bytte`**         | tekst  | `castopod`  |
| **`protokoll`**     | tal    | `udefinert` |
| **`stilendepunkt`** | boolsk | `usant`     |
| **`keyPrefix`**     | tekst  | `udefinert` |

## Pakker frå brukarsamfunnet

Viss du ikkje vil bry deg med å installera Castopod manuelt, kan du bruka ei av
pakkene som brukarsamfunnet har laga.

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
