#!/bin/bash

# use 0.0.0.0 instead of localhost to accept connections from outside of the container
# https://stackoverflow.com/questions/25591413/docker-with-php-built-in-server
php -S 0.0.0.0:8080 -t ./www
