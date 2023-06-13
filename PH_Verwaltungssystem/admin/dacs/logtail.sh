#!/bin/bash

tail -f `ls -td /dacs/logfiles/system/*.log | head -1`
