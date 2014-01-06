#!/bin/sh

. ./props.sh

cd ${basedir}

rm -rf vendor/*
rm -rf frontend/web/src/vendor/*
rm -rf frontend/web/assets/*

git fetch --all && git reset --hard origin/master

composer install
cd frontend/web
bower install --allow-root
npm update -g && npm update

cd ${basedir}/frontend
grunt

cd ${basedir}

rm -rf ${env_dir}/*

chown -R www-data:www-data ${basedir}

#configuring
echo '-----------configuring-----------'
cp -R ${overlays}* ${env_dir}
sudo -u www-data php ${basedir}init 0

cd frontend
php phpd restart --verbose-tty=1


#git pull
#echo '-----------git pull-----------'
#git pull > /dev/null
#last_tag=$(git tag -l "*.*.*" | sort -V | tail -n 1)
#git_tag=$(echo $last_tag | awk -F \. {'print $1"."$2"."++$3'})
#git tag $git_tag && git push --tags


#rsync
#echo '-----------rsync-----------'
#rsync -ax --delete $deploy_dir $webroot


#sed -f ${overlays}production.sed ${app_dir}config/constants.php.tpl > ${app_dir}config/constants.php
#sed -f ${overlays}production.sed ${app_dir}config/production.php.tpl > ${app_dir}config/production.php


#sudo -u www-data php composer.phar --prefer-source -o


#clear
#echo '-----------clear-----------'
#rm -rf ${webroot}assets
#rm -rf ${app_dir}runtime

#mkdir -m 777 ${webroot}assets/
#mkdir -m 777 ${app_dir}runtime/


#migate
#echo '-----------migrate-----------'
#php $yiic migrate up


#sphinx reindex
#echo '-----------sphinx reindex-----------'
#php $yiic sphinx_conf
#sed -f ${overlays}production.sed $runtime/sphinx/sphinx.conf > /etc/sphinxsearch/sphinx.conf
#sudo -u sphinxsearch indexer --all --rotate --config /etc/sphinxsearch/sphinx.conf