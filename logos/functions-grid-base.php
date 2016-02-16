<?php


function _gridBase( ) {

	_gridBaseInit( ) ;

}


function _gridBaseInit( ) {

	$grid = array( ) ;

	for( $x = 0 ; $x < 708 ; $x++ ) {

	  for( $y = 0 ; $y < 168 ; $y++ ) {

	    $grid[ $x ][ $y ] = -1 ;

	  }
	  
	}

	_configSet( "grid" , $grid ) ;

}