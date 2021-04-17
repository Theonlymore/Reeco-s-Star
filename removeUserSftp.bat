#!/bin/bash

user="$1"
rowPath="/var/www/public/"
path="$rowPath$user"


echo "$path"

ftpasswd --passwd -delete-user --name="${user}" --file=/etc/proftpd/vpasswd
rm -fr "$path"


