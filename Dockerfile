FROM php:7.2-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN a2enmod headers
RUN a2enmod rewrite

RUN apt-get update && apt-get -y --fix-missing install \
    nano unzip libaio-dev libxml2-dev libjpeg-dev \
	libpango1.0-dev libgif-dev libpng-dev git \
	telnet zlib1g-dev libicu-dev g++ vim build-essential \
    curl libevent-dev libssl-dev libev-dev librabbitmq-dev \
    libzmq3-dev wget gnupg

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

RUN apt-get update && apt-get -y --fix-missing install nodejs
	
# Composer install
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN /usr/local/bin/composer self-update --snapshot

RUN docker-php-ext-install bcmath soap \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd && docker-php-ext-install opcache
	
RUN docker-php-ext-install gettext zip
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-configure intl && docker-php-ext-install intl sockets pcntl
RUN pecl install event
RUN pecl install ev
RUN pecl install amqp
RUN pecl install zmq-beta
RUN docker-php-ext-enable event ev amqp zmq

#Add apache configs
ADD .docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf
ADD .docker/apache2.conf /etc/apache2/apache2.conf
ADD .docker/ports.conf /etc/apache2/ports.conf
ADD .docker/envvars /etc/apache2/envvars

ADD docker/php.ini /usr/local/etc/php/php.ini

RUN service apache2 restart
RUN rm -rf /var/www/var/cache/*
RUN chown -R www-data:www-data /var/www

RUN npm i -g npm

WORKDIR /var/www
