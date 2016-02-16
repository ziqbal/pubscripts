<?php


function _appBase( ) {


	_configSet("appframe",0);
	_configSet("appmode","command");


}



function _appBaseGetMode( ) {
	return(_configGet("appmode"));
}

function _appBaseSetMode( $v ) {
	return(_configSet("appmode",$v));
}

function _appBaseGetFrame( ) {
	return(_configGet("appframe"));
}


function _appBaseSetFrame( $v ) {
	return(_configSet("appframe",$v));
}


function _appBaseLoop( ) {

	_cursorBaseHighlightToggle( ) ;
	
	_appBaseSetFrame( _appBaseGetFrame( ) + 1 ) ;

}