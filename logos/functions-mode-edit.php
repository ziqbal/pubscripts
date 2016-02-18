<?php


function _modeEdit( ) {

	
}


function _modeEditHandle( ) {


	if( _keyboardBaseInputIsPrintable( ) ) {

		system("tput rmso");
		system("tput setab 0");

		$byte = _keyboardBasePullInput( ) ;

		print( chr( $byte ) ) ;
		//_gridBaseSetCharFromKeyboard( ) ;
		_gridBaseSetByte( $byte ) ;
		_cursorBaseRightNoPrint( );
		return ;

	}

	if( _keyboardBaseIsEnterKey( ) ) {

		  system("tput rmso");
		  _cursorBaseEnter( );
		return ;

	}

	if( _keyboardBaseIsBackspaceKey( ) ) {

		system("tput rmso");
		system("tput setab 0");
		_cursorBaseLeft( ) ;
		_gridBaseSetChar( " " ) ;
		return ;

	}      

}