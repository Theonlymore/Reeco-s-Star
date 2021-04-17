#!/bin/bash

port="$2"
user="$1"

rowPath="/var/www/public/"
path="$rowPath$user"

pathApachePortConf="/etc/apache2/ports.conf"
pathApacheDefault="/etc/apache2/sites-enabled/000-default.conf"



echo "Listen ${port}" >> $pathApachePortConf

echo "<VirtualHost *:${port}>" >> $pathApacheDefault
echo "ServerAdmin webmaster@localhost">> $pathApacheDefault
echo "DocumentRoot ${rowPath}${user}">> $pathApacheDefault
echo "ErrorLog ""$""{""APACHE_LOG_DIR""}""/""error.log" >> $pathApacheDefault
echo "CustomLog ""$""{""APACHE_LOG_DIR""}""/""access.log combined">> $pathApacheDefault