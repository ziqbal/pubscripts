<?php


function _appBase( ) {

	_configSet( "appframe" , 0 ) ;
	_configSet( "appmode" , "command" ) ;

	// In microseconds
	_configSet( "appsleepdelay" , 10000 ) ;
	_configSet( "_appBaseSaveRate" , 3 ) ;
	//_configSet( "_appBaseSaveLast" , 0 ) ;

}


function _appBaseStartUp( ) {

	_screenHandleClear( ) ;
	system( 'tput civis' ) ;

}

function _appBaseCleanUp( ) {

	_screenHandleClear( ) ;
	_screenBaseCleanUp( ) ;

	_appBaseForceSave( ) ;
	
}


function _appBaseGetMode( ) {

	return( _configGet( "appmode" ) ) ;

}

function _appBaseSetMode( $v ) {

	return( _configSet( "appmode" , $v ) ) ;

}

function _appBaseGetFrame( ) {

	return( _configGet( "appframe" ) ) ;

}


function _appBaseSetFrame( $v ) {

	return( _configSet( "appframe" , $v ) ) ;

}


function _appBaseSave( ) {

	if( _clockBaseTrigger( __FUNCTION__ ) ) {

		if(_configGet("gridmodifytime")==-1) return;

		if( ( _configGet("apptime") - _configGet("gridmodifytime") ) > 3 ){

			_logBaseWrite( __FUNCTION__ ) ;
			_configSet("gridmodifytime",-1);


			$data = gzencode( json_encode( _configGet("grid") ) , 9 );
//			_logBaseWrite($data);
			file_put_contents(_configGet( "targetdir")."/out.logos" , $data ) ;


		}

	}



}


function _appBaseForceSave( ) {

	_logBaseWrite(__FUNCTION__);
	if(_configGet("gridmodifytime")==-1) return;

	_configSet("gridmodifytime",-1);
	$data = gzencode( json_encode( _configGet("grid") ) , 9 );
	file_put_contents(_configGet( "targetdir")."/out.logos" , $data ) ;


	_configSet("gridmodifytime",-1);



}


function _appBaseLoop( ) {

	_appBaseSetFrame( _appBaseGetFrame( ) + 1 ) ;

	_clockBaseSetAppTime( ) ;
	
	_screenBaseUpdate( ) ;
	_cursorBaseUpdate( ) ;
	_appBaseSave( ) ;

	usleep( _configGet( "appsleepdelay" ) ) ;

}

