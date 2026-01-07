FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y libpq-dev unzip git \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite

# Forcer DocumentRoot sur public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copier le code dans le container
COPY ./public /var/www/html/public
COPY ./src /var/www/html/src
COPY ./src /var/www/html/tests

# Autoriser .htaccess dans public
RUN sed -i '/<Directory \/var\/www\/html\/public>/,/<\/Directory>/d' /etc/apache2/apache2.conf \
    && echo "<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
