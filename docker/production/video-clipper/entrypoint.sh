#!/bin/sh

if [ -z "${CP_DATABASE_HOSTNAME}" ]
then
	echo "CP_DATABASE_HOSTNAME is empty, using default"
	CP_DATABASE_HOSTNAME="mariadb"
fi

if [ -z "${CP_DATABASE_PREFIX}" ]
then
	echo "CP_DATABASE_PREFIX is empty, using default"
	CP_DATABASE_PREFIX="cp_"
fi

if [ -z "${CP_DATABASE_NAME}" ]
then
	if [ -z "${MYSQL_DATABASE}" ]
	then
		echo "When CP_DATABASE_NAME is empty, MYSQL_DATABASE must be set"
		exit 1
	fi

	echo "CP_DATABASE_NAME is empty, using mysql variable"
	CP_DATABASE_NAME="${MYSQL_DATABASE}"
fi

if [ -z "${CP_DATABASE_USERNAME}" ]
then
	if [ -z "${MYSQL_USER}" ]
	then
		echo "When CP_DATABASE_USERNAME is empty, MYSQL_USER must be set"
		exit 1
	fi

	echo "CP_DATABASE_USERNAME is empty, using mysql variable"
	CP_DATABASE_USERNAME="${MYSQL_USER}"
fi

if [ -z "${CP_DATABASE_PASSWORD}" ]
then
	if [ -z "${MYSQL_PASSWORD}" ]
	then
		echo "When CP_DATABASE_PASSWORD is empty, MYSQL_PASSWORD must be set"
		exit 1
	fi

	echo "CP_DATABASE_PASSWORD is empty, using mysql variable"
	CP_DATABASE_PASSWORD="${MYSQL_PASSWORD}"
fi

cat << EOF >> /opt/castopod/.env
database.default.hostname="${CP_DATABASE_HOSTNAME}"
database.default.database="${CP_DATABASE_NAME}"
database.default.username="${CP_DATABASE_USERNAME}"
database.default.password="${CP_DATABASE_PASSWORD}"
database.default.DBPrefix="${CP_DATABASE_PREFIX}"
EOF

echo "Using config:"
cat /opt/castopod/.env

supercronic /crontab.txt
