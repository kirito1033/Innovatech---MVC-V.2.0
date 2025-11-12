# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para CodeIgniter
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install intl mbstring pdo pdo_mysql mysqli xml zip

# Habilitar mod_rewrite para CodeIgniter
RUN a2enmod rewrite

# Instalar Composer (desde imagen oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copiar configuración personalizada de Apache
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]

