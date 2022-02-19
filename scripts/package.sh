#!/bin/bash
set -e

VERSION=$1

apt-get install zip -y

# create zip and tar.gz packages for release upload
zip -r castopod-$VERSION.zip castopod
tar -zcvf castopod-$VERSION.tar.gz castopod
