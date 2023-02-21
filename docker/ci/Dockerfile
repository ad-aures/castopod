####################################################
# Castopod CI/CD docker file
####################################################
# ⚠️ NOT optimized for production
# should be used only for continuous integration
#---------------------------------------------------
FROM php:8.1-fpm-alpine3.17

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

RUN \
    # install composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    # install ci requirements
    && apk add --no-cache \
        nodejs \
        git \
        unzip \
        wget \
        jq \
        zip \
        rsync \
        mysql \
        mysql-client \
    && docker-php-ext-install \
        mysqli \
    # install pnpm
    && wget -qO- https://get.pnpm.io/install.sh | ENV="~/.shrc" SHELL="$(which sh)" sh - \
    && mv ~/.local/share/pnpm/pnpm /usr/bin/pnpm \
    && rm -rf ~/.local \
    # set pnpm store directory
    && pnpm config set store-dir .pnpm-store \
    # set composer cache directory
    && composer config -g cache-dir .composer-cache
