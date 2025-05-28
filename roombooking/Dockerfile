# Utiliser une image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances système et extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Activer mod_rewrite pour les routes Laravel
RUN a2enmod rewrite

# Copier la configuration Apache personnalisée
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Copier Composer depuis l'image officielle Composer 2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html
