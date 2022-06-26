FROM docker.io/alpine:3.13 AS ffmpeg-downloader

RUN apk add --no-cache curl && \
    curl https://johnvansickle.com/ffmpeg/releases/ffmpeg-release-amd64-static.tar.xz -o ffmpeg.tar.xz && \
    tar -xJf ffmpeg.tar.xz && \
    mv ffmpeg-5.0.1-amd64-static ffmpeg

FROM docker.io/php:8.0-fpm-alpine3.13

COPY docker/production/app/entrypoint.sh /entrypoint.sh

COPY docker/production/app/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

RUN echo "* * * * * /usr/local/bin/php /opt/castopod/public/index.php scheduled-activities" > /crontab.txt && \
    echo "* * * * 10 /usr/local/bin/php /opt/castopod/public/index.php scheduled-video-clips" >> /crontab.txt && \
    echo "* * * * * /usr/local/bin/php /opt/castopod/public/index.php scheduled-websub-publish" >> /crontab.txt

RUN apk add --no-cache libpng icu-libs freetype libwebp libjpeg-turbo libxpm ffmpeg && \
    apk add --no-cache --virtual .php-ext-build-dep freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev icu-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install gd intl mysqli exif && \
    docker-php-ext-enable mysqli gd intl exif && \
    apk del .php-ext-build-dep

COPY castopod /opt/castopod
COPY --from=ffmpeg-downloader /ffmpeg/ffmpeg /ffmpeg/ffprobe /ffmpeg/qt-faststart /usr/local/bin/

RUN chmod 544 /entrypoint.sh && \
    chmod 444 /crontab.txt && \
    /usr/bin/crontab /crontab.txt

WORKDIR /opt/castopod

VOLUME /opt/castopod/public/media

EXPOSE 9000

ENTRYPOINT [ "sh", "-c" ]

CMD [ "/entrypoint.sh" ]
