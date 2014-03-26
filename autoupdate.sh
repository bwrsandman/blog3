#!/bin/sh
sudo -u www-data composer update &
#sudo apt-get update && sudo apt-get upgrade -y &
#cd frontend/web && sudo npm update -g --color false && sudo -u www-data npm update --color false &
cd frontend/web && sudo -u www-data bower update &

wait;
