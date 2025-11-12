# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para CodeIgniter
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Ir al directorio del proyecto y ejecutar composer install
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite para CodeIgniter
RUN a2enmod rewrite

# Copiar configuración personalizada de Apache
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

