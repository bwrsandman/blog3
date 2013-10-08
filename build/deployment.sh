#!/bin/sh

. ./props.sh

cd ${basedir}

sudo rm -rf ${env_dir}
rm -rf ${basedir}vendor/**/.git

sudo mkdir ${env_dir}

sudo chown -R www-data:www-data ${basedir}

#git pull
#echo '-----------git pull-----------'
#git pull > /dev/null
#last_tag=$(git tag -l "*.*.*" | sort -V | tail -n 1)
#git_tag=$(echo $last_tag | awk -F \. {'print $1"."$2"."++$3'})
#git tag $git_tag && git push --tags


#rsync
#echo '-----------rsync-----------'
#rsync -ax --delete $deploy_dir $webroot


#configuring
echo '-----------configuring-----------'
sudo cp -R ${overlays}* ${env_dir}
sudo -u www-data php ${basedir}init 0

#sed -f ${overlays}production.sed ${app_dir}config/constants.php.tpl > ${app_dir}config/constants.php
#sed -f ${overlays}production.sed ${app_dir}config/production.php.tpl > ${app_dir}config/production.php

sudo chown -R www-data:www-data ${basedir}

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