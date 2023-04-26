FROM docker.io/php:8.1-bullseye

ENV SUPERCRONIC_VERSION=v0.2.1

COPY docker/production/video-clipper/entrypoint.sh /entrypoint.sh

RUN echo "* * * * * /usr/local/bin/php /opt/castopod/public/index.php scheduled-video-clips" >> /crontab.txt

RUN apt update && \
    apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev libicu-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install mysqli gd intl && \
    docker-php-ext-enable mysqli gd intl

RUN apt update && \
    apt install -y ffmpeg curl && \
    curl -OL https://github.com/aptible/supercronic/releases/download/$SUPERCRONIC_VERSION/supercronic-linux-amd64 && \
    mv supercronic-linux-amd64 /usr/local/bin/supercronic && \
    chmod +x /usr/local/bin/supercronic

COPY castopod /opt/castopod

RUN chmod 544 /entrypoint.sh && \
    chmod 444 /crontab.txt

WORKDIR /opt/castopod

VOLUME /opt/castopod/public/media

ENTRYPOINT [ "sh", "-c" ]

CMD [ "/entrypoint.sh" ]
