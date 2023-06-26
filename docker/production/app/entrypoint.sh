#!/bin/sh

ENV_FILE_LOCATION=/var/www/castopod/.env

# Fix ownership and permissions of castopod folders
chmod -R 750 /var/www/castopod
chown -R root:www-data /var/www/castopod
chown -R www-data:www-data /var/www/castopod/writable /var/www/castopod/public/media

. /prepare_environment.sh

supervisord
