<?php



function _screenBase( ) {

	readline_callback_handler_install( '' , function( ) { } ) ;

	_screenBaseUpdateDimensions( ) ;

}


function _screenBaseUpdateDimensions( ) {

	$dimensions = _screenHandleGetDimensions( ) ;

	_configSet( "screenwidth" , $dimensions[ 'screenwidth' ] ) ;
	_configSet( "screenheight" , $dimensions[ 'screenheight' ] ) ;

}

function _screenBaseGetWidth( ) {

	return( _configGet( "screenwidth" ) ) ;

}


function _screenBaseGetHeight( ) {

	return( _configGet( "screenheight" ) ) ;

}

function _screenBaseGoRight( $x ) {

	$x++ ;

	$width = _screenBaseGetWidth( ) ;

	if( $x >= $width ) $x = $width - 1 ;

	return( $x ) ;

}

function _screenBaseGoLeft( $x ) {

	$x-- ;

	if( $x < 0 ) $x = 0 ;

	return( $x ) ;

}

function _screenBaseGoDown( $y ) {

	$y++ ;

	$height = _screenBaseGetHeight( ) ;

	if( $y >= $height ) $y = $height - 1 ;

	return( $y ) ;

}

function _screenBaseGoUp( $y ) {

	$y-- ;

	if( $y < 0 ) $y = 0 ;

	return( $y ) ;

}


function _screenBaseCleanUp( ) {

	_screenHandleClear( ) ;
	system('tput cnorm');
	system("tput sgr0");	

}

function _screenBaseDebug( ) {

	print( _configGet( "screenwidth" )." x "._configGet( "screenheight" ) ) ;

}

