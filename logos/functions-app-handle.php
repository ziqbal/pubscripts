<?php


function _appHandleInput( $in ) {


    _keyboardBaseSetInput( $in ) ;

    //////////////////////////////////////////////////////////////

    if( _keyboardBaseHandleModeToggle( ) ) return ;

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'command' ) {

      if( _keyboardBaseHandleMovement( ) ) {

        return ;
        
      }

		_configSet( "commandquit" , false ) ;

      if( _keyboardBaseHandleQuit( ) ) {

      	_configSet( "commandquit" , true ) ;

      	return ;

      }

      return ;

    }

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'edit' ) {


      //if( _keyboardBaseIsTabKey( ) ) continue;

      if( _keyboardBaseInputIsPrintable( ) ) {

        system("tput setab 0");

        print( _keyboardBaseGetInput( ) ) ;
        _gridBaseSetCharFromKeyboard( ) ;
        _cursorBaseRightNoPrint( );

      }

      if( _keyboardBaseIsEnterKey( ) ) {

          _cursorBaseEnter( );

      }

      //_screenHandleShowCursor( ) ;

      //_cursorBaseUpdate( ) ;

      return ;

    }




}