#!/bin/bash
d
user="$1"
pass="$2"
rowPath="/var/www/public/"
path="$rowPath$user"

echo $user


echo "$path"
mkdir -p "$path"


ftpasswd --stdin --file=/etc/proftpd/vpasswd --name="${user}" --home="${path}" $
chown -R public "$rowPath"
