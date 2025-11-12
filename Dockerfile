# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para CodeIgniter
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite para CodeIgniter
RUN a2enmod rewrite

# Copiar configuración de Apache personalizada
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

