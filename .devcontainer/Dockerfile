####################################################
# Castopod development Docker file
####################################################
# ⚠️ NOT optimized for production
# should be used only for development purposes
#---------------------------------------------------
FROM php:8.5-fpm

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install server requirements
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install --yes --no-install-recommends nodejs \
    # gnupg to sign commits with gpg
    gnupg \
    openssh-client \
    # cron for scheduled tasks
    cron \
    # unzip used by composer
    unzip \
    # required libraries to install php extensions using
    # https://github.com/mlocati/docker-php-extension-installer (included in php's docker image)
    libicu-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    # ffmpeg for video encoding
    ffmpeg \
    # intl for Internationalization
    && docker-php-ext-install intl  \
    && docker-php-ext-install zip \
    # gd for image processing
    && docker-php-ext-configure gd --with-webp --with-jpeg --with-freetype \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-enable exif \
    # redis extension for cache
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis \
    # mysqli for database access
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli
