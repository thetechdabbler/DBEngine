FROM php:8.3-cli

# Install necessary extensions and tools
RUN apt-get update && apt-get install -y \
    zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

RUN pecl install pcov && docker-php-ext-enable pcov

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /app

# Copy existing application directory contents
COPY . /app

# Install PHP dependencies
#RUN composer install

# Run PHPUnit tests
#CMD ["./vendor/bin/phpunit"]