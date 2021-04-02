# How to install Castopod <!-- omit in toc -->

Castopod was thought to be easy to install. Whether using dedicated or shared
hosting, you can install it on most PHP-MySQL compatible web servers.

## Table of contents <!-- omit in toc -->

- [Install instructions](#install-instructions)
  - [(optional) Manual configuration](#optional-manual-configuration)
- [Web Server Requirements](#web-server-requirements)
  - [PHP v7.3 or higher](#php-v73-or-higher)
  - [MySQL compatible database](#mysql-compatible-database)
    - [Privileges](#privileges)
  - [(Optional) Other recommendations](#optional-other-recommendations)
- [Security concerns](#security-concerns)

## Install instructions

0. Create a MySQL database for Castopod with a user having access and
   modification privileges (for more info, see
   [Web Server Requirements](#web-server-requirements)).
1. Download and unzip the Castopod package onto the web server if you haven’t
   already.
   - ⚠️ Set the web server document root to the `public/` sub-folder.
2. ⚠️ For broadcasting social activities to the fediverse, add a cron task on
   your web server to run every minute (replace the paths accordingly):

   ```php
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-activities
   ```

3. Run the Castopod install script by going to the install wizard page
   (`https://your_domain_name.com/cp-install`) in your favorite web browser.
4. Follow the instructions on your screen.

All done, start podcasting!

### (optional) Manual configuration

Before uploading Castopod files to your web server:

1. Rename the `.env.example` file to `.env` and update the default values with
   your own.
2. Upload the Castopod files with `.env`
3. Go to `/cp-install` to finish the install process.

## Web Server Requirements

### PHP v7.3 or higher

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- xml (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)

### MySQL compatible database

> We recommend using [MariaDB](https://mariadb.org)

You will need the server hostname, database name, username and password to
complete the installation process. If you do not have these, please contact your
server administrator.

#### Privileges

User must have at least these privileges on the database for Castopod to work:
`ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`, `UPDATE`.

### (Optional) Other recommendations

- Redis for better cache performances.
- CDN for better performances.
- e-mail gateway for lost passwords.

## Security concerns

Castopod is built on top of Codeigniter, a PHP framework that encourages
[good security practices](https://codeigniter.com/user_guide/concepts/security.html).

To maximize your instance safety and prevent any malicious attack, we recommend
you update all your Castopod files permissions (after installation to avoid any
permission error):

- `writable/` folder must be **readable** and **writable**.
- `public/media/` folder must be **readable** and **writable**.
- any other file must be set to **readonly**.

For instance, if you are using Apache or NGINX with Ubuntu you may do the
following:

```bash
sudo chown -R root:root /path/to/castopod
sudo chown -R www-data:www-data /path/to/castopod/writable
sudo chown -R www-data:www-data /path/to/castopod/public/media
```
