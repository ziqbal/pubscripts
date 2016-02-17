<?php


/*

STATUS CONTROL FOREGROUND 	  BACKGROUND CHAR
0000 	0000   0000 		  0000 		 00000000

SSSSRUDHFFFFBBBBCCCCCCCC

R = Reverse
U = Underline
D = DIM [dim]
H = Highlight/Bold [bold]

-1 not used

*/

function _gridBase( ) {

	_configSet( "gridwidth" , 708 ) ;
	_configSet( "gridheight" , 168 ) ;

	_configSet( "gridx" , 0 ) ;
	_configSet( "gridy" , 0 ) ;


	_gridBaseLoad("out.logos");

	//_gridBaseInit( ) ;

	//_gridBaseSample( ) ;

	_configSet( "gridmodifytime" , _configGet("apptime")) ;
	//_logBaseWrite(_configGet("grid"));exit;

}

function _gridBaseSetCharFromKeyboard( ) {

	$ch=ord(_keyboardBaseGetInput());

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $ch ) ;


}

function _gridBaseSetChar( $inch ) {

	$ch=ord($inch);

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $ch ) ;


}

function _gridBaseGet( $i , $j ) {

	$grid = _configGet("grid");

	$gx = _configGet( "gridx" ) ;
	$gy = _configGet( "gridy" ) ;
	return($grid[$i+$gx][$j+$gy]);


}

function _gridBaseGetChar( $i , $j ) {

	$grid = _configGet("grid");

	$gx = _configGet( "gridx" ) ;
	$gy = _configGet( "gridy" ) ;

	$v=$grid[$i+$gx][$j+$gy];

	if($v==-1) return(" ") ;

	return( chr( $v & 255 ) ) ;


}

function _gridBaseSet( $vx , $vy , $v ) {

	$grid = _configGet("grid");

	$gx = _configGet( "gridx" ) ;
	$gy = _configGet( "gridy" ) ;

	//_logBaseWrite("[$vx+$gx][$vy+$gy]=$v");
	$grid[$vx+$gx][$vy+$gy]=$v;

	_configSet( "grid" , $grid ) ;

	_configSet( "gridmodifytime" , _configGet("apptime")) ;

}


function _gridBaseLoad( $fn ) {

	$afp = _configGet( "targetdir" )."/".$fn ;

	if(file_exists($afp)){

		_configSet( "grid" , json_decode( gzdecode( file_get_contents( _configGet( "targetdir" )."/".$fn ) ) , true ) ) ;

	}else{

		_gridBaseInit( ) ;

	}

}

function _gridBaseInit( ) {

	$grid = array( ) ;

	for( $x = 0 ; $x < _configGet( "gridwidth" ) ; $x++ ) {

	  for( $y = 0 ; $y < _configGet( "gridheight" ) ; $y++ ) {

	    $grid[ $x ][ $y ] = -1 ;

	  }
	  
	}

	_configSet( "grid" , $grid ) ;

}


function _gridBaseSample( ) {


	$grid = _configGet("grid");


	$gx = 1 ;
	$gy = 2 ;




	$str = date( 'l jS \of F Y h:i:s A' ) ;
	$strLen = strlen($str);
	for($i=0;$i<$strLen;$i++){

		$grid[$gx+$i][$gy]=ord($str[$i]);

	}

	//_logBaseWrite($grid[$gx]);exit;

	_configSet("grid",$grid);


}




