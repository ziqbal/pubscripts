<?php


$server = $_SERVER['HTTP_HOST'] ;

if( substr( $server , -15 ) == "XYZ" ){

        header( "HTTP/1.1 301 Moved Permanently" ) ;
        header( "Location: https://www.XYZ/" ) ;
        exit;

}

print( "." ) ;


