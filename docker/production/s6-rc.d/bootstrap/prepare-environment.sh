#!/command/with-contenv sh

ENV_FILE_LOCATION=/app/.env

log_error() {
	printf "\033[0;31mERROR:\033[0m $1\n"
	exit 1
}

log_warning() {
	printf "\033[0;33mWARNING:\033[0m $1\n"
}

log_info() {
	printf "\033[0;34mINFO:\033[0m $1\n"
}

# Remove .env file if exists to recreate it.
rm -f $ENV_FILE_LOCATION

if [ -z "${CP_BASEURL}" ]
then
	log_error "CP_BASEURL must be set"
fi

if [ -z "${CP_MEDIA_BASEURL}" ]
then
	log_info "CP_MEDIA_BASEURL is empty, using CP_BASEURL by default"
	CP_MEDIA_BASEURL=$CP_BASEURL
fi

if [ -z "${CP_ADMIN_GATEWAY}" ]
then
	log_info "CP_ADMIN_GATEWAY is empty, using default \"cp-admin\""
	CP_ADMIN_GATEWAY="cp-admin"
fi

if [ -z "${CP_AUTH_GATEWAY}" ]
then
	log_info "CP_AUTH_GATEWAY is empty, using default \"cp-auth\""
	CP_AUTH_GATEWAY="cp-auth"
fi

if [ -z "${CP_ANALYTICS_SALT}" ]
then
	log_error "CP_ANALYTICS_SALT is empty, this is mandatory, generate a new one with tr -dc \\!\\#-\\&\\(-\\[\\]-\\_a-\\~ </dev/urandom | head -c 64"
fi

if [ -z "${CP_DATABASE_HOSTNAME}" ]
then
	log_warning "CP_DATABASE_HOSTNAME is empty, using default \"mariadb\""
	CP_DATABASE_HOSTNAME="mariadb"
fi

if [ -z "${CP_DATABASE_PREFIX}" ]
then
	log_info "CP_DATABASE_PREFIX is empty, using default \"cp_\""
	CP_DATABASE_PREFIX="cp_"
fi

if [ -z "${CP_DATABASE_NAME}" ]
then
	if [ -z "${MYSQL_DATABASE}" ]
	then
		log_error "When CP_DATABASE_NAME is empty, MYSQL_DATABASE must be set"
	fi

	log_warning "CP_DATABASE_NAME is empty, using mysql variable"
	CP_DATABASE_NAME="${MYSQL_DATABASE}"
fi

if [ -z "${CP_DATABASE_USERNAME}" ]
then
	if [ -z "${MYSQL_USER}" ]
	then
		log_error "When CP_DATABASE_USERNAME is empty, MYSQL_USER must be set"
	fi

	log_warning "CP_DATABASE_USERNAME is empty, using mysql variable"
	CP_DATABASE_USERNAME="${MYSQL_USER}"
fi

if [ -z "${CP_DATABASE_PASSWORD}" ]
then
	if [ -z "${MYSQL_PASSWORD}" ]
	then
		log_error "When CP_DATABASE_PASSWORD is empty, MYSQL_PASSWORD must be set"
	fi

	log_warning "CP_DATABASE_PASSWORD is empty, using mysql variable"
	CP_DATABASE_PASSWORD="${MYSQL_PASSWORD}"
fi

if [ ! -z "${CP_REDIS_HOST}" ]
then
	log_info "Using redis cache handler"
	CP_CACHE_HANDLER="redis"
	if [ -z "${CP_REDIS_PASSWORD}" ]
	then
		log_error "You must set CP_REDIS_PASSWORD when using redis as a cache handler."
	else
		CP_REDIS_PASSWORD="\"${CP_REDIS_PASSWORD}\""
	fi

	if [ -z "${CP_REDIS_PORT}" ]
	then
		log_info "CP_REDIS_PORT is empty, using default port \"6379\""
		CP_REDIS_PORT="6379"
	fi

	if [ -z "${CP_REDIS_DATABASE}" ]
	then
		log_info "CP_REDIS_DATABASE is empty, using default \"0\""
		CP_REDIS_DATABASE="0"
	fi
else
	log_info "Using file cache handler"
	CP_CACHE_HANDLER="file"
fi

if [ "${CP_MEDIA_FILE_MANAGER}" = "s3" ]
then
	if [ -z "${CP_MEDIA_S3_ENDPOINT}" ]
	then
		log_error "When CP_MEDIA_FILE_MANAGER is s3, CP_MEDIA_S3_ENDPOINT can't be empty"
	fi
	if [ -z "${CP_MEDIA_S3_KEY}" ]
	then
		log_error "When CP_MEDIA_FILE_MANAGER is s3, CP_MEDIA_S3_KEY can't be empty"
	fi
	if [ -z "${CP_MEDIA_S3_SECRET}" ]
	then
		log_error "When CP_MEDIA_FILE_MANAGER is s3, CP_MEDIA_S3_SECRET can't be empty"
	fi
	if [ -z "${CP_MEDIA_S3_REGION}" ]
	then
		log_error "When CP_MEDIA_FILE_MANAGER is s3, CP_MEDIA_S3_REGION can't be empty"
	fi
	if [ -z "${CP_MEDIA_S3_BUCKET}" ]
	then
		log_warning "CP_MEDIA_S3_BUCKET is empty, using default"
	fi
