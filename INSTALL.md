# How to install Castopod Host <!-- omit in toc -->

_Castopod Host_ was thought-out to be easy to install. Whether using dedicated
or shared hosting, you can install it on most PHP-MySQL compatible web servers.

## Table of contents <!-- omit in toc -->

- [Install instructions](#install-instructions)
  - [0. Pre-requisites](#0-pre-requisites)
  - [(recommended) Install Wizard](#recommended-install-wizard)
  - [(alternative) Manual configuration](#alternative-manual-configuration)
- [Web Server Requirements](#web-server-requirements)
  - [PHP v8.0 or higher](#php-v80-or-higher)
  - [MySQL compatible database](#mysql-compatible-database)
    - [Privileges](#privileges)
  - [(Optional) Other recommendations](#optional-other-recommendations)
- [Security concerns](#security-concerns)

## Install instructions

### 0. Pre-requisites

0. Get a Web Server with requirements installed
1. Create a MySQL database for Castopod Host with a user having access and
   modification privileges (for more info, see
   [Web Server Requirements](#web-server-requirements)).
2. Activate HTTPS on your domain with an _SSL certificate_.
3. Download and unzip the latest
   [Castopod Host Package](https://code.podlibre.org/podlibre/castopod-host/-/releases)
   onto the web server if you haven’t already.
   - ⚠️ Set the web server document root to the `public/` sub-folder.
4. Add a cron task on your web server to run every minute (replace the paths
   accordingly):

   ```php
      * * * * * /path/to/php /path/to/castopod-host/public/index.php scheduled-activities
   ```

   > ⚠️ Social features will not work properly if you do not set the task. It is
   > used to broadcast social activities to the fediverse.

### (recommended) Install Wizard

1. Run the Castopod Host install script by going to the install wizard page
   (`https://your_domain_name.com/cp-install`) in your favorite web browser.
2. Follow the instructions on your screen.
3. Start podcasting!

> **Note:**
>
> The install script writes a `.env` file in the package root. If you cannot go
> through the install wizard, you can
> [create and update the `.env` file manually](#alternative-manual-configuration).

### (alternative) Manual configuration

1. Rename the `.env.example` file to `.env` and update the default values with
   your own.
2. Upload the `.env` file to the Castopod Host Package root on your server.
3. Go to `/cp-install` to finish the install process.
4. Start podcasting!

## Web Server Requirements

### PHP v8.0 or higher

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) with **JPEG**,
  **PNG** and **WEBP** libraries.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- xml (enabled by default - don't turn it off)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### MySQL compatible database

> We recommend using [MariaDB](https://mariadb.org).

You will need the server hostname, database name, username and password to
complete the installation process. If you do not have these, please contact your
server administrator.

> NB. Castopod Host only works with supported MySQL compatible databases. It
> will break with MySQL v5.6 for example as its end of life was on February
> 5, 2021.

#### Privileges

User must have at least these privileges on the database for Castopod Host to
work: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`,
`UPDATE`.

### (Optional) Other recommendations

- Redis for better cache performances.
- CDN for static files caching and better performances.
- e-mail gateway for lost passwords.

## Security concerns

Castopod Host is built on top of Codeigniter, a PHP framework that encourages
[good security practices](https://codeigniter.com/user_guide/concepts/security.html).

To maximize your instance safety and prevent any malicious attack, we recommend
you update all your Castopod Host files permissions after installation (to avoid
any permission error):

- `writable/` folder must be **readable** and **writable**.
- `public/media/` folder must be **readable** and **writable**.
- any other file must be set to **readonly**.

For instance, if you are using Apache or NGINX with Ubuntu you may do the
following:

```bash
sudo chown -R root:root /path/to/castopod-host
sudo chown -R www-data:www-data /path/to/castopod-host/writable
sudo chown -R www-data:www-data /path/to/castopod-host/public/media
```
