#!/bin/bash
# This script deletes language files not declared in the .i18n-filter file

set -e

# Exit if the directory isn't found
if [ ! -d $1 ]
then
    echo "$1 directory does not exist."
    exit
fi

cd $1

# Exit if the .i18n-filter isn't found
if [[ -f .i18n-filter ]]
then
    # delete all languages not present in .i18n-filter
    for i in *; do
        if ! grep -qxFe "$i" .i18n-filter; then
            echo "Deleting: $i"

            rm -rf "$i"
        fi
    done
else
    echo "$1/.i18n-filter file not found!"
    exit
fi
