FROM wordpress:latest

RUN apt-get -y update
RUN apt-get -y install git \
  curl \
  software-properties-common \
  gnupg \
  nodejs \
  vim \
  zlib1g-dev \
  libzip-dev \
  default-mysql-client \
  && docker-php-ext-install zip

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

WORKDIR /
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar \
  && mv wp-cli.phar /usr/local/bin/wp

RUN touch /usr/local/etc/php/conf.d/uploads.ini \
  && echo "file_uploads = On\nmemory_limit = 512M\nupload_max_filesize = 64M\npost_max_size = 64M\nmax_execution_time = 600" >> /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

USER www-data

COPY ./dist wp-content/themes/tcith
COPY ./plugins wp-content/plugins