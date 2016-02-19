<?php



function _modeCommand( ) {


}


function _modeCommandHandle( ) {



    if( _keyboardBaseHandleLoad( ) ) {

      _configBaseQuery( "_screenBaseViewDirty" , true ) ;

      return ;

    }
    
	if( _keyboardBaseHandleMovement( ) ) {

		return ;

	}


	
}