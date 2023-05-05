#!/bin/sh
if [ -z "${CP_APP_HOSTNAME}" ]
then
	echo "CP_APP_HOSTNAME is empty, using default"
	export CP_APP_HOSTNAME="app"
fi

if [ -z "${CP_MAX_BODY_SIZE}" ]
then
	export CP_MAX_BODY_SIZE=512M
fi

if [ -z "${CP_TIMEOUT}" ]
then
	export CP_TIMEOUT=900
fi

cat /nginx.template.conf | envsubst '$CP_APP_HOSTNAME$CP_MAX_BODY_SIZE$CP_TIMEOUT' > /etc/nginx/nginx.conf

nginx -g "daemon off;"
