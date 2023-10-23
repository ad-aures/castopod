#!/bin/sh

ENV_FILE_LOCATION=/var/www/castopod/.env

. /prepare_environment.sh
cat /config.template.json | envsubst '$CP_MAX_BODY_SIZE_BYTES$CP_TIMEOUT' > /usr/local/var/lib/unit/conf.json

supervisord
