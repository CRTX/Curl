#!/bin/bash

crowdr_project="curlobject"
crowdr_name_format="%s-%s"

crowdr_config="
#PHP CLI
cli build docker/php
cli volume $(pwd):/app
cli workdir /app

"
