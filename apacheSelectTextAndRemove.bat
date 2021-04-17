#!/bin/bash

pathApache="/root/Script/text"
port="$1"

ligneDepartVirtualVirtual=`grep -n ":${port}>" $pathApache | cut -f1 -d:`
echo $ligneDepartVirtual
ligneFinal=$((ligneDepartVirtual+5))
echo $ligneFinal
sed -i '${ligneDepartVirtual},${ligneFinal}d' $pathApache