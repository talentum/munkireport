#!/bin/bash

# bluetooth controller
CTL="${BASEURL}index.php?/module/munkiextra/"

# Get the scripts in the proper directories
${CURL} "${CTL}get_script/munkigatherinfo.sh" -o "${MUNKIPATH}preflight.d/munkigatherinfo.sh"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/munkigatherinfo.sh"

	# Set preference to include this file in the preflight check
	defaults write "${PREFPATH}" ReportItems -dict-add munkiextra "${MUNKIPATH}preflight.d/cache/munkiextrainfo.txt"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/munkigatherinfo.sh"

	# Signal that we had an error
	ERR=1
fi


