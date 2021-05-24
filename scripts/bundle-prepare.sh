#!/bin/bash

# install only production dependencies using the --no-dev option
php composer.phar install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress --ignore-platform-reqs

# build all production UI assets
npm run build
