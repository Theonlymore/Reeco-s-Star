#!/bin/bash

pathApacheVirtual="/root/Script/text"
pathApachePortConf="/root/Script/text"

port="$1"


REM Supprimer text dans le fichier 000-default.conf enleve /enleve VirtualHost
ligneDepartVirtual=`grep -n ":${port}>" $pathApacheVirtual | cut -f1 -d:`
echo "Ligne depart vir : ${ligneDepartVirtual}"
ligneFinalVirtual=$((ligneDepartVirtual+5))
echo "Ligne final vir : ${ligneFinalVirtual}"
sed -i "${ligneDepartVirtual},${ligneFinalVirtual}d" $pathApacheVirtual 

lignePort=`grep -n "Listen ${port} " $pathApacheVirtual | cut -f1 -d:`
echo "ligne port : ${lignePort}"
sed -i "${lignePort}d" $pathApachePortConf