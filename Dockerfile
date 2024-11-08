# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copia los archivos de tu proyecto al directorio raíz del servidor web
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-dev --prefer-dist

# Expone el puerto 10000
EXPOSE 10000

# Comando para iniciar el servidor embebido de PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
