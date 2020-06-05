FROM php:latest

RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt-get update && \
    apt-get install -y nodejs

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git vim
