#!/bin/sh

if [ -z "${CP_BASEURL}" ]
then
	echo "CP_BASEURL must be set"
	exit 1
fi

if [ -z "${CP_MEDIA_BASEURL}" ]
then
	echo "CP_MEDIA_BASEURL is empty, leaving empty by default"
fi

if [ -z "${CP_ADMIN_GATEWAY}" ]
then
	echo "CP_ADMIN_GATEWAY is empty, using default"
	CP_ADMIN_GATEWAY="cp-admin"
fi

if [ -z "${CP_AUTH_GATEWAY}" ]
then
	echo "CP_AUTH_GATEWAY is empty, using default"
	CP_AUTH_GATEWAY="cp-auth"
fi

if [ -z "${CP_ANALYTICS_SALT}" ]
then
	echo "CP_ANALYTICS_SALT is empty, this is mandatory, generate a new one with tr -dc \\!\\#-\\&\\(-\\[\\]-\\_a-\\~ </dev/urandom | head -c 64"
	exit 1
fi

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

if [ ! -z "${CP_REDIS_HOST}" ]
then
	echo "Using redis cache handler"
	CP_CACHE_HANDLER="redis"
	if [ -z "${CP_REDIS_PASSWORD}" ]
	then
		echo "CP_REDIS_PASSWORD is empty, using default"
		CP_REDIS_PASSWORD="null"
	else
		CP_REDIS_PASSWORD="\"${CP_REDIS_PASSWORD}\""
	fi

	if [ -z "${CP_REDIS_PORT}" ]
	then
		echo "CP_REDIS_PORT is empty, using default"
		CP_REDIS_PORT="6379"
	fi

	if [ -z "${CP_REDIS_DATABASE}" ]
	then
		echo "CP_REDIS_DATABASE is empty, using default"
		CP_REDIS_DATABASE="0"
	fi
else
	echo "Using file cache handler"
	CP_CACHE_HANDLER="file"
fi

cat << EOF > /var/www/castopod/.env
app.baseURL="${CP_BASEURL}"
media.baseURL="${CP_MEDIA_BASEURL}"
EOF

if [ "${CP_DISABLE_HTTPS}" = "1" ]
then
	echo "HTTPS redirection is disabled for testing purposes, please enable it in production mode"
	echo "app.forceGlobalSecureRequests=false" >> /var/www/castopod/.env
else
	echo "HTTPS redirection is enabled by default (mandatory to federate with the fediverse), use CP_DISABLE_HTTPS=1 to disable it for testing purposes"
fi

cat << EOF >> /var/www/castopod/.env
admin.gateway="${CP_ADMIN_GATEWAY}"
auth.gateway="${CP_AUTH_GATEWAY}"

analytics.salt="${CP_ANALYTICS_SALT}"

database.default.hostname="${CP_DATABASE_HOSTNAME}"
database.default.database="${CP_DATABASE_NAME}"
database.default.username="${CP_DATABASE_USERNAME}"
database.default.password="${CP_DATABASE_PASSWORD}"
database.default.DBPrefix="${CP_DATABASE_PREFIX}"

cache.handler="${CP_CACHE_HANDLER}"
EOF

if [ "${CP_CACHE_HANDLER}" = "redis" ]
then
	cat << EOF >> /var/www/castopod/.env
cache.redis.host="${CP_REDIS_HOST}"
cache.redis.password=${CP_REDIS_PASSWORD}
cache.redis.port=${CP_REDIS_PORT}
cache.redis.database=${CP_REDIS_DATABASE}
EOF
fi

if [ ! -z "${CP_EMAIL_SMTP_HOST}" ]
then
	if [ -z "${CP_EMAIL_SMTP_USERNAME}" ]
	then
		echo "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_SMTP_USERNAME must be set"
		exit 1
	fi

	if [ -z "${CP_EMAIL_SMTP_PASSWORD}" ]
	then
		echo "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_SMTP_PASSWORD must be set"
		exit 1
	fi

	if [ -z "${CP_EMAIL_FROM}" ]
	then
		echo "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_FROM must be set"
		exit 1
	fi

	cat << EOF >> /var/www/castopod/.env
email.protocol="smtp"
email.SMTPHost="${CP_EMAIL_SMTP_HOST}"
email.SMTPUser=${CP_EMAIL_SMTP_USERNAME}
email.SMTPPass=${CP_EMAIL_SMTP_PASSWORD}
email.fromEmail=${CP_EMAIL_FROM}
EOF

	if [ ! -z "${CP_EMAIL_SMTP_PORT}" ]
	then
		cat << EOF >> /var/www/castopod/.env
email.SMTPPort=${CP_EMAIL_SMTP_PORT}
EOF
	fi

	if [ ! -z "${CP_EMAIL_SMTP_CRYPTO}" ]
	then
		if [ "${CP_EMAIL_SMTP_CRYPTO}" != "ssl" ] && [ "${CP_EMAIL_SMTP_CRYPTO}" != "tls" ]
		then
			echo "CP_EMAIL_SMTP_CRYPTO must be ssl or tls"
			exit 1
		fi
		cat << EOF >> /var/www/castopod/.env
email.SMTPCrypto=${CP_EMAIL_SMTP_CRYPTO}
EOF
	fi
fi

unitd --no-daemon &
php spark castopod:database-update
sleep 2 && curl -X PUT --data-binary @/config.json --unix-socket /var/run/control.unit.sock http://localhost/config/
supercronic /crontab.txt
