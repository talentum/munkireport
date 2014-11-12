#!/bin/bash

#Sökväg till inställningsfilen vi ska hämta Catalogs och included manifests ifrån
clientpref="/Library/Managed Installs/manifests/client_manifest.plist"

#Sökväg till inställningsfilen vi hämtar SUS-server från
suspref="/Library/Preferences/com.apple.SoftwareUpdate.plist"

#Sökväg till textfil där vi lagrar information.
munkiextra="/usr/local/munki/preflight.d/cache/munkiextrainfo.txt"

getmoreinfo()
{
#läs in informationen vi vill ha. sed och tr tar bort rader och oönskade tecken.
catalog=`defaults read "$clientpref" catalogs | sed '/^(/ d' | sed '/^)/ d' | tr -d ' '`
echo "Catalogs = $catalog"
nested=`defaults read "$clientpref" included_manifests | sed '/^(/ d' | sed '/^)/ d' | tr -d '"' | tr -d ' '`
echo "Included Manifests = $nested"
susserver=`defaults read "$suspref" CatalogURL`
echo "SUS-server = $susserver"
}

getmoreinfo > "$munkiextra"

exit 0