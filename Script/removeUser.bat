#!/bin/bash


user="$1"
port="$2"

pathApachePortConf="/etc/apache2/ports.conf"
pathApacheDefault="/etc/apache2/sites-enabled/000-default.conf"



ligneDepartVirtual=`grep -n ":${port}>" $pathApacheDefault | cut -f1 -d:`
echo "Ligne depart vir : ${ligneDepartVirtual}"
ligneFinalVirtual=$((ligneDepartVirtual+5))
echo "Ligne final vir : ${ligneFinalVirtual}"
sed -i "${ligneDepartVirtual},${ligneFinalVirtual}d" $pathApacheDefault 

lignePort=`grep -n "Listen ${port} " $pathApachePortConf | cut -f1 -d:`
echo "ligne port : ${lignePort}"
sed -i "${lignePort}d" $pathApachePortConf



ftpasswd --passwd -delete-user --name="${user}" --file=/etc/proftpd/vpasswd
rm -fr "$path"



