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

function _appBaseLoadSession( ) {


	_gridBaseLoad( "out.logos" ) ;


	_cursorBaseLoadFromConfig( ) ;




}

function _appBaseSaveSession( ) {

	if( ! _configBaseQuery( "loaded" ) ) {

		_logBaseWrite( "_appBaseSaveSession NOT LOADED" ) ;
		return ;

	}

	$data = array( ) ;
	$data[ 'grid' ] = _configBaseGet( "grid" ) ;

	$config = array( ) ;
	$config[ 'cursor' ][ 'x' ] = _cursorBaseGetX( ) ;
	$config[ 'cursor' ][ 'y' ] = _cursorBaseGetY( ) ;

	$data[ 'config' ] = $config ;

	//_logBaseWrite($config);

	$t1 = json_encode( $data ) ;
	$t2 = gzencode( $t1 , 9 ) ;
	$t3 = base64_encode( $t2 ) ;

	$encoded = _appBaseEncrypt( $t3 ) ;

	file_put_contents( _configBaseGet( "targetdir" )."/out.logos" , $encoded ) ;	

}

function _appBaseEncrypt( $data ) {

	//return($data);

	$key = substr( _configBaseQuery( "loadedHash" ) , 0 , \Sodium\CRYPTO_SECRETBOX_KEYBYTES ) ; 

	$nonce = \Sodium\randombytes_buf( \Sodium\CRYPTO_SECRETBOX_NONCEBYTES ) ;

	$res = $nonce.\Sodium\crypto_secretbox( $data , $nonce, $key ) ;

	return( $res );

}

function _appBaseDecrypt( $data ) {

	$key = substr( _configBaseQuery( "loadedHash" ) , 0 , \Sodium\CRYPTO_SECRETBOX_KEYBYTES ) ; 

	$decoded = $data ;
	
    $nonce = mb_substr( $decoded , 0 , \Sodium\CRYPTO_SECRETBOX_NONCEBYTES , '8bit' ) ;
    $ciphertext = mb_substr( $decoded , \Sodium\CRYPTO_SECRETBOX_NONCEBYTES , null , '8bit' ) ;
    
    $decrypted = \Sodium\crypto_secretbox_open( $ciphertext, $nonce, $key ) ;

	if ( $decrypted === false ) {

		_logBaseWrite( "_appBaseDecryptERR!" ) ;
		_screenBaseCleanUp( ) ;

		exit ;

	}    

	return( $decrypted ) ;

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

