---
title: Installation
sidebarDepth: 3
---

# Wie installiere ich Castopod?

Castopod ist für eine einfache Installation konzipiert. Ob dediziertes oder
Shared-Hosting, du kannst es auf den meisten PHP-MySQL-kompatiblen Webservern
installieren.

::: tip Note

Wir haben offizielle Docker Images für Castopod veröffentlicht!

Wenn du Docker bevorzugst, kannst du die manuelle Anleitung überspringen und
direkt zur [Docker-Dokumentation](./docker.md) für Castopod gehen.

:::

## Voraussetzungen

- PHP v8.1 only
- MySQL Version 5.7 oder höher oder MariaDB Version 10.2 oder höher
- HTTPS-Unterstützung
- Eine [ntp-synchronisierte Uhr](https://wiki.debian.org/NTP) um die eingehenden
  Anfragen zu überprüfen

### PHP v8.1 only

PHP version 8.1 is required, with the following extensions installed:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) mit **JPEG**,
  **PNG** und **WEBP** Bibliotheken.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Stelle außerdem sicher, dass die folgenden Erweiterungen in deinem PHP aktiviert
sind:

- json (standardmäßig aktiviert - nicht ausschalten)
- xml (standardmäßig aktiviert - nicht ausschalten)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### MySQL kompatible Datenbank

> Wir empfehlen [MariaDB](https://mariadb.org).

::: warning Warning

Castopod funktioniert nur mit unterstützten MySQL 5.7 oder höher kompatiblen
Datenbanken. Es wird zum Beispiel mit dem vorherigen MySQL v5.6 nicht mehr
funktionieren, dessen Lebensende am 5. Februar 2021 war.

:::

Du benötigst den Servernamen, den Datenbanknamen, den Benutzernamen und das
Passwort, um den Installationsvorgang abzuschließen. Kontaktiere bitte den
Administrator, falls du keinen Benutzeraccount hast.

#### Berechtigungen

Benutzer müssen mindestens diese Berechtigungen in der Datenbank haben, damit
Castopod funktioniert: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`,
`INSERT`, `SELECT`, `UPDATE`, `REFERENCES`, `CREATE VIEW`.

### (Optional) FFmpeg v4.1.8 oder höher für Videoclips

[FFmpeg](https://www.ffmpeg.org/) Version 4.1.8 oder höher ist erforderlich,
wenn Du Videoclips generieren möchtest. Die folgenden Php-Erweiterungen sind
nicht installiert: %s:

- **FreeType 2** Bibliothek für
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Optional) Weitere Empfehlungen

- Redis für bessere Cache-Leistungen.
- CDN für das Caching statischer Dateien und bessere Leistungen.
- E-Mail Server Anbindung für E-Mails zu verlorenen Passwörtern.

## Installationsanleitung

### Voraussetzungen

0. Get a Web Server with [requirements](#requirements) installed
1. Create a MySQL database for Castopod with a user having access and
   modification privileges (for more info, see
   [MySQL compatible database](#mysql-compatible-database)).
2. Activate HTTPS on your domain with an _SSL certificate_.
3. Download and unzip the latest [Castopod Package](https://castopod.org/) onto
   the web server if you haven’t already.
   - ⚠️ Set the web server document root to the `public/` sub-folder within the
     `castopod` folder.
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

### (recommended) Install Wizard

1. Run the Castopod install script by going to the install wizard page
   (`https://your_domain_name.com/cp-install`) in your favorite web browser.
2. Follow the instructions on your screen.
3. Start podcasting!

::: info Note

The install script writes a `.env` file in the package root. If you cannot go
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

| Variable name           | Type    | Default     |
| ----------------------- | ------- | ----------- |
| **`endpoint`**          | string  | `undefined` |
| **`key`**               | string  | `undefined` |
| **`secret`**            | string  | `undefined` |
| **`region`**            | string  | `undefined` |
| **`bucket`**            | string  | `castopod`  |
| **`protocol`**          | number  | `undefined` |
| **`pathStyleEndpoint`** | boolean | `false`     |
| **`keyPrefix`**         | string  | `undefined` |

## Community packages

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Install with YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Install Castopod with YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>
