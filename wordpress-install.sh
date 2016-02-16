#
# Quickly setup a wordpress multisite install
# Handles database , config file , htaccess
# Parameter 1 = project name
# FIXME TODO replace web path "/_craft_/..." to ???
#

#INTERPRETER="/usr/bin/php"
INTERPRETER="/Applications/XAMPP/bin/php"

STARTDIR=$(pwd)
SCRIPTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

FILENAME=$(basename "${BASH_SOURCE[0]}")
EXTENSION="${FILENAME##*.}"
FNAME="${FILENAME%.*}"

cd $SCRIPTDIR

$INTERPRETER $FNAME.php $STARTDIR "$@"
