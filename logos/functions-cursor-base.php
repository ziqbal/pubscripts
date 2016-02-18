<?php



function _cursorBase( ) {

	_configBaseSet( "cursorx" , 1 ) ;
	_configBaseSet( "cursory" , 1 ) ;


	$config=_configBaseGet("config");
	//_logBaseWrite($config);
	if(isset($config['cursor'])){
		_configBaseSet( "cursorx" , $config['cursor']['x'] ) ;
		_configBaseSet( "cursory" , $config['cursor']['y'] ) ;

	}

	_configBaseSet( "cursordirty" , true ) ;

	_configBaseSet( "cursorbackground" , 0 ) ;

	_configBaseSet( "_cursorBaseUpdateRate" , 0.1 ) ;
	_configBaseSet( "_cursorBaseUpdateLast" , 0 ) ;



}

function _cursorBaseUpdate( ) {

	if( _clockBaseTrigger( __FUNCTION__ ) ) {


		$cbg = _configBaseGet( "cursorbackground" ) + 1 ;
		if( $cbg == 8 ) $cbg = 1 ;

		if( _configBaseGet( "appmode" ) == "edit" ) {

			if( $cbg > 1 ) $cbg = 0 ;

			if($cbg==1) {
				system("tput smso");
			} else {
				system("tput rmso");
			}

		}

		if( _configBaseGet( "appmode" ) == "command" ) {

			//if( $cbg > 1 ) $cbg = 0 ;

			//system("tput smso");
			system("tput setab $cbg");

		}		



		_screenHandleShowGridChar( ) ;

		_configBaseSet( "cursorbackground" , $cbg ) ;

	}



}

function _cursorBasePosition( ) {

	$cy = _cursorBaseGetY( ) ;
	$cx = _cursorBaseGetX( ) ;

	system( "tput cup $cy $cx" ) ;	

}

function _cursorBaseIsDirty( ) {

	return( _cursorBaseGetDirty( ) ) ;

}

function _cursorBaseGetDirty( ) {

	return( _configBaseGet( "cursordirty" ) ) ;
	
}

function _cursorBaseSetDirty( $v ) {

	_configBaseSet( "cursordirty" , $v )  ;
	
}


function _cursorBaseSetX( $v ) {

	_configBaseSet( "cursorx" , $v ) ;

}

function _cursorBaseSetY( $v ) {

	_configBaseSet( "cursory" , $v ) ;

}


function _cursorBaseGetX( ) {

	return( _configBaseGet( "cursorx" ) ) ;

}


function _cursorBaseGetY( ) {

	return( _configBaseGet( "cursory" ) ) ;
	
}

function _cursorBaseEnter( ) {

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
	print($ch);

	
	_cursorBaseSetX(1);
	_configBaseSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;


}

function _cursorBaseLeft( ) {

	if(_cursorBaseGetX( )<2){
		return;
	}

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
	print($ch);

	system("tput cub 2");

	_configBaseSet( "cursorx" , _screenBaseGoLeft( _cursorBaseGetX( ) ) ) ;

}

function _cursorBaseLeftNoPrint( ) {

	_cursorBaseSetX( _screenBaseGoLeft( _cursorBaseGetX( ) ) ) ;
	_cursorBasePosition( ) ;

}


function _cursorBaseRight( ) {

	//system("tput sab 0;echo ' ';tput cub1");
	system("tput setab 0");
	$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
	print($ch);
	//system("tput cub1");


	_cursorBaseSetX( _screenBaseGoRight( _cursorBaseGetX( ) ) ) ;

	//_logBaseWrite(_cursorBaseGetX());


}

function _cursorBaseRightNoPrint( ) {

	//system("tput sab 0;echo ' ';tput cub1");
	//system("tput setab 0");
	//print(" ");
	//system("tput cub1");


	_cursorBaseSetX( _screenBaseGoRight( _cursorBaseGetX( ) ) ) ;
	_cursorBasePosition( ) ;

	//_logBaseWrite(_cursorBaseGetX());


}


function _cursorBaseUp( ) {


	system("tput setab 0");

	$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
	print($ch);

	_configBaseSet( "cursory" , _screenBaseGoUp( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;

}


function _cursorBaseDown( ) {

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configBaseGet( "cursorx" )-1,_configBaseGet( "cursory" )-1);
	print($ch);

	_configBaseSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;

}

function _cursorBaseDebug( ) {

	print( _cursorBaseGetX( ).","._cursorBaseGetY( ) ) ;

}

