<?php



function _screenBase( ) {

	readline_callback_handler_install( '' , function( ) { } ) ;

	_screenBaseUpdateDimensions( ) ;


	// In seconds e.g. 1.5
	_configBaseSet( "_screenBaseUpdateRate" , 0.1 ) ;
	_configBaseSet( "_screenBaseUpdateLast" , 0 ) ;
	_configBaseSet( "_screenBaseViewDirty" , true ) ;


}


function _screenBaseUpdateDimensions( ) {

	$dimensions = _screenHandleGetDimensions( ) ;

	_configBaseSet( "screenwidth" , $dimensions[ 'screenwidth' ] ) ;
	_configBaseSet( "screenheight" , $dimensions[ 'screenheight' ] ) ;

}

function _screenBaseGetWidth( ) {

	return( _configBaseGet( "screenwidth" ) ) ;

}


function _screenBaseGetHeight( ) {

	return( _configBaseGet( "screenheight" ) ) ;

}

function _screenBaseGoRight( $x ) {

	$x++ ;

	$width = _screenBaseGetWidth( ) ;

	if( $x >= ($width-2) ) $x = $width - 2 ;

	return( $x ) ;

}

function _screenBaseGoLeft( $x ) {

	$x-- ;

	if( $x < 1 ) $x = 1 ;

	return( $x ) ;

}

function _screenBaseGoDown( $y ) {

	$y++ ;

	$height = _screenBaseGetHeight( ) ;

	if( $y >= ($height-2) ) $y = $height - 2 ;

	return( $y ) ;

}

function _screenBaseGoUp( $y ) {

	$y-- ;

	if( $y < 1 ) $y = 1 ;

	return( $y ) ;

}


function _screenBaseCleanUp( ) {

	system("tput cnorm");
	system("tput sgr0");	
	system("reset");

}


function _screenBaseViewUpdate( ) {

	if( _configBaseGet( "_screenBaseViewDirty" ) ) {


		$viewx=0;$viewy=0;
		$viewwidth=_configBaseGet( "screenwidth" )-2;
		$viewheight=_configBaseGet( "screenheight" )-2;


		//_logBaseWrite("$viewwidth  $viewheight");



		system("tput setab 0");
		system("tput cup 1 1");
		for($j=0;$j<$viewheight;$j++){

			$line='';
			for($i=0;$i<$viewwidth;$i++){

				$gridvalue = _gridBaseGet( $i , $j ) ;
				$char=32;
				if($gridvalue!=-1){
					$char = $gridvalue & 255 ;	
				}
				$line.=chr($char);

			}

			print($line."\n");
			system("tput cuf 1");
			//_logBaseWrite($line);

		}

		_cursorBasePosition( ) ;		


		_configBaseSet( "_screenBaseViewDirty" , false ) ;


	}


}

function _screenBaseUpdate( ) {


	if( _clockBaseTrigger( __FUNCTION__ ) ) {


		_screenBaseViewUpdate( ) ;





	}



}

function _screenBaseDebug( ) {

	print( _configBaseGet( "screenwidth" )." x "._configBaseGet( "screenheight" ) ) ;

}

