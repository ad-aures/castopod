FROM docker.io/golang:1.25-bookworm AS CRON_BUILDER

ARG SUPERCRONIC_VERSION=v0.2.34

RUN apt-get update && \
    apt-get install -y git && \
    git clone https://github.com/aptible/supercronic.git && \
    cd supercronic && \
    git checkout $SUPERCRONIC_VERSION && \
    go build && \
    mv supercronic /usr/local/bin


FROM docker.io/php:8.4-fpm

COPY --from=CRON_BUILDER /usr/local/bin/supercronic /usr/local/bin/supercronic

COPY docker/production/common/prepare_environment.sh /prepare_environment.sh
COPY docker/production/app/entrypoint.sh /entrypoint.sh
COPY docker/production/common/uploads.template.ini /uploads.template.ini
COPY docker/production/common/crontab.txt /crontab.txt
COPY docker/production/app/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY castopod /var/www/castopod


RUN apt-get update && \
    apt-get install -y supervisor ffmpeg curl gettext-base libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev libpcre2-8-0 libicu-dev && \
    rm -rf /var/lib/apt/lists/* && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install mysqli gd intl exif && \
    docker-php-ext-enable mysqli gd intl exif redis && \
    chmod +x /entrypoint.sh && \
    chmod -R 750 /var/www/castopod && \
    chown -R root:www-data /var/www/castopod && \
    chown -R www-data:www-data /var/www/castopod/writable /var/www/castopod/public/media

WORKDIR /var/www/castopod
VOLUME /var/www/castopod/public/media
EXPOSE 9000

ENTRYPOINT [ "sh", "-c" ]
CMD [ "/entrypoint.sh" ]
