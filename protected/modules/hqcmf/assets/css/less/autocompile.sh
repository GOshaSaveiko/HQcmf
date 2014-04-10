#!/bin/bash
echo "Start watching... Cancel -> Ctrl + C";
while true; do 
    #fullname=`find -name "*.less"`; #all files need to be compiled
    #fullname=`cat watchlist`; #only in watchlist
    fullname=`grep -H -m 1 "^/\*@autocompile\*/" *.less | cut -d: -f1`; #only with autocompile instructions
    inotifywait -qe modify $fullname;
    for fn in $fullname; do
        filename="$(basename ${fn})";
        path="$(dirname $fn)"; 
        lessc "${fn}" "${path}/../`echo ${filename} | cut -f1 -d. -`.css"; #compiled css will be placed in upper dir
    done;
done;  
