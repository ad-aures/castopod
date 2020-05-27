FROM php:latest

COPY ./src /castopod
WORKDIR /castopod

### Install CodeIgniter's server requirements
#-- https://github.com/codeigniter4/appstarter#server-requirements

# Install intl extension using https://github.com/mlocati/docker-php-extension-installer
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl
