#!/bin/bash
php artisan config:cache
php artisan route:cache
supervisord -c /etc/supervisor/conf.d/supervisord.conf