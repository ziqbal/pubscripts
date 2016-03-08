<?php

include( "functions-config-base.php" ) ;
include( "functions-log-base.php" ) ;

_bootBase( ) ;

function _bootBase( ) {

	date_default_timezone_set( 'UTC' ) ;

	_configBase( ) ;
	_logBase( ) ;

}

