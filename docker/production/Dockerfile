####################################################
# Castopod's Production Dockerfile
####################################################
# An optimized Dockerfile for production using
# multi-stage builds:
#   1. BUNDLE castopod
#   2. BUILD the FrankenPHP/debian based prod image
#---------------------------------------------------
    
ARG PHP_VERSION="8.5"

####################################################
# BUNDLE STAGE
# -------------------------------------------------
# Bundle castopod for production using
# a PHP / Alpine image
#---------------------------------------------------
FROM php:${PHP_VERSION}-alpine3.23 AS bundle

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

COPY . /castopod-src
WORKDIR /castopod-src

COPY --from=composer:2.9 /usr/bin/composer /usr/local/bin/composer

RUN \
    # download GeoLite2-City archive and extract it to writable/uploads
    --mount=type=secret,id=maxmind-licence-key,env=MAXMIND_LICENCE_KEY \
    wget -c "https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=$MAXMIND_LICENCE_KEY&suffix=tar.gz" -O - | tar -xz -C ./writable/uploads/ \
    # rename extracted archives' folders
    && mv ./writable/uploads/GeoLite2-City* ./writable/uploads/GeoLite2-City

RUN \
    # install composer globally
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # install node and pnpm
    && apk add --no-cache \
        nodejs \
        pnpm \
        git \
        rsync \
    # install production dependencies only using the --no-dev option
    && composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress --ignore-platform-reqs \
    # install js dependencies based on lockfile
    && pnpm install --frozen-lockfile \
    # build all production static assets (css, js, images, icons, fonts, etc.)
    && pnpm run build \
    # create castopod folder bundle: uses .rsync-filter (-F) file to copy only needed files
    && rsync -aF . /castopod


####################################################
# BUILD STAGE
# -------------------------------------------------
# Define production image based on FrankenPHP /
# Debian with services managed by s6-overlay
#---------------------------------------------------
FROM serversideup/php:${PHP_VERSION}-frankenphp-trixie AS production

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

USER root

# Latest releases available at https://github.com/aptible/supercronic/releases
ARG SUPERCRONIC_URL=https://github.com/aptible/supercronic/releases/download/v0.2.42/supercronic-linux-amd64 \
    SUPERCRONIC_SHA1SUM=b444932b81583b7860849f59fdb921217572ece2 \
    SUPERCRONIC=supercronic-linux-amd64

# add supercronic to handle cron jobs
RUN \
    curl -fsSLO "$SUPERCRONIC_URL" \
    && echo "${SUPERCRONIC_SHA1SUM}  ${SUPERCRONIC}" | sha1sum -c - \
    && chmod +x "$SUPERCRONIC" \
    && mv "$SUPERCRONIC" "/usr/local/bin/${SUPERCRONIC}" \
    && ln -s "/usr/local/bin/${SUPERCRONIC}" /usr/local/bin/supercronic

ARG S6_OVERLAY_VERSION=3.2.2.0

# add s6-overlay process manager
ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-noarch.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-noarch.tar.xz
ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-x86_64.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-x86_64.tar.xz

# copy s6-overlay services
COPY --chown=www-data:www-data docker/production/s6-rc.d /etc/s6-overlay/s6-rc.d

# make prepare-environment executable for bootstrapping the Castopod environment
RUN chmod +x /etc/s6-overlay/s6-rc.d/bootstrap/prepare-environment.sh

RUN \
    apt-get update \
    && apt-get install -y \
        ffmpeg \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libicu-dev \
        && install-php-extensions \
        intl \
        mysqli \
        exif \
        gd \
    # As of PHP 7.4 we don't need to add --with-png
    && docker-php-ext-configure gd --with-webp --with-jpeg --with-freetype

# copy castopod bundle from bundle stage
COPY --from=bundle --chown=www-data:www-data /castopod /app

RUN \
    chmod -R 550 /app/ \
    && chmod -R 770 /app/public/media/ \
    && chmod -R 770 /app/writable/ \
    && chmod 750 /app/

ARG \
    PHP_MEMORY_LIMIT=512M \
    PHP_MAX_EXECUTION_TIME=300 \
    PHP_UPLOAD_MAX_FILE_SIZE=512M \
    PHP_POST_MAX_SIZE=512M \
    PHP_OPCACHE_ENABLE=1

ENV \
    PHP_MEMORY_LIMIT=${PHP_MEMORY_LIMIT} \
    PHP_MAX_EXECUTION_TIME=${PHP_MAX_EXECUTION_TIME} \
    PHP_UPLOAD_MAX_FILE_SIZE=${PHP_UPLOAD_MAX_FILE_SIZE} \
    PHP_POST_MAX_SIZE=${PHP_POST_MAX_SIZE} \
    PHP_OPCACHE_ENABLE=${PHP_OPCACHE_ENABLE}

USER www-data

ENTRYPOINT ["docker-php-serversideup-entrypoint"]
CMD ["/init"]
