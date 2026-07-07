FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set Apache DocumentRoot to public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!$!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!$!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Setup environment and database
RUN cp .env.example .env && php artisan key:generate --force
RUN touch database/database.sqlite && php artisan migrate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database/database.sqlite

# Expose port
EXPOSE 80
