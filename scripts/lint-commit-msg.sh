#!/bin/bash

# see https://github.com/conventional-changelog/commitlint/issues/885

if [ "${CI_COMMIT_BEFORE_SHA}" = "0000000000000000000000000000000000000000" ]
then
    echo "commitlint from HEAD^"
    npx commitlint --from=HEAD^
else
    echo "commitlint from ${CI_COMMIT_BEFORE_SHA}"
    npx commitlint --from="${CI_COMMIT_BEFORE_SHA}"
fi
