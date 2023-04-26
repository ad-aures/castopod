#!/bin/sh

ENV_FILE_LOCATION=/opt/castopod/.env

. /prepare_environment.sh

/usr/sbin/crond -f /crontab.txt -L /dev/stdout &
/usr/local/sbin/php-fpm
