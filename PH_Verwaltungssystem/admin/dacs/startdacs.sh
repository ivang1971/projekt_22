#!/bin/bash
# cd /dacs/dacsport/source
# sudo gdb ./dacsport
while true; do
	if [ -f /dacs/dacsport.run ]; then
		cd /dacs/dacsport
		./dacsport
	else
		echo DACSport stopped!
		echo Exceute /dacs/rundacs.sh to restart.
	fi
	sleep 1;

done
