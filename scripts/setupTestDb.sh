#!/bin/bash

export SYMFONY_ENV=test
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:schema:create
