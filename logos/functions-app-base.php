<?php


function _appBase( ) {

	_configSet( "appframe" , 0 ) ;
	_configSet( "appmode" , "command" ) ;

	// In microseconds
	_configSet( "appsleepdelay" , 10000 ) ;

}


function _appBaseStartUp( ) {

	_screenHandleClear( ) ;
	system( 'tput civis' ) ;

}

function _appBaseCleanUp( ) {

	_screenHandleClear( ) ;
	_screenBaseCleanUp( ) ;
	
}


function _appBaseGetMode( ) {

	return( _configGet( "appmode" ) ) ;

}

function _appBaseSetMode( $v ) {

	return( _configSet( "appmode" , $v ) ) ;

}

function _appBaseGetFrame( ) {

	return( _configGet( "appframe" ) ) ;

}


function _appBaseSetFrame( $v ) {

	return( _configSet( "appframe" , $v ) ) ;

}


function _appBaseLoop( ) {

	_appBaseSetFrame( _appBaseGetFrame( ) + 1 ) ;

	_clockBaseSetAppTime( ) ;
	
	_screenBaseUpdate( ) ;
	_cursorBaseUpdate( ) ;

	usleep( _configGet( "appsleepdelay" ) ) ;

}

