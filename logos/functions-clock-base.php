<?php


function _clockBase( ) {



}

function _clockBaseSetAppTime( ) {

	_configSet( "apptime" , microtime( true ) ) ;



}


function _clockBaseTrigger( $key ) {

	$rate = "{$key}Rate" ;
	$last = "{$key}Last" ;

	if( _configGet( $rate ) === NULL ) {

		return( false ) ;

	}

	if( _configGet( $last ) === NULL ) {

		_configSet( $last , _configGet( "apptime" ) + _configGet( $rate ) ) ;	

		return( false ) ;

	}


	if( _configGet( "apptime" ) > _configGet( $last ) ) {

		_configSet( $last , _configGet( "apptime" ) + _configGet( $rate ) ) ;

		return( true ) ;

	}	

	return( false ) ; 

}