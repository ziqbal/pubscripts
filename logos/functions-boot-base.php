<?php

include( "functions-config-base.php" ) ;
include( "functions-log-base.php" ) ;
include( "functions-app-base.php" ) ;
include( "functions-app-handle.php" ) ;
include( "functions-grid-base.php" ) ;
include( "functions-screen-base.php" ) ;
include( "functions-screen-handle.php" ) ;
include( "functions-cursor-base.php" ) ;
include( "functions-keyboard-base.php" ) ;
include( "functions-clock-base.php" ) ;

_bootBase( ) ;

function _bootBase( ) {


	date_default_timezone_set( 'UTC' ) ;

	_configBase( ) ;
	_logBase( ) ;
	_appBase( ) ;
	_gridBase( ) ;
	_screenBase( ) ;
	_cursorBase( ) ;
	_keyboardBase( ) ;
	_clockBase( ) ;


}

