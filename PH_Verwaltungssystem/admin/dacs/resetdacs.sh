#!/bin/bash

# dacsport beenden
/dacs/stopdacs.sh
sleep 0.2

# Motorcontroller 11 resetten
echo -ne "\xFE\x0B\x00\x01\x00\xFF\x0B" > /dev/ttyAMA0

# Motorcontroller 12 resetten
echo -ne "\xFE\x0C\x00\x01\x00\xFF\x0C" > /dev/ttyAMA0

/dacs/rundacs.sh

# Raspi neu starten
reboot
