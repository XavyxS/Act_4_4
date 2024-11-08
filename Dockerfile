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

# Configurar Apache para usar el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf

# Expone el puerto 8080
EXPOSE 8080

# Comando para iniciar Apache
CMD ["apache2-foreground"]
