FROM php:8.2-fpm

# Install required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Install OpenSSL
RUN apt-get install -y openssl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer