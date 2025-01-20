#!/bin/sh

# Wait for database to be ready
echo "Waiting for PostgreSQL to be ready..."
while ! nc -z db 5432; do
    sleep 0.1
done
echo "PostgreSQL is ready!"

# Install dependencies
composer install --no-interaction --no-dev --optimize-autoloader

# Generate key if not already set
php artisan key:generate --no-interaction --force

# Run migrations
php artisan migrate --force

# Set proper permissions
chown -R www-data:www-data storage bootstrap/cache

# Start PHP-FPM
php-fpm
