#!/bin/sh

ENV_FILE_LOCATION=/var/www/castopod/.env

. /prepare_environment.sh

#Apply configuration after unit is started
(sleep 2 && curl -X PUT --data-binary @/config.json --unix-socket /var/run/control.unit.sock http://localhost/config/) &
supervisord
