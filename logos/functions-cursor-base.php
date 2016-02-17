<?php



function _cursorBase( ) {

	_configSet( "cursorx" , 1 ) ;
	_configSet( "cursory" , 1 ) ;
	_configSet( "cursordirty" , true ) ;

	_configSet( "cursorbackground" , 0 ) ;

	_configSet( "_cursorBaseUpdateRate" , 0.1 ) ;
	_configSet( "_cursorBaseUpdateLast" , 0 ) ;



}

function _cursorBaseUpdate( ) {



	if( _clockBaseTrigger( __FUNCTION__ ) ) {

		//_logBaseWrite( "YEA" ) ;


		$cbg = _configGet( "cursorbackground" ) + 1 ;
		if($cbg==8)$cbg=1;

		if(_configget("appmode")=="edit"){
			if($cbg>1)$cbg=0;

		}
	_configSet( "cursorbackground" , $cbg ) ;

		system("tput setab $cbg");

	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
	print($ch);

		$cy = _cursorBaseGetY( ) ;
		$cx = _cursorBaseGetX( ) ;
		system( "tput cup $cy $cx" ) ;



	}



	/*

	$cy = _cursorBaseGetY( ) ;
	$cx = _cursorBaseGetX( ) ;

	//_logBaseWrite($cx);

	system( "tput cup $cy $cx" ) ;
	system( 'tput cnorm' ) ;	

	_cursorBaseSetDirty( false ) ;
	*/

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

	return( _configGet( "cursordirty" ) ) ;
	
}

function _cursorBaseSetDirty( $v ) {

	_configSet( "cursordirty" , $v )  ;
	
}


function _cursorBaseSetX( $v ) {

	_configSet( "cursorx" , $v ) ;

}

function _cursorBaseSetY( $v ) {

	_configSet( "cursory" , $v ) ;

}


function _cursorBaseGetX( ) {

	return( _configGet( "cursorx" ) ) ;

}


function _cursorBaseGetY( ) {

	return( _configGet( "cursory" ) ) ;
	
}

function _cursorBaseEnter( ) {

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
	print($ch);

	
	_cursorBaseSetX(1);
	_configSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;


}

function _cursorBaseLeft( ) {

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
	print($ch);

	system("tput cub 2");

	_configSet( "cursorx" , _screenBaseGoLeft( _cursorBaseGetX( ) ) ) ;

}


function _cursorBaseRight( ) {

	//system("tput sab 0;echo ' ';tput cub1");
	system("tput setab 0");
	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
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

	//_logBaseWrite(_cursorBaseGetX());


}


function _cursorBaseUp( ) {


	system("tput setab 0");

	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
	print($ch);

	_configSet( "cursory" , _screenBaseGoUp( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;

}


function _cursorBaseDown( ) {

	system("tput setab 0");

	$ch = _gridBaseGetChar(_configGet( "cursorx" )-1,_configGet( "cursory" )-1);
	print($ch);

	_configSet( "cursory" , _screenBaseGoDown( _cursorBaseGetY( ) ) ) ;
	_cursorBasePosition( ) ;

}

function _cursorBaseDebug( ) {

	print( _cursorBaseGetX( ).","._cursorBaseGetY( ) ) ;

}

