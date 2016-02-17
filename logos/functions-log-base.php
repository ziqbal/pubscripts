<?php


function _logBase( ) {


	_logBaseWrite("\n#BOOT#".date( 'l jS \of F Y h:i:s A' ));



}

function _logBaseWrite( $msg ) {


	if(is_array($msg)){
		$msg=print_r($msg,true);
	}

	file_put_contents( "/tmp/logos-log.txt" , "$msg\n" , FILE_APPEND | LOCK_EX ) ;




}
