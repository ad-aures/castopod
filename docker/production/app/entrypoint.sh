#!/bin/sh

ENV_FILE_LOCATION=/opt/castopod/.env

. /prepare_environment.sh
cat /uploads.template.ini | envsubst '$CP_MAX_BODY_SIZE$CP_MAX_BODY_SIZE_BYTES$CP_TIMEOUT$CP_PHP_MEMORY_LIMIT' > /usr/local/etc/php/conf.d/uploads.ini

/usr/sbin/crond -f /crontab.txt -L /dev/stdout &
/usr/local/sbin/php-fpm
