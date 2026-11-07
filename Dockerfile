FROM php:5.6-apache

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql \
    && a2enmod rewrite

COPY . /var/www/html/listrik-piss

RUN sed -i 's|^RewriteBase /listrik-piss/|RewriteBase /|' /var/www/html/listrik-piss/.htaccess \
    && sed -i 's|/var/www/html|/var/www/html/listrik-piss|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
