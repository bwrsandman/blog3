#!/bin/sh

dir=/var/www/blog3.ru;

sudo php composer.phar update &
cd ${dir}/frontend/web && sudo bower install --allow-root &

wait

sudo chown www-data:www-data ${dir}/* -R
