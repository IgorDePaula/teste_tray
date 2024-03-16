FROM composer:2.2 AS composer

FROM php:8.1-apache
ARG USER
ARG UPLOAD
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN apt-get update && apt-get install -y \
        unzip \
        git \
        zip \
        nano \
        curl \
        zlib1g-dev \
        libzip-dev \
        libxml2-dev \
        libpng-dev \
        gnupg2 \
    && docker-php-ext-install -j$(nproc) zip sockets pdo pdo_mysql mysqli dom gd intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
RUN a2enmod rewrite
RUN echo "export APACHE_DOCUMENT_ROOT=/var/www/public" >> /etc/apache2/envvars
RUN sed -ri -e 's/\/var\/www\/html/${APACHE_DOCUMENT_ROOT}/g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's/\/var\/www/${APACHE_DOCUMENT_ROOT}/g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN mkdir -p /var/www/storage/logs/
RUN echo 'xdebug.mode=coverage' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN useradd ${USER}
USER ${USER}
