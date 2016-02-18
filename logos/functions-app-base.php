<?php


function _appBase( ) {

	_configBaseSet( "appframe" , 0 ) ;
	_configBaseSet( "appmode" , "command" ) ;

	// In microseconds
	_configBaseSet( "appsleepdelay" , 10000 ) ;
	_configBaseSet( "_appBaseSaveRate" , 3 ) ;
	//_configBaseSet( "_appBaseSaveLast" , 0 ) ;

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

	return( _configBaseGet( "appmode" ) ) ;

}

function _appBaseSetMode( $v ) {

	return( _configBaseSet( "appmode" , $v ) ) ;

}

function _appBaseGetFrame( ) {

	return( _configBaseGet( "appframe" ) ) ;

}


function _appBaseSetFrame( $v ) {

	return( _configBaseSet( "appframe" , $v ) ) ;

}


function _appBaseSave( ) {

	if( _clockBaseTrigger( __FUNCTION__ ) ) {

		if(_configBaseGet("gridmodifytime")==-1) return;

		if( ( _configBaseGet("apptime") - _configBaseGet("gridmodifytime") ) > 3 ){

			_logBaseWrite( __FUNCTION__ ) ;
			_configBaseSet("gridmodifytime",-1);

			_appBaseSaveSession( ) ;


		}

	}



}


function _appBaseForceSave( ) {

	_logBaseWrite(__FUNCTION__);
	//if(_configBaseGet("gridmodifytime")==-1) return;

	_configBaseSet("gridmodifytime",-1);


	_appBaseSaveSession( ) ;

	_configBaseSet("gridmodifytime",-1);



}

function _appBaseSaveSession( ) {

	$data = array( ) ;
	$data[ 'grid' ] = _configBaseGet( "grid" ) ;

	$config = array( ) ;
	$config['cursor']['x']=_cursorBaseGetX();
	$config['cursor']['y']=_cursorBaseGetY();

	$data['config']=$config;

	//_logBaseWrite($config);

	$encoded = _appBaseEncrypt( base64_encode( gzencode( json_encode( $data ) , 9 ) ) ) ;

	file_put_contents( _configBaseGet( "targetdir")."/out.logos" , $encoded ) ;	

}

function _appBaseEncrypt( $data ) {

	return($data);

}

function _appBaseDecrypt( $data ) {

	return($data);

}

function _appBaseLoop( ) {

	_appBaseSetFrame( _appBaseGetFrame( ) + 1 ) ;

	_appHandleInput( ) ;

	_clockBaseSetAppTime( ) ;
	
	_screenBaseUpdate( ) ;
	_cursorBaseUpdate( ) ;
	_appBaseSave( ) ;

	usleep( _configBaseGet( "appsleepdelay" ) ) ;

	if( _keyboardBaseHandleQuit( ) && ( _appBaseGetMode( ) == "command" ) ) return( false ) ;

	return( true ) ;

}

