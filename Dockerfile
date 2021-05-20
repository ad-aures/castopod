####################################################
# Castopod Host development Docker file
####################################################
# NOT optimized for production
# should be used only for development purposes
####################################################

FROM php:8.0-fpm

LABEL maintainer="Yassine Doghri <yassine@doghri.fr>"

COPY . /castopod-host
WORKDIR /castopod-host

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -

RUN apt-get update && \
    apt-get install -y nodejs

# Install git + vim
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git vim

### Install CodeIgniter's server requirements
#-- https://github.com/codeigniter4/appstarter#server-requirements

# Install intl extension using https://github.com/mlocati/docker-php-extension-installer
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    zlib1g-dev \
    && docker-php-ext-install intl

RUN docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN echo "file_uploads = On\n" \
         "memory_limit = 512M\n" \
         "upload_max_filesize = 500M\n" \
         "post_max_size = 512M\n" \
         "max_execution_time = 300\n" \
         > /usr/local/etc/php/conf.d/uploads.ini

# install cron
RUN apt-get update && \
    apt-get install -y cron

RUN crontab /castopod-host/crontab
