<?php


$_CONFIG_ = array( ) ;

function _configBase( ) {

	_configBaseInit( ) ;
	
}

function _configBaseInit( ) {

	global $argv ;

	_configBaseQuery( "pid" , getmypid( ) ) ;
	_configBaseQuery( "originalargs" , $argv ) ;
	_configBaseQuery( "targetdir" , $argv[ 1 ] ) ;
	_configBaseQuery( "hostname" , $argv[ 2 ] ) ;
	_configBaseQuery( "timestamp" , $argv[ 3 ] ) ;
	_configBaseQuery( "spid" , $argv[ 4 ] ) ;
	_configBaseQuery( "scriptdir" , __DIR__ ) ;
	_configBaseQuery( "basename" , basename( __DIR__ ) ) ;

	_configBaseQuery( "cachedir" , _configBaseQuery( "scriptdir" )."/_cache_" ) ;

	if( ! file_exists( _configBaseQuery( "cachedir" ) ) ) {

		mkdir( _configBaseQuery( "cachedir" ) ) ;
		chmod( _configBaseQuery( "cachedir" ) , 0777 ) ;

	}

}

function _configBaseDebug( ) {

	global $_CONFIG_ ;

	print_r( $_CONFIG_ ) ;

}

function _configBaseQuery(  ) {

	global $_CONFIG_ ;

	$args = func_get_args( ) ;

	if( count( $args ) == 1 ) {

		if( !isset( $_CONFIG_[ $args[ 0 ] ] ) ) {

			return( NULL ) ;

		} else {

			return( $_CONFIG_[ $args[ 0 ] ] ) ;

		}

	}

	$_CONFIG_[ $args[ 0 ]  ] = $args[ 1 ]  ;

} 

