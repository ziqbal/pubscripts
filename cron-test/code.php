<?php

include( "functions-boot-base.php" ) ;

_configBaseDebug( ) ;

_logBaseWrite( "STARTING" ) ;

for($i=0;$i<65;$i++){

	sleep(1);
	
	_logBaseWrite( "TICKTOCK $i" ) ;



}