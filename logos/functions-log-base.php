<?php


function _logBase( ) {



}

function _logBaseWrite( $msg ) {


	if(is_array($msg)){
		$msg=print_r($msg,true);
	}

	file_put_contents( "/tmp/logos-log.txt" , "$msg\n" , FILE_APPEND | LOCK_EX ) ;




}