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
    && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom php.ini settings
COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Set working directory
WORKDIR /var/www/html

# Expose port 9000 and 9003 for PHP-FPM and Xdebug
EXPOSE 9000 9003

# Start PHP-FPM
CMD ["php-fpm"]

