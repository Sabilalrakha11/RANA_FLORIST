FROM php:8.2-apache

# Install ekstensi mysqli biar PHP Native kamu bisa ngobrol sama database
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

# Kasih akses biar folder uploads bisa nyimpen gambar
RUN chown -R www-data:www-data /var/www/html