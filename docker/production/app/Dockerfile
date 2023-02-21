FROM docker.io/php:8.1-fpm-alpine3.17

COPY docker/production/app/entrypoint.sh /entrypoint.sh

COPY docker/production/app/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

RUN echo "* * * * * /usr/local/bin/php /opt/castopod/public/index.php scheduled-activities" > /crontab.txt && \
    echo "* * * * * /usr/local/bin/php /opt/castopod/public/index.php scheduled-websub-publish" >> /crontab.txt

# TODO: remove freetype (package and gd support) and ffmpeg
RUN apk add --no-cache libpng icu-libs freetype libwebp libjpeg-turbo libxpm ffmpeg && \
    apk add --no-cache --virtual .php-ext-build-dep freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev icu-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install gd intl mysqli exif && \
    docker-php-ext-enable mysqli gd intl exif && \
    apk del .php-ext-build-dep

COPY castopod /opt/castopod

RUN chmod 544 /entrypoint.sh && \
    chmod 444 /crontab.txt && \
    /usr/bin/crontab /crontab.txt

WORKDIR /opt/castopod

VOLUME /opt/castopod/public/media

EXPOSE 9000

ENTRYPOINT [ "sh", "-c" ]

CMD [ "/entrypoint.sh" ]
