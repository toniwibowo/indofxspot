FROM php:7.2.5-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install mysqli pdo pdo_pgsql
RUN a2enmod rewrite
COPY . /var/www/html