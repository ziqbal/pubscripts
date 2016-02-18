<?php


function _clockBase( ) {



}

function _clockBaseSetAppTime( ) {

	_configBaseSet( "apptime" , microtime( true ) ) ;



}


function _clockBaseTrigger( $key ) {

	$rate = "{$key}Rate" ;
	$last = "{$key}Last" ;

	if( _configBaseGet( $rate ) === NULL ) {

		return( false ) ;

	}

	if( _configBaseGet( $last ) === NULL ) {

		_configBaseSet( $last , _configBaseGet( "apptime" ) + _configBaseGet( $rate ) ) ;	

		return( false ) ;

	}


	if( _configBaseGet( "apptime" ) > _configBaseGet( $last ) ) {

		_configBaseSet( $last , _configBaseGet( "apptime" ) + _configBaseGet( $rate ) ) ;

		return( true ) ;

	}	

	return( false ) ; 

}
