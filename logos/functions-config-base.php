<?php


$_CONFIG_ = array( ) ;

function _configBase( ) {

	_configBaseInit( ) ;
	
}

function _configBaseInit( ) {

	global $argv ;

	_configBaseSet( "originalargs" , $argv ) ;
	_configBaseSet( "targetdir" , $argv[ 1 ] ) ;
	_configBaseSet( "scriptdir" , __DIR__ ) ;

	_configBaseQuery( "loaded" , false ) ;


}

function _configBaseDebug( ) {

	global $_CONFIG_ ;

	print_r($_CONFIG);

}

function _configBaseQuery(  ) {

	$args = func_get_args( ) ;


	if( count( $args ) == 1 ) {

		return( _configBaseGet( $args[ 0 ] ) ) ;

	}

	_configBaseSet( $args[ 0 ] , $args[ 1 ] ) ;

} 

function _configBaseSet( $k , $v ) {

	global $_CONFIG_ ;

	$_CONFIG_[ $k ] = $v ;

} 

function _configBaseGet( $k ) {

	global $_CONFIG_ ;

	if(!isset($_CONFIG_[$k])) return(NULL);

	return( $_CONFIG_[ $k ] ) ;

} 
