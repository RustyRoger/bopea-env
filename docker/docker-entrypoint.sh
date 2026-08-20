#!/bin/bash
set -e

HOST_UID=${HOST_UID:-33}
HOST_GID=${HOST_GID:-33}

usermod -u "$HOST_UID" www-data
groupmod -g "$HOST_GID" www-data

# Esclude il bind mount del plugin (read-only)
find /var/www/html -not -path "/var/www/html/wp-content/plugins/lc-football/*" -not -path "/var/www/html/wp-content/plugins/lc-football" -exec chown www-data:www-data {} + 2>/dev/null || true

PLUGIN_DIR="/var/www/html/wp-content/plugins/lc-football"

# Copia solo se il plugin non è già presente (es. bind mount)
if [ -d /opt/lc-football ] && [ ! -d "$PLUGIN_DIR" ]; then
    mkdir -p /var/www/html/wp-content/plugins

    cp -r /opt/lc-football "$PLUGIN_DIR"
    chown -R www-data:www-data "$PLUGIN_DIR" 2>/dev/null || true

    echo "Plugin lc-football copiato in $PLUGIN_DIR"
fi

exec docker-entrypoint.sh "$@"
