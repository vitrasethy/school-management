FROM php:8.4-fpm-alpine

# Install only runtime dependencies
RUN apk add --no-cache \
    postgresql-libs \
    libzip \
    libpng \
    libjpeg-turbo \
    freetype \
    zip \
    unzip \
    git \
    curl \
    netcat-openbsd

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql \
    zip exif pcntl bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions
RUN chown -R www-data:www-data /var/www

# Switch to non-root user
USER www-data

# Set entrypoint
ENTRYPOINT ["entrypoint.sh"]
