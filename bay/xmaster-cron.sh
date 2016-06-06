
#* * * * * /home/zaf/scripts/xmaster-cron.sh > /dev/null 2>/tmp/cron.log

if [ ! -f /tmp/xmaster/xm.lock ]; then
	/home/zaf/scripts/xmaster.sh &
else 
	modsecs=$(date --utc --reference=/tmp/xmaster/xm.lock +%s)
	nowsecs=$(date +%s)
	delta=$(($nowsecs-$modsecs))
	if [ $delta -gt 30 ]; then
		cat /tmp/xmaster/xm.lock|xargs -n 1 kill
		/home/zaf/scripts/xmaster.sh & 
	fi
fi

touch /tmp/xmaster/cron.lock
