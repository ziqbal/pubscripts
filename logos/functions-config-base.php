<?php


$_CONFIG_ = array( ) ;

function _configBase( ) {

	_configBaseInit( ) ;
	
}

function _configBaseInit( ) {

	global $argv ;

	_configSet( "originalargs" , $argv ) ;
	_configSet( "targetdir" , $argv[ 1 ] ) ;
	_configSet( "scriptdir" , __DIR__ ) ;

}

function _configBaseDebug( ) {

	global $_CONFIG_ ;

	print_r($_CONFIG);

}

function _configSet( $k , $v ) {

	global $_CONFIG_ ;

	$_CONFIG_[ $k ] = $v ;

} 

function _configGet( $k ) {

	global $_CONFIG_ ;

	if(!isset($_CONFIG_[$k])) return(NULL);

	return( $_CONFIG_[ $k ] ) ;

} 