<?php


function _appHandleInput( ) {


    //////////////////////////////////////////////////////////////


    if( _keyboardBaseHandleLoad( ) ) {

      _configBaseQuery( "_screenBaseViewDirty" , true ) ;

      return ;

    }

    if( _keyboardBaseHandleModeToggle( ) ) {

      system( "tput rmso" ) ;
      return ;

    }

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'command' ) {

      _modeCommandHandle( ) ;
      return ;

    }

    //////////////////////////////////////////////////////////////

    if( _appBaseGetMode( ) == 'edit' ) {

      _modeEditHandle( ) ;

      return ;

    }

    //////////////////////////////////////////////////////////////

}
