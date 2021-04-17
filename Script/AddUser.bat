#!/bin/bash

user="$1"
pass="$2"
port="$3"

rowPath="/var/www/public/"
path="$rowPath$user"
mkdir -p "$path" 


ftpasswd --stdin --file=/etc/proftpd/vpasswd --name="${user}" --home="${path}" --shell=/bin/false --uid=1002 --gid=1002 --passwd <<< "$pass"
chown -R public "$rowPath"



pathApachePortConf="/etc/apache2/ports.conf"
pathApacheDefault="/etc/apache2/sites-enabled/000-default.conf"

echo "Listen ${port} " >> $pathApachePortConf

echo "<VirtualHost *:${port}>" >> $pathApacheDefault
echo "ServerAdmin webmaster@localhost">> $pathApacheDefault
echo "DocumentRoot ${path}">> $pathApacheDefault
echo "ErrorLog ""$""{""APACHE_LOG_DIR""}""/""error.log" >> $pathApacheDefault
echo "CustomLog ""$""{""APACHE_LOG_DIR""}""/""access.log combined">> $pathApacheDefault
echo "</VirtualHost>" >> $pathApacheDefault
echo " " >> $pathApacheDefault

apache2ctl graceful

