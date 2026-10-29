FROM 10.25.255.133:5000/php83-alpine-nginx:latest

# Install PHP extensions, git, npm, and netcat for database connection check
USER root
RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

RUN apk add --no-cache php83-intl php83-pdo_mysql git nodejs npm
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/fpm-pool.conf /etc/php83/php-fpm.d/www.conf
# COPY docker/php.ini /etc/php83/conf.d/custom.ini
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

USER aptika

COPY --chown=aptika:aptika . /var/www/html


# Install dependencies
RUN cd /var/www/html && composer install

# Install npm dependencies
RUN cd /var/www/html && npm install

# Build assets (original build step, can be kept or removed if redundant)
RUN cd /var/www/html && npm run build

# Docker will be accessible on port 8080
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up & running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
