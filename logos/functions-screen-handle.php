<?php


function _screenHandleClear( ) {

	system( 'tput clear' ) ;

}

function _screenHandleGetDimensions( ) {

	$fp = "/tmp/logos".uniqid( ).".tmp" ;

	system( 'echo "lines\ncols" | tput -S > '.$fp ) ;

	$f = file( $fp , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) ;

	$res = array( "screenwidth" => $f[ 1 ] , "screenheight" => $f[ 0 ] ) ;

	unlink( $fp ) ;

	return( $res ) ;

}

function _screenHandleShowCursor( ){
	
	system( 'tput cnorm' ) ;

}

function _screenHandleCursorFlash( ) {


}

function _screenHandleShowGridChar( ) {

		$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
		print($ch);

		$cy = _cursorBaseGetY( ) ;
		$cx = _cursorBaseGetX( ) ;
		system( "tput cup $cy $cx" ) ;


}
