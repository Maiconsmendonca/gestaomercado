# Use the official PHP image as base
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    vim \
    libzip-dev \
    libsqlite3-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libxslt1-dev \
    libicu-dev \
    libssl-dev \
    libxml2-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql pdo_pgsql pdo_sqlite mbstring exif pcntl bcmath opcache zip soap xml curl

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Custom php.ini settings
RUN echo "date.timezone = America/Sao_Paulo" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/docker-php.ini

# Set working directory
WORKDIR /var/www/html

# Expose ports 9000 and 9003 for PHP-FPM and Xdebug
EXPOSE 9000 9003

# Start PHP-FPM
CMD ["php-fpm"]
