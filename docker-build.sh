#!/bin/bash -eu
VERSION=0.1

docker build -t mt-compareval:${VERSION} . 

# docker run -it --rm -p 8080:8080 mt-compareval:${VERSION}
