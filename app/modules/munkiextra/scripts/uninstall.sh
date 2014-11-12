#!/bin/bash

# Remove bluetooth script
rm -f "${MUNKIPATH}preflight.d/munkigatherinfo.sh"

# Remove bluetoothinfo.txt file
rm -f "${MUNKIPATH}preflight.d/cache/munkiextrainfo.txt"
