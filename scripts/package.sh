#!/bin/bash

VERSION=$1

apt-get install zip -y

# create zip and tar.gz packages for release upload
zip -r castopod-host-$VERSION.zip castopod-host
tar -zcvf castopod-host-$VERSION.tar.gz castopod-host
