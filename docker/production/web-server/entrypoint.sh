#!/bin/sh
if [ -z "${CP_APP_HOSTNAME}" ]
then
	echo "CP_APP_HOSTNAME is empty, using default"
	CP_APP_HOSTNAME="app"
fi

sed -i "s/CP_APP_HOSTNAME/${CP_APP_HOSTNAME}/" /etc/nginx/nginx.conf
nginx -g "daemon off;"
