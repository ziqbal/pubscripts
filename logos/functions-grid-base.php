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

	_configBaseSet( "gridwidth" , 708 ) ;
	_configBaseSet( "gridheight" , 168 ) ;

	_configBaseSet( "gridx" , 0 ) ;
	_configBaseSet( "gridy" , 0 ) ;


	_gridBaseLoad( "out.logos" ) ;

	//_gridBaseInit( ) ;

	//_gridBaseSample( ) ;

	_configBaseSet( "gridmodifytime" , _configBaseGet("apptime")) ;
	//_logBaseWrite(_configBaseGet("grid"));exit;

}

function _gridBaseSetByte( $byte ) {

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $byte ) ;


}


function _gridBaseSetChar( $inch ) {

	$ch=ord($inch);

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $ch ) ;


}

function _gridBaseGet( $i , $j ) {

	$grid = _configBaseGet("grid");

	$gx = _configBaseGet( "gridx" ) ;
	$gy = _configBaseGet( "gridy" ) ;
	return($grid[$i+$gx][$j+$gy]);


}

function _gridBaseGetChar( $i , $j ) {

	$grid = _configBaseGet("grid");

	$gx = _configBaseGet( "gridx" ) ;
	$gy = _configBaseGet( "gridy" ) ;

	$v=$grid[$i+$gx][$j+$gy];

	if($v==-1) return(" ") ;

	return( chr( $v & 255 ) ) ;


}

function _gridBaseSet( $vx , $vy , $v ) {

	$grid = _configBaseGet("grid");

	$gx = _configBaseGet( "gridx" ) ;
	$gy = _configBaseGet( "gridy" ) ;

	//_logBaseWrite("[$vx+$gx][$vy+$gy]=$v");
	$grid[$vx+$gx][$vy+$gy]=$v;

	_configBaseSet( "grid" , $grid ) ;

	_configBaseSet( "gridmodifytime" , _configBaseGet("apptime")) ;

}


function _gridBaseLoad( $fn ) {

	$afp = _configBaseGet( "targetdir" )."/".$fn ;

	if( file_exists( $afp ) ) {

		system("cp $afp $afp.".time());

		$data = json_decode( gzdecode( base64_decode( file_get_contents( _configBaseGet( "targetdir" )."/".$fn ) ) ) , true ) ;

		$data=_appBaseDecrypt($data);

		_configBaseSet( "grid" , $data['grid'] );
		$config = $data['config'] ;
		_configBaseQuery("config",$config);
		

	}else{

		_gridBaseInit( ) ;

	}

}

function _gridBaseInit( ) {

	$grid = array( ) ;

	for( $x = 0 ; $x < _configBaseGet( "gridwidth" ) ; $x++ ) {

	  for( $y = 0 ; $y < _configBaseGet( "gridheight" ) ; $y++ ) {

	    $grid[ $x ][ $y ] = -1 ;

	  }
	  
	}

	_configBaseSet( "grid" , $grid ) ;

}


function _gridBaseSample( ) {


	$grid = _configBaseGet("grid");


	$gx = 1 ;
	$gy = 2 ;




	$str = date( 'l jS \of F Y h:i:s A' ) ;
	$strLen = strlen($str);
	for($i=0;$i<$strLen;$i++){

		$grid[$gx+$i][$gy]=ord($str[$i]);

	}

	//_logBaseWrite($grid[$gx]);exit;

	_configBaseSet("grid",$grid);


}




