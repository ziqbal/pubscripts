#
# Crazy! My Own Editor! In PHP!
# Well there is an itch I gotta scratch.
# Also known as Meditations.
#
# Installation for linux:
# sudo apt-get install libsodium-dev php-pear php5-dev
# sudo pecl install libsodium
# php --ini
# sudo vim /etc/php5/cli/php.ini
# More help: https://paragonie.com/book/pecl-libsodium/read/00-intro.md
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
