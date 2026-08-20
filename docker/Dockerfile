FROM wordpress:php8.3-apache

# Install wp-cli
RUN apt-get update && apt-get install -y --no-install-recommends curl \
    && curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp \
    && rm -rf /var/lib/apt/lists/*

COPY docker/config/php.ini /usr/local/etc/php/conf.d/wordpress-custom.ini

COPY lc-football /opt/lc-football

COPY docker/docker-entrypoint.sh /usr/local/bin/custom-entrypoint.sh
RUN chmod +x /usr/local/bin/custom-entrypoint.sh

ENTRYPOINT ["custom-entrypoint.sh"]
CMD ["apache2-foreground"]
