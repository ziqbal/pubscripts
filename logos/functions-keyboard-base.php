<?php


function _keyboardBase( ) {


}

function _keyboardBaseSetInput( $c ) {

	_configSet( "keyboardinput" , $c ) ;

}

function _keyboardBaseGetInput( ) {

	return( _configGet( "keyboardinput" ) ) ;
	
}

function _keyboardBaseHandleQuit( ) {

	$c = _keyboardBaseGetInput( ) ;

	if( $c == 'q' ) {

		return( true ) ;

	}

	return( false ) ;

}

function _keyboardBaseHandleModeToggle( ) {

	$c = _keyboardBaseGetInput( ) ;

	if( ord( _keyboardBaseGetInput( ) ) == 27 ) {

		if( _appBaseGetMode( ) == "command" ) {

			_appBaseSetMode( "edit" ) ;
			return( true ) ;

		}

		if( _appBaseGetMode( ) == "edit" ) {

			_appBaseSetMode( "command" ) ;
			return( true ) ;

		}		

	}

	return( false ) ;

}

function _keyboardBaseHandleMovement( ) {

	$c = _keyboardBaseGetInput( ) ;

	if( $c == 'j' ) {

		_cursorBaseLeft( ) ;
		return( true ) ;

	}

	if( $c == 'k' ) {

		_cursorBaseRight( ) ;
		return( true ) ;

	}

	if( $c == 'd' ) {

		_cursorBaseUp( ) ;
		return( true ) ;

	}

	if( $c == 'f' ) {

		_cursorBaseDown( ) ;
		return( true ) ;

	}

	return( false ) ;

}