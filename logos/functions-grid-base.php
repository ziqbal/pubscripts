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

	//_configBaseSet( "gridwidth" , 10 ) ;
	//_configBaseSet( "gridheight" , 5 ) ;

	_configBaseSet( "gridx" , 0 ) ;
	_configBaseSet( "gridy" , 0 ) ;


	_gridBaseLoad( "out.logos" ) ;

	//_gridBaseInit( ) ;

	//_gridBaseSample( ) ;

	_configBaseSet( "gridmodifytime" , _configBaseGet( "apptime" ) ) ;
	//_logBaseWrite(_configBaseGet("grid"));exit;

}


function _gridBaseSetByte( $byte ) {

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $byte ) ;


}


function _gridBaseQuery( ) {

	// $x, $y , $z

	$grid = _configBaseGet( "grid" ) ;

	$args = func_get_args( ) ;


	if( count( $args ) == 2 ) {

		return( $grid[ $args[ 0 ] ][ $args[ 1 ] ] ) ;

	}

	$grid[ $args[ 0 ] ][ $args[ 1 ] ] = $args[ 2 ] ;

	_configBaseSet( "grid" , $grid ) ;

}




function _gridBaseSetChar( $inch ) {

	$ch=ord($inch);

	$cx = _cursorBaseGetX( ) ;
	$cy = _cursorBaseGetY( ) ;

	_gridBaseSet( $cx-1 , $cy-1 , $ch ) ;


}

function _gridBaseGet( $i , $j ) {

	$grid = _configBaseGet( "grid" ) ;

	$gx = _configBaseGet( "gridx" ) + $i ;
	$gy = _configBaseGet( "gridy" ) + $j ;

	if( ( $gx >= _configBaseQuery( "gridwidth" ) ) || ( $gy >= _configBaseQuery( "gridheight" ) ) ) {

		_logBaseWrite("$gx $gy");
		return(-1);

	}


	return( $grid[ $gx ][ $gy ] ) ;


}

function _gridBaseGetChar( $i , $j ) {

	$grid = _configBaseGet("grid");

	$gx = _configBaseGet( "gridx" ) + $i ;
	$gy = _configBaseGet( "gridy" ) + $j ;

	if( ( $gx >= _configBaseQuery( "gridwidth" ) ) || ( $gy >= _configBaseQuery( "gridheight" ) ) ) {

		_logBaseWrite( "$gx $gy" ) ;
		return( NULL ) ;

	}

	$v=$grid[$gx][$gy];

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

	if( !_configBaseQuery( "loaded" ) ) {
		_gridBaseInit( ) ;
		_logBaseWrite( "_gridBaseLoad NOT LOADED" ) ;
		return ;
	}

	$afp = _configBaseGet( "targetdir" )."/".$fn ;

	if( file_exists( $afp ) ) {

		system( "cp $afp $afp.".time( ) ) ;

		$t1 = file_get_contents( _configBaseGet( "targetdir" )."/".$fn ) ;
		$t1 = _appBaseDecrypt( $t1 ) ;
		$t2 = base64_decode( $t1 ) ;
		$t3 = gzdecode( $t2 ) ;
		$t4 = json_decode( $t3 , true ) ;

		$data = $t4 ;

		_configBaseSet( "grid" , $data[ 'grid' ] ) ;
		$config = $data[ 'config' ] ;
		_configBaseQuery( "config" , $config ) ;
		
	} else {

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






