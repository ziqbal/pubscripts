<?php


function _keyboardBase( ) {


}

function _keyboardBaseIsEnterKey( ) {

	if( ord( _keyboardBaseGetInput( ) ) == 10 ) {
		return(true);
	}

	return(false);


}

function _keyboardBaseIsBackspaceKey( ) {

	if( ord( _keyboardBaseGetInput( ) ) == 127 ) {
		return(true);
	}

	return(false);


}

function _keyboardBaseIsTabKey( ) {

	if( ord( _keyboardBaseGetInput( ) ) == 9 ) {
		return(true);
	}

	return(false);


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

function _keyboardBaseHandleSave( ) {


}

function _keyboardBaseHandleMovement( ) {

	$c = _keyboardBaseGetInput( ) ;

	if( $c == 'j' ) {

		if(_configGet("cursorx")>1) _cursorBaseLeft( ) ;
		return( true ) ;

	}

	if( $c == 'k' ) {

		if( _configGet( "cursorx" ) < ( _configGet("screenwidth") - 2 ) ) _cursorBaseRight( ) ;
		return( true ) ;

	}

	if( $c == 'd' ) {

		if(_configGet("cursory")>1) _cursorBaseUp( ) ;
		return( true ) ;

	}

	if( $c == 'f' ) {

		if( _configGet( "cursory" ) < ( _configGet("screenheight") - 2 ) ) _cursorBaseDown( ) ;
		return( true ) ;

	}

	return( false ) ;

}


function _keyboardBaseInputIsPrintable( ) {

	$c = _keyboardBaseGetInput( ) ;

	if(ord($c)<32) return(false);
	if(ord($c)>126) return(false);
	return(true);



}