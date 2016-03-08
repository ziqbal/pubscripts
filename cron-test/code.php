<?php

include( "functions-boot-base.php" ) ;

_configBaseDebug( ) ;



$a=array(
	"a"=>1,
	"b"=>2,
	"c"=>"what?"
	);

_logBaseWrite($a);

for($i=0;$i<65;$i++){

	sleep( 1 ) ;

	_logBaseWrite( "TICKTOCK $i" ) ;



}