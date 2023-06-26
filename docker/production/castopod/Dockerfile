FROM docker.io/golang:1.20-bookworm AS CRON_BUILDER

ARG SUPERCRONIC_VERSION=v0.2.25

RUN apt-get update && \
    apt-get install -y git && \
    git clone https://github.com/aptible/supercronic.git && \
    cd supercronic && \
    git checkout $SUPERCRONIC_VERSION && \
    go build && \
    mv supercronic /usr/local/bin


FROM docker.io/php:8.1-cli AS UNIT_BUILDER

ARG UNIT_VERSION=1.29.0

RUN apt-get update && \
    apt-get install -y libpcre2-dev git && \
    mkdir -p /usr/lib/unit/modules && \
    git clone https://github.com/nginx/unit.git && \
    cd unit && \
    git checkout $UNIT_VERSION && \
    ./configure --prefix=/usr --state=/var/lib/unit --control=unix:/var/run/control.unit.sock --log=/var/log/unit.log --user=www-data --group=www-data --tmp=/tmp --modules=/usr/lib/unit/modules && \
    ./configure php && \
    make && \
    make install


FROM docker.io/php:8.1-cli

COPY --from=UNIT_BUILDER /usr/sbin/unitd /usr/sbin/unitd
COPY --from=UNIT_BUILDER /usr/lib/unit/ /usr/lib/unit/
COPY --from=CRON_BUILDER /usr/local/bin/supercronic /usr/local/bin/supercronic

COPY docker/production/common/prepare_environment.sh /prepare_environment.sh
COPY docker/production/castopod/entrypoint.sh /entrypoint.sh
COPY castopod /var/www/castopod
COPY docker/production/castopod/config.template.json /config.template.json
COPY docker/production/common/uploads.template.ini /uploads.template.ini
COPY docker/production/common/crontab.txt /crontab.txt
COPY docker/production/castopod/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN apt-get update && \
    apt-get install -y supervisor ffmpeg curl gettext-base libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev libpcre2-8-0 libicu-dev && \
    rm -rf /var/lib/apt/lists/* && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install mysqli gd intl exif && \
    docker-php-ext-enable mysqli gd intl exif redis && \
    ln -s /dev/stdout /var/log/unit.log && \
    mkdir -p /var/lib/unit && \
    chmod 544 /entrypoint.sh && \
    chmod -R 750 /var/www/castopod && \
    chown -R root:www-data /var/www/castopod && \
    chown -R www-data:www-data /var/www/castopod/writable /var/www/castopod/public/media

WORKDIR /var/www/castopod
VOLUME /var/www/castopod/public/media
EXPOSE 8000

ENTRYPOINT [ "sh", "-c" ]
CMD [ "/entrypoint.sh" ]
