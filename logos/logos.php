<?php

include( "functions-boot-base.php" ) ;

_appBaseStartUp( ) ;

while( true ) {

  $r = array( STDIN ) ;
  $w = NULL ;
  $e = NULL ;

  $n = stream_select( $r , $w , $e , 0 ) ;

  if( $n && in_array( STDIN , $r ) ) {

    _keyboardBasePushInput( ord( stream_get_contents( STDIN , 1 ) ) ) ;

    //if( _configBaseGet( "commandquit" ) ) break ;

  } else {

	//_appHandleInput( stream_get_contents( STDIN , 1 ) ) ;

	  if( !_appBaseLoop( ) ) break ;

  }


}

_appBaseCleanUp( ) ;