fi

cat << EOF > $ENV_FILE_LOCATION
app.baseURL="${CP_BASEURL}"
media.baseURL="${CP_MEDIA_BASEURL}"
EOF

if [ "${CP_DISABLE_HTTPS}" = "1" ]
then
	log_warning "HTTPS redirection is disabled for testing purposes, please enable it in production mode"
	echo "app.forceGlobalSecureRequests=false" >> $ENV_FILE_LOCATION
else
	echo "HTTPS redirection is enabled by default (mandatory to federate with the fediverse), use CP_DISABLE_HTTPS=1 to disable it for testing purposes"
fi

cat << EOF >> $ENV_FILE_LOCATION
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
	cat << EOF >> $ENV_FILE_LOCATION
cache.redis.host="${CP_REDIS_HOST}"
cache.redis.password=${CP_REDIS_PASSWORD}
cache.redis.port=${CP_REDIS_PORT}
cache.redis.database=${CP_REDIS_DATABASE}
EOF
fi

if [ "${CP_ENABLE_2FA}" = "true" ]
then
	cat << EOF >> $ENV_FILE_LOCATION
auth.enable2FA=true
EOF
fi

if [ "${CP_MEDIA_FILE_MANAGER}" = "s3" ]
then
	cat << EOF >> $ENV_FILE_LOCATION
media.fileManager=s3
media.s3.endpoint=${CP_MEDIA_S3_ENDPOINT}
media.s3.key=${CP_MEDIA_S3_KEY}
media.s3.secret=${CP_MEDIA_S3_SECRET}
media.s3.region=${CP_MEDIA_S3_REGION}
media.s3.bucket=${CP_MEDIA_S3_BUCKET}
EOF
fi

if [ ! -z "${CP_MEDIA_S3_PROTOCOL}" ]
then
	cat << EOF >> $ENV_FILE_LOCATION
media.s3.protocol=${CP_MEDIA_S3_PROTOCOL}
EOF
fi

if [ ! -z "${CP_MEDIA_S3_PATH_STYLE_ENDPOINT}" ]
then
	cat << EOF >> $ENV_FILE_LOCATION
media.s3.pathStyleEndpoint=${CP_MEDIA_S3_PATH_STYLE_ENDPOINT}
EOF
fi

if [ ! -z "${CP_MEDIA_S3_KEY_PREFIX}" ]
then
	cat << EOF >> $ENV_FILE_LOCATION
media.s3.keyPrefix=${CP_MEDIA_S3_KEY_PREFIX}
EOF
fi

if [ ! -z "${CP_EMAIL_SMTP_HOST}" ]
then
	if [ -z "${CP_EMAIL_SMTP_USERNAME}" ]
	then
		log_error "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_SMTP_USERNAME must be set"
	fi

	if [ -z "${CP_EMAIL_SMTP_PASSWORD}" ]
	then
		log_error "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_SMTP_PASSWORD must be set"
	fi

	if [ -z "${CP_EMAIL_FROM}" ]
	then
		log_error "When CP_EMAIL_SMTP_HOST is provided, CP_EMAIL_FROM must be set"
	fi

	cat << EOF >> $ENV_FILE_LOCATION
email.protocol="smtp"
email.SMTPHost="${CP_EMAIL_SMTP_HOST}"
email.SMTPUser=${CP_EMAIL_SMTP_USERNAME}
email.SMTPPass=${CP_EMAIL_SMTP_PASSWORD}
email.fromEmail=${CP_EMAIL_FROM}
EOF

	if [ ! -z "${CP_EMAIL_SMTP_PORT}" ]
	then
		cat << EOF >> $ENV_FILE_LOCATION
email.SMTPPort=${CP_EMAIL_SMTP_PORT}
EOF
	fi

	if [ ! -z "${CP_EMAIL_SMTP_CRYPTO}" ]
	then
		if [ "${CP_EMAIL_SMTP_CRYPTO}" != "ssl" ] && [ "${CP_EMAIL_SMTP_CRYPTO}" != "tls" ]
		then
			log_error "CP_EMAIL_SMTP_CRYPTO must be ssl or tls"
		fi
		cat << EOF >> $ENV_FILE_LOCATION
email.SMTPCrypto=${CP_EMAIL_SMTP_CRYPTO}
EOF
	fi
fi

log_info "Using config:"
cat $ENV_FILE_LOCATION

# prevent .env from being writable
chmod -w $ENV_FILE_LOCATION

#Run database migrations
/usr/local/bin/php /var/www/html/spark castopod:database-update

# clear cache to account for new assets and any change in data structure
/usr/local/bin/php /var/www/html/spark cache:clear
