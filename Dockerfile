FROM wordpress:latest

MAINTAINER Collin Smith <cmdeveloped@gmail.com>

## install git and node/npm
RUN apt-get -y update
# subversion is needed for composer
RUN apt-get -y install git
# needed stuff for node
RUN apt-get -y install curl software-properties-common
RUN apt-get -y install gnupg
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y vim
WORKDIR /
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp
RUN usermod -u 1000 www-data
RUN touch /usr/local/etc/php/conf.d/uploads.ini \
    && echo "file_uploads = On\nmemory_limit = 64M\nupload_max_filesize = 64M\npost_max_size = 64M\nmax_execution_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini

COPY .bashrc /root

# For windows 10 compatibility
RUN sed -i 's/\r//' /root/.bashrc

WORKDIR /var/www/html
