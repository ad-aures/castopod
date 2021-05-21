#!/bin/bash

# install only dev dependencies using the --no-dev option
php composer.phar install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress --ignore-platform-reqs

# install js dependencies and build all production UI assets
npm install
npm run build
