<?php



function _cursorBase( ) {



	_configSet( "cursorx" , 0 ) ;
	_configSet( "cursory" , 0 ) ;
	_configSet( "cursordirty" , true ) ;

	_configSet( "cursorhighlight" , true ) ;


}

function _cursorBaseHighlightToggle( ) {

	$mode = _appBaseGetMode( ) ;

	$trigger=100;
	if($mode=='command') $trigger=10;

	if( ( _appBaseGetFrame( ) % $trigger ) != 0 ) return ;

	if( _configGet( "cursorhighlight") ) {
		_configSet( "cursorhighlight" , false ) ;

		system('tput cnorm');

	} else {
	      system('tput civis');
		_configSet( "cursorhighlight" , true ) ;
	}

}

function _cursorBaseUpdate( ) {

	if( _cursorBaseIsDirty( ) ) {

		$cy = _cursorBaseGetY( ) ;
		$cx = _cursorBaseGetX( ) ;

		system( "tput cup $cy $cx" ) ;
		system( 'tput cnorm' ) ;	

		_cursorBaseSetDirty( false ) ;

		return ;

	}


	_screenHandleCursorFlash( ) ;


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

function _cursorBaseGetX( ) {

	return( _configGet( "cursorx" ) ) ;

}


function _cursorBaseGetY( ) {

	return( _configGet( "cursory" ) ) ;
	
}

function _cursorBaseLeft( ) {


	_configSet( "cursorx" , _screenBaseGoLeft( _cursorBaseGetX( ) ) ) ;

	_cursorBaseSetDirty( true ) ;

}


function _cursorBaseRight( ) {

	_configSet( "cursorx" , _screenBaseGoRight( _cursorBaseGetX( ) ) ) ;

	_cursorBaseSetDirty( true ) ;


}


function _cursorBaseUp( ) {

	_configSet( "cursory" , _screenBaseGoUp( _cursorBaseGetY( ) ) ) ;

	_cursorBaseSetDirty( true ) ;

}


function _cursorBaseDown( ) {

	_configSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;

	_cursorBaseSetDirty( true ) ;

}

function _cursorBaseDebug( ) {

	print( _cursorBaseGetX( ).","._cursorBaseGetY( ) ) ;

}

