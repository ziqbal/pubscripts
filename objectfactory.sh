#
# Object Factory
# Parameter 1 = type
#

INTERPRETER="/usr/bin/php"
#INTERPRETER="/Applications/XAMPP/bin/php"

STARTDIR=$(pwd)
SCRIPTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

FILENAME=$(basename "${BASH_SOURCE[0]}")
EXTENSION="${FILENAME##*.}"
FNAME="${FILENAME%.*}"

cd $SCRIPTDIR

if [ -d $FNAME ]; then
	FNAME=$FNAME/$FNAME
fi

$INTERPRETER $FNAME.php $STARTDIR "$@"
