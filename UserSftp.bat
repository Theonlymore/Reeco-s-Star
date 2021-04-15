#!/bin/bash

user="$1"
pass="$2"
rowPath="/var/www/public/"
path="$rowPath$user"


echo "$path"
mkdir -p "$path"


ftpasswd --stdin --file=/etc/proftpd/vpasswd --name="${user}" --home="${path}" --shell=/bin/false --uid=1002 --gid=1002 --passwd <<< "$pass"
chown -R public "$rowPath"
