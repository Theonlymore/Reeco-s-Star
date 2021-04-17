#!/bin/bash


user="$1"
port="$2"

pathApachePortConf="/etc/apache2/ports.conf"
pathApacheDefault="/etc/apache2/sites-enabled/000-default.conf"
path="/var/www/public/${user}"


ligneDepartVirtual=`grep -n ":${port}>" $pathApacheDefault | cut -f1 -d:`
if [ -z "$ligneDepartVirtual"]; then
    echo "\$ligneDepartVirtual is empty"
else  
    echo "Ligne depart vir : ${ligneDepartVirtual}"
    ligneFinalVirtual=$((ligneDepartVirtual+5))
    echo "Ligne final vir : ${ligneFinalVirtual}"
    sed -i "${ligneDepartVirtual},${ligneFinalVirtual}d" $pathApacheDefault 
fi

lignePort=`grep -n "Listen ${port} " $pathApachePortConf | cut -f1 -d:`
if [ -z "$lignePort"]; then
    echo "\$lignePort is empty"
else
    echo "ligne port : ${lignePort}"
    sed -i "${lignePort}d" $pathApachePortConf
fi    


ftpasswd --passwd -delete-user --name="${user}" --file=/etc/proftpd/vpasswd
rm -fr "$path"

apache2ctl graceful





