#!/bin/bash

crowdr_project="curl"
crowdr_name_format="%s-%s"

crowdr_config="
#PHP CLI
curlwrapper build docker/php
curlwrapper volume $(pwd):/app
curlwrapper workdir /app

"
