#!/bin/bash

user="$1"
pass="$2"
rowPath="/home/alex/"
path="$rowPath$user"


echo "$path"
chown -R alex "$rowPath"
mkdir -p "$path"


ftpasswd --stdin --file=/etc/proftpd/vpasswd --name="${user}" --home="${path}" --shell=/bin/false --uid=1001 --gid=1001 --passwd <<< "$pass"
