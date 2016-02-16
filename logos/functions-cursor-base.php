<?php



function _cursorBase( ) {

	_configSet( "cursorx" , 0 ) ;
	_configSet( "cursory" , 0 ) ;
	_configSet( "cursordirty" , true ) ;

	_configSet( "cursorhighlight" , true ) ;


}

function _cursorBaseHighlightToggle( ) {

	$mode = _appBaseGetMode( ) ;

	$trigger = 100 ;
	if( $mode == 'command' ) $trigger = 10 ;

	if( ( _appBaseGetFrame( ) % $trigger ) != 0 ) return ;

	if( _configGet( "cursorhighlight" ) ) {

		_configSet( "cursorhighlight" , false ) ;

		system( 'tput cnorm' ) ;

	} else {

		_configSet( "cursorhighlight" , true ) ;

	    system( 'tput civis' ) ;

	}

}

function _cursorBaseUpdate( ) {

	$cy = _cursorBaseGetY( ) ;
	$cx = _cursorBaseGetX( ) ;

	//_logBaseWrite($cx);

	system( "tput cup $cy $cx" ) ;
	system( 'tput cnorm' ) ;	

	_cursorBaseSetDirty( false ) ;

}

function _cursorBaseIsDirty( ) {

	return( _cursorBaseGetDirty( ) ) ;

}

function _cursorBaseGetDirty( ) {

	return( _configGet( "cursordirty" ) ) ;
	
}

function _cursorBaseSetDirty( $v ) {

	_configSet( "cursordirty" , $v )  ;
	
}


function _cursorBaseSetX( $v ) {

	_configSet( "cursorx" , $v ) ;

}

function _cursorBaseSetY( $v ) {

	_configSet( "cursory" , $v ) ;

}


function _cursorBaseGetX( ) {

	return( _configGet( "cursorx" ) ) ;

}


function _cursorBaseGetY( ) {

	return( _configGet( "cursory" ) ) ;
	
}

function _cursorBaseLeft( ) {


	_configSet( "cursorx" , _screenBaseGoLeft( _cursorBaseGetX( ) ) ) ;

}


function _cursorBaseRight( ) {

	_cursorBaseSetX( _screenBaseGoRight( _cursorBaseGetX( ) ) ) ;

	//_logBaseWrite(_cursorBaseGetX());


}


function _cursorBaseUp( ) {

	_configSet( "cursory" , _screenBaseGoUp( _cursorBaseGetY( ) ) ) ;

}


function _cursorBaseDown( ) {

	_configSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;

}

function _cursorBaseDebug( ) {

	print( _cursorBaseGetX( ).","._cursorBaseGetY( ) ) ;

}

