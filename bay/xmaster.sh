#!/bin/bash

function clean_up {
	echo TRAP >> $XMDIR/$XMLOG
	date >> $XMDIR/$XMLOG
	rm -f $XMDIR/$XMLOCK
	exit
}
trap clean_up SIGHUP SIGINT SIGTERM ERR

export DISPLAY=:0

XMDIR="/tmp/xmaster"
XMRUN="run.sh"
XMLOG="xm.log"
XMLOCK="xm.lock"

rm -f $XMDIR/$XMRUN

if [ ! -d "$XMDIR" ]; then 
	mkdir -p $XMDIR
	chmod ugo+rwx $XMDIR
fi

echo $$ > $XMDIR/$XMLOCK
echo RUN >> $XMDIR/$XMLOG
date >> $XMDIR/$XMLOG

while true;
do
	touch $XMDIR/$XMLOCK
	#echo .
	if [ -x $XMDIR/$XMRUN ];
	then
		$XMDIR/$XMRUN
		rm -f $XMDIR/$XMRUN
		echo [SCRIPT][$XMRUN] >> $XMDIR/$XMLOG
		date >> $XMDIR/$XMLOG
	fi;
	touch $XMDIR/$XMLOCK
	sleep 3
done

rm -f $XMDIR/$XMLOCK

echo STOP >> $XMDIR/$XMLOG
date >> $XMDIR/$XMLOG

