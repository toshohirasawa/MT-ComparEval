FROM ubuntu:16.04

# install dependencies
RUN apt-get update && apt-get install -y \
  git \
  curl \
  zip \
  sqlite3 \
  php7.0-cli \
  php7.0-sqlite3 \
  php7.0-mbstring \
  php7.0-xml \
  php7.0-curl \
  && rm -rf /var/lib/apt/lists/*

# install MT-ComparEval
COPY . /mt-compareval
WORKDIR /mt-compareval
RUN cd /mt-compareval && bash bin/install.sh

# open 8080 for connection
EXPOSE 8080

# interface
CMD ["/bin/bash", "bin/server.sh"]
