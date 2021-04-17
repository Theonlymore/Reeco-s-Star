#!/bin/bash

port="$2"
user="$1"

rowPath="/var/www/public/"
path="$rowPath$user"

pathApachePortConf="/root/Script/text"
pathApacheDefault="/root/Script/text"

echo "Listen ${port}" >> $pathApachePortConf

echo "<VirtualHost *:${port}>" >> $pathApacheDefault
echo "ServerAdmin webmaster@localhost">> $pathApacheDefault
echo "DocumentRoot ${rowPath}${user}">> $pathApacheDefault
echo "ErrorLog ""$""{""APACHE_LOG_DIR""}""/""error.log" >> $pathApacheDefault
echo "CustomLog ""$""{""APACHE_LOG_DIR""}""/""access.log combined">> $pathApacheDefault