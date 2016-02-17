<?php



function _screenBase( ) {

	readline_callback_handler_install( '' , function( ) { } ) ;

	_screenBaseUpdateDimensions( ) ;


	// In seconds e.g. 1.5
	_configSet( "_screenBaseUpdateRate" , 0.1 ) ;
	_configSet( "_screenBaseUpdateLast" , 0 ) ;
	_configSet( "_screenBaseViewDirty" , true ) ;


}


function _screenBaseUpdateDimensions( ) {

	$dimensions = _screenHandleGetDimensions( ) ;

	_configSet( "screenwidth" , $dimensions[ 'screenwidth' ] ) ;
	_configSet( "screenheight" , $dimensions[ 'screenheight' ] ) ;

}

function _screenBaseGetWidth( ) {

	return( _configGet( "screenwidth" ) ) ;

}


function _screenBaseGetHeight( ) {

	return( _configGet( "screenheight" ) ) ;

}

function _screenBaseGoRight( $x ) {

	$x++ ;

	$width = _screenBaseGetWidth( ) ;

	if( $x >= $width ) $x = $width - 1 ;

	return( $x ) ;

}

function _screenBaseGoLeft( $x ) {

	$x-- ;

	if( $x < 0 ) $x = 0 ;

	return( $x ) ;

}

function _screenBaseGoDown( $y ) {

	$y++ ;

	$height = _screenBaseGetHeight( ) ;

	if( $y >= $height ) $y = $height - 1 ;

	return( $y ) ;

}

function _screenBaseGoUp( $y ) {

	$y-- ;

	if( $y < 0 ) $y = 0 ;

	return( $y ) ;

}


function _screenBaseCleanUp( ) {

	system("tput cnorm");
	system("tput sgr0");	
	system("reset");

}


function _screenBaseViewUpdate( ) {

	if( _configGet( "_screenBaseViewDirty" ) ) {


		$viewx=0;$viewy=0;
		$viewwidth=_configGet( "screenwidth" )-2;
		$viewheight=_configGet( "screenheight" )-2;


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


		_configSet( "_screenBaseViewDirty" , false ) ;


	}


}

function _screenBaseUpdate( ) {


	if( _clockBaseTrigger( __FUNCTION__ ) ) {


		_screenBaseViewUpdate( ) ;





	}



}

function _screenBaseDebug( ) {

	print( _configGet( "screenwidth" )." x "._configGet( "screenheight" ) ) ;

}

