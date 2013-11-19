#!/bin/sh

basedir=/var/www/evolve-games.com/
build_dir=${basedir}build/
deploy_dir=${basedir}deploy/
env_dir=${basedir}environments/

frontend_app_dir=${basedir}frontend/
frontend_webroot=${frontend_app_dir}web/
frontend_runtime=${frontend_app_dir}runtime/

backend_app_dir=${basedir}backend/
backend_webroot=${backend_app_dir}web/
backend_runtime=${backend_app_dir}runtime/

overlays=/var/overlays/evolve-games.com/

yii=${basedir}yii

