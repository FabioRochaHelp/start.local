FROM php:8.4-apache

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl

# Extensões PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Config Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Diretório da aplicação
WORKDIR /var/www/html

# Copia arquivos
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
