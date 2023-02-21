#!/bin/sh
set -e

# install only production dependencies using the --no-dev option
composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress --ignore-platform-reqs

# build all production static assets (css, js, images, icons, fonts, etc.)
pnpm run build
pnpm run build:static
