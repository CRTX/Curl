#!/bin/bash

crowdr_project="curl"
crowdr_name_format="%s-%s"

crowdr_config="
#PHP CLI
php build docker/php
php volume $(pwd):/app
php workdir /app
php env TRAVIS=true
php env TRAVIS_JOB_ID=${TRAVIS_JOB_ID}

"
