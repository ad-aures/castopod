#!/bin/sh
set -e

# see https://github.com/conventional-changelog/commitlint/issues/885

if [ "${CI_COMMIT_BEFORE_SHA}" = "0000000000000000000000000000000000000000" ];
then
    echo "commitlint from HEAD^"
    pnpm exec commitlint --from=HEAD^
else
    echo "commitlint from ${CI_COMMIT_BEFORE_SHA}"
    br=`git branch -r --contains ${CI_COMMIT_BEFORE_SHA}`
    if [ ! -n $br ];
    then 
        pnpm exec commitlint --from=HEAD^
    else
        pnpm exec commitlint --from="${CI_COMMIT_BEFORE_SHA}"
    fi
fi
