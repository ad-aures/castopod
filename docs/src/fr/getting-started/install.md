---
title: Installation
sidebarDepth: 3
---

# Comment installer Castopod ?

Castopod a été pensé pour être facile à installer. Que vous utilisiez un
hébergement dédié ou mutualisé, vous pouvez l'installer sur la plupart des
serveurs web compatibles avec PHP-MySQL.

::: tip Note

We've released official Docker images for Castopod!

If you prefer using Docker, you may skip this and go straight to the
[docker documentation](./docker.md) for Castopod.

:::

## Prérequis

- PHP v8.0 ou supérieure
- MySQL version 5.7 ou supérieure ou MariaDB version 10.2 ou supérieure
- Prise en charge HTTPS

### PHP v8.0 ou supérieure

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](https://www.php.net/manual/fr/intl.requirements.php)
- [libcurl](https://www.php.net/manual/fr/curl.requirements.php)
- [mbstring](https://www.php.net/manual/fr/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) avec **JPEG**,
  **PNG** et bibliothèques **WEBP**.
- [exif](https://www.php.net/manual/fr/exif.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (activé par défaut - ne le désactivez pas)
- xml (activé par défaut - ne pas le désactiver)
- [mysqlnd](https://www.php.net/manual/fr/mysqlnd.install.php)

### Base de données compatible MySQL

> Nous vous recommandons d'utiliser [MariaDB](https://mariadb.org).

::: warning Warning

Castopod only works with supported MySQL 5.7 or higher compatible databases. It
will break with the previous MySQL v5.6 for example as its end of life was on
February 5, 2021.

:::

You will need the server hostname, database name, username and password to
complete the installation process. If you do not have these, please contact your
server administrator.

#### Droits d'accès

User must have at least these privileges on the database for Castopod to work:
`CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`, `UPDATE`.

### (Facultatif) FFmpeg v4.1.8 ou supérieur pour les clips vidéo

[FFmpeg](https://www.ffmpeg.org/) version 4.1.8 or higher is required if you
want to generate Video Clips. The following extensions must be installed:

- bibliothèque **FreeType 2** pour
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Facultatif) Autres recommandations

- Redis pour de meilleures performances de cache.
- CDN pour la mise en cache de fichiers statiques et de meilleures performances.
- passerelle e-mail pour les mots de passe perdus.

## Instructions d'installation

### Pré-requis

0. Obtenez un serveur Web avec [les pré-requis](#requirements) installés
1. Créer une base de données MySQL pour Castopod avec un utilisateur ayant les
   droits d'accès et les droits de modification (pour plus d'informations, cf.
   [base de données compatible MySQL](#mysql-compatible-database)).
2. Activez HTTPS sur votre domaine avec un _certificat SSL_.
3. Téléchargez et dézippez le dernier [paquet Castopod](https://castopod.org/)
   sur le serveur web si vous ne l'avez pas déjà fait.
   - ⚠️ Faites pointer la racine du document du serveur web vers le sous-dossier
     `public/` du dossier `castopod`.
4. Ajoutez les **tâches cron** sur votre serveur web pour les différents
   processus d'arrière-plan (définissez les chemins selon votre configuration) :

   - Pour que les fonctionnalités sociales fonctionnent correctement, cette
     tâche est utilisée pour diffuser des activités sociales à vos abonnés sur
     le Fédivers :

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-activities
   ```

   - Pour que vos épisodes soient diffusés sur les hubs ouverts à la publication
     en utilisant [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /usr/local/bin/php /castopod/public/index.php scheduled-websub-publish
   ```

   - Pour créer des clips vidéo (cf.
     [pré-requis FFmpeg](#ffmpeg-v418-or-higher-for-video-clips) ) :

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-video-clips
   ```

   > Ces tâches s'exécutent **toutes les minutes**. Vous pouvez régler la
   > fréquence en fonction de vos besoins : toutes les 5, 10 minutes ou plus.

### (Méthode recommandée) Assistant d'installation

1. Exécutez le script d'installation de Castopod en vous rendant sur la page
   d'assistant d'installation (`https://votre_domain_name.com/cp-install`) dans
   votre navigateur Web favori.
2. Suivez les instructions affichée.
3. Commencer à baladodiffuser !

::: info Note

The install script writes a `.env` file in the package root. If you cannot go
through the install wizard, you can
[create and update the `.env` file manually](#alternative-manual-configuration).

:::

## Paquets fournis par la communauté

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Installer avec YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Installer avec YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Dépôt
Github</a>

</div>
