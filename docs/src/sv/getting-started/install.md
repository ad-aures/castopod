---
title: Installation
sidebarDepth: 3
---

# Hur man installerar Castopod?

Castopod var tänkt att vara lätt att installera. Oavsett om du använder
dedikerade eller delade webbhotell kan du installera det på de flesta
PHP-MySQL-kompatibla webbservrar.

::: tips Anteckning

Vi har släppt officiella Docker-bilder för Castopod!

Om du föredrar att använda Docker, kan du hoppa över detta och gå direkt till
[dockerdokumentationen](./docker.md) för Castopod.

:::

## Krav

- PHP v8.1 or higher
- MySQL version 5.7 eller högre eller MariaDB version 10.2 eller högre
- Stöd för HTTPS
- An [ntp-synced clock](https://wiki.debian.org/NTP) to validate federation's
  incoming requests

### PHP v8.1 or higher

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) med **JPEG**,
  **PNG** och **WEBP** bibliotek.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Se dessutom till att följande tillägg är aktiverade i din PHP:

- json (aktiverad som standard - stäng inte av)
- xml (aktiverat som standard - stäng inte av)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### MySQL kompatibel databas

> Vi rekommenderar att du använder [MariaDB](https://mariadb.org).

::: varning Varning

Castopod fungerar endast med stödda MySQL 5.7 eller högre kompatibla databaser.
Den kommer att bryta med den tidigare MySQL v5.6 till exempel eftersom dess slut
var den 5 februari 2021.

:::

Du behöver serverns värdnamn, databasnamn, användarnamn och lösenord för att
slutföra installationen. Om du inte har dessa kontaktar du din
serveradministratör.

#### Privilegier

Användare måste ha minst dessa rättigheter i databasen för att Castopod ska
fungera: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`,
`UPDATE`, `REFERENCES`, `CREATE VIEW`.

### (Valfritt) FFmpeg v4.1.8 eller högre för videoklipp

[FFmpeg](https://www.ffmpeg.org/) version 4.1.8 eller högre krävs om du vill
generera videoklipp. Följande tillägg måste installeras:

- **FreeType 2** bibliotek för
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Valfritt) Andra rekommendationer

- Redis för bättre cache-prestanda.
- CDN för statiska filer caching och bättre prestanda.
- e-post gateway för förlorade lösenord.

## Installationsanvisningar

### Förutsättningar

0. Skaffa en webbserver med [krav](#requirements) installerat
1. Skapa en MySQL-databas för Castopod med en användare som har åtkomst till och
   modifieringsrättigheter (för mer info, se
   [MySQL-kompatibel databas](#mysql-compatible-database)).
2. Aktivera HTTPS på din domän med ett _SSL-certifikat_.
3. Ladda ner och packa upp det senaste [Castopod Package](https://castopod.org/)
   på webbservern om du inte redan har det.
   - ⚠️ Sätt webbserverdokumentroten till `public/` undermappen i mappen
     `castopod`.
4. Lägg till **cron-uppgifter** på din webbserver för olika bakgrundsprocesser
   (byt ut sökvägarna därefter):

   - För att sociala funktioner ska fungera korrekt, används denna uppgift för
     att sända sociala aktiviteter till dina anhängare på fediverse:

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-activities
   ```

   - För att dina episoder ska sändas på öppna hubbar vid publicering med
     [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /usr/local/bin/php /castopod/public/index.php scheduled-websub-publish
   ```

   - För att videoklipp ska skapas (se
     [FFmpeg krav](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-video-clips
   ```

   > Dessa uppgifter körs **varje minut**. Du kan ställa in frekvensen beroende
   > på dina behov: var 5, 10 minuter eller mer.

### (rekommenderas) Installationsguide

1. Kör Castopod install script genom att gå till installationsguiden sidan
   (`https://your_domain_name.com/cp-install`) i din favorit webbläsare.
2. Följ instruktionerna på din enhet.
3. Börja podcasting!

::: info Notering

Installationsskriptet skriver en `.env` -fil i paketroten. Om du inte kan gå via
installationsguiden kan du skapa och redigera `. nv` filen manuellt baserat på
`.env.example` filen.

:::

### Email/SMTP setup

E-postkonfiguration krävs för att vissa funktioner ska fungera korrekt (t.ex.
att hämta ditt glömda lösenord, skicka instruktioner till premiumprenumeranter,
…)

Du kan lägga till din e-postkonfiguration i din instans `.env` som så:

```ini
# […]

email.fromEmail="your_email_address"
email.SMTPHost="your_smtp_host"
email.SMTPUser="your_smtp_user"
email.SMTPPass="your_smtp_password"
```

#### Alternativ för e-postkonfiguration

| Variabelt namn   | Typ                     | Standard      |
| ---------------- | ----------------------- | ------------- |
| **`fromEmail`**  | sträng                  | `odefinierad` |
| **`fromName`**   | sträng                  | `"Castopod"`  |
| **`SMTPHost`**   | sträng                  | `odefinierad` |
| **`SMTPUser`**   | sträng                  | `odefinierad` |
| **`SMTPPass`**   | sträng                  | `odefinierad` |
| **`SMTPPort`**   | nummer                  | `25`          |
| **`SMTPCrypto`** | [`"tls"` eller `"ssl"`] | `"tls"`       |

### S3

By default, files are stored in the `public/media` folder using the filesystem.

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

| Variable name             | Type    | Default     |
| ------------------------- | ------- | ----------- |
| **`endpoint`**            | string  | `undefined` |
| **`key`**                 | string  | `undefined` |
| **`secret`**              | string  | `undefined` |
| **`region`**              | string  | `undefined` |
| **`bucket`**              | string  | `castopod`  |
| **`protocol`**            | number  | `undefined` |
| **`path_style_endpoint`** | boolean | `false`     |

## Gemenskapspaket

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Install with YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Installera Castopod med YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>
