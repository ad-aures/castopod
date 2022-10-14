---
title: Installation
sidebarDepth: 3
---

# Comment installer Castopod ?

Castopod a été pensé pour être facile à installer. Que vous utilisiez un
hébergement dédié ou mutualisé, vous pouvez l'installer sur la plupart des
serveurs web compatibles avec PHP-MySQL.

::: tip Note

Nous avons publié des images officielles Docker pour Castopod!

Si vous préférez utiliser Docker, vous pouvez sauter cette partie et aller
directement à la [documentation Docker](./docker.md) pour Castopod.

:::

## Prérequis

- PHP v8.0 ou supérieure
- MySQL version 5.7 ou supérieure ou MariaDB version 10.2 ou supérieure
- Prise en charge HTTPS

### PHP v8.0 ou supérieure

PHP version 8.0 ou supérieure est requise, avec les extensions suivantes
installées :

- [intl](https://www.php.net/manual/fr/intl.requirements.php)
- [libcurl](https://www.php.net/manual/fr/curl.requirements.php)
- [mbstring](https://www.php.net/manual/fr/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) avec **JPEG**,
  **PNG** et bibliothèques **WEBP**.
- [exif](https://www.php.net/manual/fr/exif.installation.php)

De plus, assurez-vous que les extensions suivantes sont activées dans votre PHP
:

- json (activé par défaut - ne le désactivez pas)
- xml (activé par défaut - ne pas le désactiver)
- [mysqlnd](https://www.php.net/manual/fr/mysqlnd.install.php)

### Base de données compatible MySQL

> Nous vous recommandons d'utiliser [MariaDB](https://mariadb.org).

::: warning Warning

Castopod ne fonctionne qu'avec les bases de données MySQL 5.7 ou plus récentes.
Les versions 5.6 (dont le support a cessé le 5 février 2021) ou précédentes de
MySQL ne fonctionneront pas.

:::

Vous aurez besoin du nom d'hôte du serveur, du nom de la base de données, du nom
d'utilisateur et du mot de passe pour terminer le processus d'installation. Si
vous ne disposez pas de ces informations, veuillez contacter votre
administrateur.

#### Droits d'accès

L'utilisateur doit avoir au moins ces droits d'accès sur la base de données pour
que Castopod fonctionne : `CREATE`, `ALTER`, `DELETE`, `EXECUTE`,
`INDEX`,`INSERT`, `SELECT`, `UPDATE`,`REFERENCES`, `CREATE VIEW`.

### (Facultatif) FFmpeg v4.1.8 ou supérieur pour les clips vidéo

[FFmpeg](https://www.ffmpeg.org/) version 4.1.8 ou supérieure est requis si vous
souhaitez générer des Clips Vidéo. Les extensions suivantes doivent être
installées :

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

Le script d'installation crée un fichier `.env` à la racine du paquet. If you
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

## Paquets fournis par la communauté

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Install with YunoHost

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
