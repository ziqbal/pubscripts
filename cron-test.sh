#
#

INTERPRETER="/usr/bin/php"
#INTERPRETER="/Applications/XAMPP/bin/php"

STARTDIR=$(pwd)
SCRIPTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

TIMESTAMP=$(date +%s)
HOSTNAME=$(hostname)

FILENAME=$(basename "${BASH_SOURCE[0]}")
EXTENSION="${FILENAME##*.}"
FNAME="${FILENAME%.*}"



cd $SCRIPTDIR

if [ -d $FNAME ]; then
	FNAME=$FNAME/code
else
	FNAME=code
fi

date

$INTERPRETER $FNAME.php $STARTDIR "$@" $HOSTNAME $TIMESTAMP
