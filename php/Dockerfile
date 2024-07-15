FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libxpm-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libxml2-dev \
    libonig-dev  # Instalando libonig-dev

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl gd sockets zip intl soap

# Configurar a extensão GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instalar Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

# CMD (ou ENTRYPOINT) para iniciar sua aplicação (substitua isto pelo seu comando de inicialização)
# CMD ["php-fpm"]