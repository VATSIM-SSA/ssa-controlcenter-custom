# ---------- pick the upstream ref you want ----------
ARG UPSTREAM_REPO=https://github.com/Vatsim-Scandinavia/controlcenter.git
ARG UPSTREAM_REF=v6.3.4   # or 'main'

# ---------- fetch upstream source ----------
FROM alpine/git:latest AS src
ARG UPSTREAM_REPO
ARG UPSTREAM_REF
RUN git clone --depth=1 --branch "${UPSTREAM_REF}" "${UPSTREAM_REPO}" /src

# ---------- build frontend (matches upstream) ----------
FROM node:23.3.0-alpine AS frontend
WORKDIR /app
COPY --from=src /src/ /app/
RUN npm ci --omit dev && npm run build

# ---------- final image (matches upstream base & steps) ----------
FROM php:8.3.13-apache-bookworm

# Apache ports
EXPOSE 80 443

# System deps (same as upstream)
RUN apt-get update && \
    apt-get install -y git unzip vim nano ca-certificates && \
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    a2enmod rewrite ssl

# Apache/PHP configs from upstream repo
COPY --from=src /src/container/configs/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY --from=src /src/container/configs/apache.conf          /etc/apache2/apache2.conf
COPY --from=src /src/container/configs/php.ini              /usr/local/etc/php/php.ini

# PHP extensions (same installer upstream uses)
COPY --from=mlocati/php-extension-installer:2.7.5 /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql opcache

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# App code: upstream + built assets
WORKDIR /app
COPY --from=src      /src/                 /app/
COPY --from=frontend /app/public/          /app/public/

# Upstream build steps
RUN chown -R www-data:www-data /app && \
    chmod -R 755 storage bootstrap/cache && \
    composer install --no-dev --no-interaction --prefer-dist && \
    mkdir -p /app/storage/app/public/files

# Entry point from upstream
COPY --from=src /src/container/entrypoint.sh /usr/local/bin/controlcenter-entrypoint
ENTRYPOINT [ "controlcenter-entrypoint" ]

# ---------- your customizations ----------
# 1) Override any upstream files by mirroring path under /app
COPY overrides/ /app/
# 2) Division-only migrations run AFTER core
COPY custom/migrations/ /opt/custom/migrations/

CMD ["apache2-foreground"]
