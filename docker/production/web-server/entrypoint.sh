#!/bin/sh
if [ -z "${CP_HOST_BACK}" ]
then
	echo "CP_HOST_BACK is empty, using default"
	CP_HOST_BACK="back"
fi

sed -i "s/CP_HOST_BACK/${CP_HOST_BACK}/" /etc/nginx/nginx.conf
nginx -g "daemon off;"
