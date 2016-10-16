FROM php:5.6-fpm

ENV PROJECT_ROOT /var/www/html

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        wget \
        git \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql

RUN echo "date.timezone = \"UTC\"" > /usr/local/etc/php/conf.d/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /tmp/app

ADD composer.json /tmp/app/composer.json
ADD composer.lock /tmp/app/composer.lock

RUN cd /tmp/app/ && composer install --quiet

ADD . /var/www/html
WORKDIR /var/www/html

RUN cp -a /tmp/app/vendor /var/www/html

RUN cd /var/www/html && wget https://www.adminer.org/static/download/4.2.5/adminer-4.2.5-mysql-en.php -O __a.php

EXPOSE 9000
