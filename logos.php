<?php


//if( count( $argv ) < 2 ) { print( "More args!" ) ; exit ; }

$_CONFIG = array( ) ;
$_CONFIG[ "originalargs" ] = $argv ;

/*
if(!isset($_CONFIG["originalargs"][2])){
  print("project name required!");
  exit;
}
*/

$_CONFIG[ "targetdir" ] = $argv[ 1 ] ;
//print_r( $_CONFIG ) ; exit ;

/////

$grid=array();
for($x=0;$x<256;$x++){
  for($y=0;$y<256;$y++){
    $grid[$x][$y]=-1;
  }
}

$sw=20;
$sh=20;

$cx = 0 ;
$cy = 0 ;
$updateCursor=true;
$chighlight=1;

$mode='command';

readline_callback_handler_install( '' , function( ) { } ) ;

system('tput clear');

$frame = 0 ;

while( true ) {

  $r = array( STDIN ) ;
  $w = NULL ;
  $e = NULL ;

  $n = stream_select( $r , $w , $e , 0 ) ;

  if( $n && in_array( STDIN , $r ) ) {

	system( 'echo "lines\ncols" | tput -S > /tmp/tput.dat' ) ;

	//system('tput clear');
//	system('tput cup 0 0');
    $c = stream_get_contents( STDIN , 1 ) ;

    //echo "Char read: [$c] [".ord($c)."]\n" ;

    //$f=file_get_contents("/tmp/tput.dat");
   	//print_r($f); 

    if($mode=='command'){

    if( $c == 'j' ){
      $cx-- ;
      if($cx<0) $cx = 0 ;
      $updateCursor=true;
    }
    if( $c == 'k' ){
      $cx++ ;
      if($cx>$sw) $cx = $sw ;
      $updateCursor=true;
    }
    if( $c == 'd' ){
      $cy-- ;
      if($cy<0) $cy = 0 ;
      $updateCursor=true;
    }
    if( $c == 'f' ){
      $cy++ ;
      if($cy>$sh) $cy = $sh ;
      $updateCursor=true;
    }
    if( $c == 'q' ) break ;
    if(ord($c)==27){
      $mode="edit";
    }    
      continue;

    }


    if(ord($c)==27){
      $mode="command";
      $updateCursor=true;
      continue;
    }

    if($mode=='edit'){
      print("$c");
      system('tput cnorm');
    }


  }

  if($updateCursor){
    system("tput cup $cy $cx");
      system('tput cnorm');
    //system("tput setb 2");
    //print("*");
    //system("tput cup $cy $cx");
    $updateCursor=false;

  }

  $frame++;

  if($mode=='edit'){
    $cursorFlashTrigger=500000;
  }else{
    $cursorFlashTrigger=100000;

  }

  if(($frame%$cursorFlashTrigger)==0){
    if($chighlight==1){
      //system('tput setb 4');
      system('tput cnorm');
    }else{
      //system('tput setb 0');
      system('tput civis');
    }
    $chighlight*=-1;
    //print(".");
  }

}

system('tput clear');
system('tput cnorm');
system("tput sgr0");

