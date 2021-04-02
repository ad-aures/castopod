FROM php:7.3-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -

RUN apt-get update && \
    apt-get install -y nodejs

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git vim
