#!/bin/bash

VERSION=$1
COMPOSER_VERSION=$(echo "$VERSION" | perl -pe 's/(?<=[alpha|beta])\.//g')

# replace composer.json version using jq
echo "$( jq '.version = "'$COMPOSER_VERSION'"' composer.json )" > composer.json

# replace CP_VERSION constant in app/config/constants
sed -i "s/^defined('CP_VERSION').*/defined('CP_VERSION') || define('CP_VERSION', '$VERSION');/" ./app/Config/Constants.php

# download GeoLite2-City archive and extract it to writable/uploads
wget -c "https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=v3PguJMcmZMb9Ld0&suffix=tar.gz" -O - | tar -xz -C ./writable/uploads/

# rename extracted archives' folders
mv ./writable/uploads/GeoLite2-City* ./writable/uploads/GeoLite2-City

# create castopod folder bundle: uses .rsync-filter (-F) file to copy only needed files
rsync -aF --progress . ./castopod

# create zip and tar.gz packages for release upload
zip -r castopod-$VERSION.zip castopod
tar -zcvf castopod-$VERSION.tar.gz castopod
