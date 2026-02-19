####################################################
# Castopod CI/CD docker file
####################################################
# ⚠️ NOT optimized for production
# should be used only for continuous integration
#---------------------------------------------------
FROM php:8.5-fpm-alpine3.23

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

RUN \
    # install composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    # install ci requirements
    && apk add --no-cache \
        nodejs \
        # install npm for @semantic-release/npm
        npm \
        git \
        unzip \
        wget \
        jq \
        zip \
        openssh-client \
        rsync \
        icu-libs \
        mysql \
        mysql-client \
    && apk add --no-cache --virtual .php-ext-build-dep icu-dev \
    && docker-php-ext-install \
        intl \
        mysqli \
    && apk del .php-ext-build-dep \
    # install pnpm
    && npm install --global corepack@latest \
    && corepack enable pnpm \
    # set pnpm store directory
    && pnpm config set store-dir .pnpm-store \
    # set composer cache directory
    && composer config -g cache-dir .composer-cache
