<?php

include( "functions-boot-base.php" ) ;

_screenHandleClear( ) ;

while( true ) {

  $r = array( STDIN ) ;
  $w = NULL ;
  $e = NULL ;

  $n = stream_select( $r , $w , $e , 0 ) ;

  if( $n && in_array( STDIN , $r ) ) {

    _keyboardBaseSetInput( stream_get_contents( STDIN , 1 ) ) ;

    //////////////////////////////////////////////////////////////

    if( _keyboardBaseHandleModeToggle( ) ) continue ;

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'command' ) {

      if( _keyboardBaseHandleMovement( ) ) {

        _cursorBaseUpdate( ) ;    

        continue ;
        
      }

      if( _keyboardBaseHandleQuit( ) ) break ;

      continue ;

    }

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'edit' ) {

      print( _keyboardBaseGetInput( ) ) ;
      
      _cursorBaseRight( ) ;

      _screenHandleShowCursor( ) ;

      continue ;

    }

    //////////////////////////////////////////////////////////////

  }

  _appBaseLoop( ) ;

  usleep( 10000 ) ;

}

_screenBaseCleanUp( ) ;



