# Base image: official PHP 8.1 FPM (Debian-based)
FROM php:8.1-fpm

# Install system dependencies (only what's needed for extensions/tools)
RUN apt-get update && apt-get install -y \
    git unzip zip \
    && docker-php-ext-install opcache

RUN apt-get update && apt-get install -y libyaml-dev \
    && pecl install yaml \
    && docker-php-ext-enable yaml

# Install Xdebug (compatible with PHP 8.1 is 3.1.x)
RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# Copy Xdebug config (you create this file in your project folder)
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Install Composer (from official Composer image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/project
