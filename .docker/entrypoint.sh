#!/bin/sh
set -e

APP_DIR="/var/www/html"

if [ -f "$APP_DIR/composer.json" ]; then
    if [ ! -d "$APP_DIR/vendor" ] || [ -z "$(ls -A "$APP_DIR/vendor" 2>/dev/null)" ]; then
        echo "Instalando dependências PHP (composer)..."
        composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts
    fi
fi

if [ -n "$DB_HOST" ]; then
    echo "Aguardando MySQL em ${DB_HOST}:${DB_PORT:-3306}..."
    i=0
    while [ $i -lt 30 ]; do
        php -r "new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '3306') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" >/dev/null 2>&1 && break
        i=$((i+1))
        sleep 2
    done
fi

if [ -f "$APP_DIR/artisan" ]; then
    echo "Executando package:discover..."
    php artisan package:discover --ansi || echo "Aviso: package:discover falhou."
fi

exec "$@"
