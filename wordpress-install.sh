#
# Quickly setup a wordpress install
# Handles database , config file , htacces
# Parameter 1 = project name
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
