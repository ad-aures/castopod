FROM php:7.2-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt-get update && \
    apt-get install -y nodejs

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git vim
