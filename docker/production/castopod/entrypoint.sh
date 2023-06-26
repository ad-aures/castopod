#!/bin/sh

ENV_FILE_LOCATION=/var/www/castopod/.env

. /prepare_environment.sh
cat /config.template.json | envsubst '$CP_MAX_BODY_SIZE_BYTES$CP_TIMEOUT' > /config.json

#Apply configuration after unit is started
(sleep 2 && curl -X PUT --data-binary @/config.json --unix-socket /var/run/control.unit.sock http://localhost/config/) &
supervisord
