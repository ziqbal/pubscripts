

y=$1
x=`echo "$y" | tr '[:upper:]' '[:lower:]' | sed 's/[^a-zA-Z0-9]//g'` 

r=`awk -v min=1000 -v max=9999 'BEGIN{srand(); print int(min+rand()*(max-min+1))}'`

PN="$x$r"

cd /tmp
rm -rf $PN

mkdir $PN
mkdir $PN/_static_

echo "Ready." > $PN/_static_/index.html

tar zcvf $PN.tar.gz $PN


rm -rf $PN

echo $PN.tar.gz

