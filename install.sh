#!/bin/sh

dir=/var/www/blog3.ru;
repo_dir=/var/www/repos/eg;
repo=git@github.com:nizsheanez/blog3.git;

sudo php composer.phar update &
cd ${dir}/frontend/web && sudo bower install --allow-root &

wait

sudo chown www-data:www-data ${dir}/* -R

git clone $repo $repo_dir