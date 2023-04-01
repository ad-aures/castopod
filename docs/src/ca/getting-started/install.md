---
title: Instal·lació
sidebarDepth: 3
---

# Com instal·lar Castopod?

Castopod va ser pensat per ser fàcil d'instal·lar. Ja sigui utilitzant un
allotjament dedicat o un compartit, podeu instal·lar-lo a la majoria de
servidors web compatibles amb PHP-MySQL.

::: tip Nota

Hem publicat imatges oficials de Docker per a Castopod!

Si preferiu utilitzar Docker, podeu ometre això i anar directament a la
[documentació de Docker](./docker.md) per a Castopod.

:::

## Requisits

- PHP v8.1 o superior
- MySQL versió 5.7 o superior o MariaDB versió 10.2 o superior
- Support d'HTTPS
- An [ntp-synced clock](https://wiki.debian.org/NTP) to validate federation's
  incoming requests

### PHP v8.1 o superior

Es requereix PHP versió 8.1 o superior, amb les extensions següents
instal·lades:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) amb les llibreries
  **JPEG**, **PNG** i **WEBP**.
- [exif](https://www.php.net/manual/en/exif.installation.php)

A més, assegureu-vos que les extensions següents estiguin habilitades al vostre
PHP:

- json (activat per defecte; no el desactiveu)
- xml (activat per defecte; no el desactiveu)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### Base de dades compatible amb MySQL

> Us recomanem que utilitzeu [MariaDB](https://mariadb.org).

::: warning Avís

Castopod només funciona amb bases de dades compatibles amb MySQL 5.7 o superior.
No funcionarà amb l'anterior MySQL v5.6, per exemple, ja que el seu final de
vida va ser el 5 de febrer de 2021.

:::

Necessitareu el nom d'amfitrió del servidor (hostname), el nom de la base de
dades, el nom d'usuari i la contrasenya per completar el procés d'instal·lació.
Si no els teniu, poseu-vos en contacte amb l'administrador del vostre servidor.

#### Privilegis

User must have at least these privileges on the database for Castopod to work:
`CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`, `UPDATE`,
`REFERENCES`, `CREATE VIEW`.

### (Opcional) FFmpeg v4.1.8 o superior per fer videoclips

Si voleu generar videoclips, cal [FFmpeg](https://www.ffmpeg.org/) versió 4.1.8
o superior. Cal instal·lar les següents extensions:

- La llibreria **FreeType 2** per
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Opcional) Altres recomanacions

- Redis per a un millor rendiment de la memòria cau.
- CDN per a la memòria cau de fitxers estàtics i millors rendiments.
- Passarel·la de correu electrònic per a contrasenyes perdudes.

## Instruccions d'instal·lació

### Pre-requisits

0. Obteniu un servidor web amb els [requisits](#requirements) instal·lats
1. Creeu una base de dades MySQL per a Castopod amb un usuari amb privilegis
   d'accés i modificació (per a més informació, vegeu
   [base de dades compatible MySQL](#mysql-compatible-database)).
2. Activeu HTTPS al vostre domini amb un _certificat SSL_.
3. Baixeu i descomprimiu el darrer [paquet Castopod](https://castopod.org/) al
   servidor web si encara no ho heu fet.
   - ⚠️ Establiu l'arrel del document del servidor web a la subcarpeta
     `castopod/public/`.
4. Afegiu **tasques cron** al vostre servidor web per a diversos processos en
   segon pla (substituïu les rutes d'acord a la vostra configuració de fitxers):

   - Perquè les funcions socials funcionin correctament, aquesta tasca
     s'utilitza per transmetre activitats socials als vostres seguidors al
     Fediverse:

   ```bash
      * * * * * /ruta/al/php /ruta/al/castopod/public/index.php scheduled-activities
   ```

   - Per transmetre els vostres episodis en hubs oberts després de la publicació
     mitjançant [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /ruta/al/php /rutal/al/castopod/public/index.php scheduled-websub-publish
   ```

   - Per crear clips de vídeo (consulteu
     [requisits de FFmpeg](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /ruta/al/php /ruta/al/castopod/public/index.php scheduled-video-clips
   ```

   > Aquestes tasques s'executen **cada minut**. Podeu configurar la freqüència
   > segons les vostres necessitats: cada 5, 10 minuts o més.

### (recomanat) Assistent d'instal·lació

1. Executeu l'script d'instal·lació de Castopod anant a la pàgina web de
   l'assistent d'instal·lació (`https://exemple.com/cp-install`) al vostre
   navegador web preferit.
2. Seguiu les instruccions a la vostra pantalla.
3. Comenceu a fer podcasts!

::: info Nota

L'script d'instal·lació escriu un fitxer `.env` a l'arrel del paquet. If you
cannot go through the install wizard, you can create and edit the `.env` file
manually based on the `.env.example` file.

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

## Paquets de la comunitat

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Install with YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instal·lar Castopod amb YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Repositori
a Github</a>

</div>
