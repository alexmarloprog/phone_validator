#!/usr/bin/env bash

if [ -z "$@" ]
then
    ./vendor/bin/phpunit tests/
else
    ./vendor/bin/phpunit --debug --verbose $@
fi