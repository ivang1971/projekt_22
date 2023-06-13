#!/bin/bash

curr_dir=`pwd`

/dacs/stopdacs.sh

cd /dacs/dacsport
./dacsport


/dacs/rundacs.sh

cd $curr_dir
