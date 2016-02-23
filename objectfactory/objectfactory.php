<?php


$targetDir = $argv[ 1 ] ;

////////

$object = "objtest" ;

$objectDir = "$targetDir/_{$object}_" ;

if( is_dir( $objectDir ) ) {

	print( "_{$object}_ already exists.\n" ) ;
	exit ;

}


system( "mkdir $targetDir/_{$object}_" ) ; 


////////

$dirs = array( "setup" , "model" , "view" , "controller" , "loop" ) ;

foreach( $dirs as $dir ) {

	$dirpath = "$targetDir/_{$object}_/$dir" ;
	system( "mkdir $dirpath" ) ;


	$partname = ucfirst($dir);

$template = "<?php

function _{$object}{$partname}Boot( ) {

}


" ;

	file_put_contents( "$dirpath/_boot.php" , $template ) ;

}

