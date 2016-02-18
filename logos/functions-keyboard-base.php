<?php


function _keyboardBase( ) {


	//_configBaseSet("keyboardbuffer",array());

	_configBaseQuery( "keyboardbuffer" , array( ) ) ;




}

function _keyboardBaseIsEnterKey( ) {


	$byte = _keyboardBasePullInput( ) ;

	if( $byte == 10 ) {

		return(true);
	}


	_keyboardBasePushInput( $byte ) ;

	return(false);


}

function _keyboardBaseIsBackspaceKey( ) {


	$byte = _keyboardBasePullInput( ) ;

	if( $byte == 127 ) {

		return(true);
	}


	_keyboardBasePushInput( $byte ) ;

	return(false);	



}

function _keyboardBaseIsTabKey( ) {

	$byte = _keyboardBasePullInput( ) ;

	if( $byte == 9 ) {

		return(true);
	}


	_keyboardBasePushInput( $byte ) ;

	return(false);	




}


function _keyboardBasePushInput( $byte ) {

	$kb = _configBaseQuery( "keyboardbuffer" ) ;
	array_unshift( $kb ,  $byte ) ;	
	_configBaseQuery( "keyboardbuffer" , $kb ) ;

	//_logBaseWrite($kb);

}

function _keyboardBasePullInput( ) {

	$kb = _configBaseQuery( "keyboardbuffer" ) ;
	if(count($kb)==0) return(NULL);

	$byte = array_shift( $kb ) ;	

	_configBaseQuery( "keyboardbuffer" , $kb ) ;

	return( $byte ) ;

}


function _keyboardBaseHandleQuit( ) {

//	if( _appBaseGetMode( ) == "edit" ) return( false ) ;

	$byte = _keyboardBasePullInput( ) ;

	if( chr($byte) == 'q' ) {

		return(true);
	}


	_keyboardBasePushInput( $byte ) ;

	return(false);	



}

function _keyboardBaseHandleModeToggle( ) {


	$byte = _keyboardBasePullInput( ) ;


	if( $byte == 27 ) {

		if( _appBaseGetMode( ) == "command" ) {

			_appBaseSetMode( "edit" ) ;
			return( true ) ;

		}

		if( _appBaseGetMode( ) == "edit" ) {

			_appBaseSetMode( "command" ) ;
			return( true ) ;

		}		

	}

	_keyboardBasePushInput( $byte ) ;

	return( false ) ;

}

function _keyboardBaseHandleSave( ) {


}

function _keyboardBaseHandleMovement( ) {

	$byte = _keyboardBasePullInput( ) ;

	if( chr($byte) == 'j' ) {

		if(_configBaseGet("cursorx")>1) _cursorBaseLeft( ) ;
		return( true ) ;

	}

	if( chr($byte) == 'k' ) {

		if( _configBaseGet( "cursorx" ) < ( _configBaseGet("screenwidth") - 2 ) ) _cursorBaseRight( ) ;
		return( true ) ;

	}

	if( chr($byte) == 'd' ) {

		if(_configBaseGet("cursory")>1) _cursorBaseUp( ) ;
		return( true ) ;

	}

	if( chr($byte) == 'f' ) {

		if( _configBaseGet( "cursory" ) < ( _configBaseGet("screenheight") - 2 ) ) _cursorBaseDown( ) ;
		return( true ) ;

	}

	_keyboardBasePushInput( $byte ) ;

	return( false ) ;

}

function _keyboardBasePeek( ) {

	$byte = _keyboardBasePullInput( ) ;

	_keyboardBasePushInput( $byte ) ;

	return($byte);



}

function _keyboardBaseInputIsPrintable( ) {

	$byte = _keyboardBasePeek( ) ;

	if($byte===NULL) return(false);

	if( ( $byte > 31 ) && ( $byte < 127 ) ) return( true ) ;

	return( false ) ;

}
