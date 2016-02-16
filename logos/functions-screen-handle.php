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

/*
  if(_appBaseGetMode( )=='edit'){
    $cursorFlashTrigger=500000;
  }else{
    $cursorFlashTrigger=100000;

  }

    _screenHandleCursorFlash( ) ;


    if($chighlight==1){
      //system('tput setb 4');
      system('tput cnorm');
    }else{
      //system('tput setb 0');
      system('tput civis');
    }
    $chighlight*=-1;
    //print(".");	
 */

}