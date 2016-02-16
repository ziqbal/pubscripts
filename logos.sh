#
# Crazy! My Own Editor! In PHP!
# Well there is an itch I gotta scratch.
# Also known as Meditations.
# Parameter 1 = filename
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
