# image officielle Docker avec PHP 8.2 + FPM (FastCGI Process Manager), un mode performant pour exécuter PHP derrière Nginx.
FROM php:8.4-fpm

# Met à jour la liste des paquets disponibles et installe les dépendances système nécessaires : (-y correspond à --yes pour dire accepte les confimation ou question de apt-get)
# - git : pour la gestion de versions et le clonage de dépôts.
# - curl : pour effectuer des requêtes HTTP.
# - zip/unzip : pour compresser et décompresser des fichiers.
# - libzip-dev : bibliothèque nécessaire pour l'extension ZIP de PHP.
# - libonig-dev : bibliothèque nécessaire pour l'extension mbstring de PHP.
# Ensuite, installe les extensions PHP suivantes :
# - pdo et pdo_mysql : pour la gestion des bases de données MySQL avec PDO.
# - zip : pour manipuler des fichiers ZIP dans PHP.
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev \ 
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer (le gestionnaire de dépendances PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Installer le CLI Laravel globalement
# RUN composer global require laravel/installer

# # Ajouter le dossier binaire de Composer global à la variable PATH
# ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /var/www
