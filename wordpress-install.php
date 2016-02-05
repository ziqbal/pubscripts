<?php


if( count( $argv ) < 2 ) { print( "More args!" ) ; exit ; }

$_CONFIG = array( ) ;
$_CONFIG[ "originalargs" ] = $argv ;


if(!isset($_CONFIG["originalargs"][2])){
	print("project name required!");
	exit;
}

$_CONFIG[ "targetdir" ] = $argv[1] ;
//print_r($_CONFIG);

/////////

$APPARCHIVE = "/Users/zaf/Downloads/wordpress.zip" ;

if(!file_exists($APPARCHIVE)){
	print("$APPARCHIVE does not exist!");
	exit;
}

$projectname = strtolower($_CONFIG[ "originalargs" ][ 2 ] );

//print($_CONFIG["targetdir"]."/wordpress".$projectname);exit;
if(is_dir($_CONFIG["targetdir"]."/wordpress".$projectname)){
	print($_CONFIG["targetdir"]."/wordpress".$projectname." already exists!");
	exit;

}

$shortprojectname=$projectname;
if(strlen($projectname)>10){
	$shortprojectname=substr($projectname,0,5).substr($projectname,-5);
}

print("Using database [$projectname] user [$shortprojectname] password [$shortprojectname] ...\n");
print($_CONFIG[ "targetdir" ] );
//print( $projectname ) ;


$dbcmds = array( ) ;
$dbcmds[ ] = "DROP DATABASE IF EXISTS wp{$projectname};" ;
$dbcmds[ ] = "CREATE DATABASE wp{$projectname} collate utf8_unicode_ci;" ;
$dbcmds[ ] = "grant all on `wp{$projectname}`.* to '$shortprojectname'@'localhost' identified by '$shortprojectname';" ;
$dbcmds[ ] = "FLUSH PRIVILEGES;" ;

//print_r($dbcmds);

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";

 try {
     $DBcon = new PDO("mysql:host={$DB_host};",$DB_user,$DB_pass); 
     $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
     echo "ERROR : ".$e->getMessage();
 }

foreach($dbcmds as $dbcmd ){
	try{
	$DBcon->exec($dbcmd);
	}catch(PDOException $e){
		if(!substr($dbcmd,0,strlen("DROP USER"))=="DROP USER"){
			print($e->getMessage());
			exit;
		}else{
			print($e->getMessage());
			print("CONTINUE");
		}
	}
}



$WPCONFIG  = <<<END

<?php

define('DB_NAME', 'wp{$projectname}');
define('DB_USER', '$shortprojectname');
define('DB_PASSWORD', '$shortprojectname');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('AUTH_KEY',         '/_TgTP8Gb)_dVa0kzmu?4--BD@1@Hk(L.k*xV)ED:3=fz9)dqoGYO&#.\${[|_}8;');
define('SECURE_AUTH_KEY',  'Rx*1PU6+Ds8>VV@{S|w|?qHl}I 8rr:Rq]+idOAF[L*;e8~OqVc5pI9?|LOg&hN2');
define('LOGGED_IN_KEY',    '$~VHEf2F<O){;Y{P4WD[>J^zWK2 DFq(UX-_1+iOWbJ=U3Yn0;}=Ji-UXV};t@(a');
define('NONCE_KEY',        'J4V0?rK?t_775<CVjQ%7LDE7ksCfz8xw%0|Ut!V$!+fa<ZD8x? l[:Vo)1+Fh;_h');
define('AUTH_SALT',        'omR<Cu-61t*Q><gtq9P#>dl_!YJ?);T3A81&(gE/R:,n%orgG_Tob( yA[LBrAr2');
define('SECURE_AUTH_SALT', '=M:&eKP0GwS(NXC}pA_C[U$k#r<l*Ww(lNxiy &o%5u|O0MR9Oi<=2U{O0:/e6^7');
define('LOGGED_IN_SALT',   '=1TH5#z$T ?*=EWuE6%IND/%s!)_SloTO8iB;r1eSNBEN*m&H>7[Om;LQpW^jGf;');
define('NONCE_SALT',       'Pj3+#lq*%xGFg?1#-L~^ER` <=Nu|p]>H=+C0=>v53O$r5|mw1z.u C5FS~<8(-p');

\$table_prefix  = 'wptest_';

define('WP_DEBUG', false);
define('WP_POST_REVISIONS',false);
define('AUTOSAVE_INTERVAL',600);
@ini_set( 'log_errors','On' );
@ini_set( 'display_errors','Off' );
@ini_set( 'error_log','/tmp/php_error.log' );
define('WP_DEBUG_LOG', true);

define( 'WP_SITEURL' , 'http://192.168.1.100/_craft_/wordpress{$projectname}' ) ;
define( 'WP_HOME' , 'http://192.168.1.100/_craft_/wordpress{$projectname}' ) ;

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');

END;

file_put_contents("/tmp/wp-config.php","$WPCONFIG");


$syscmds = array();
$syscmds[]="cd /tmp/;rm -rf wordpress;unzip $APPARCHIVE;";
$syscmds[]="mv /tmp/wordpress ./wordpress{$projectname}";
$syscmds[]="mkdir wordpress{$projectname}/wp-content/uploads/";
$syscmds[]="chmod ugo+rwx wordpress{$projectname}/wp-content/uploads/";
$syscmds[]="touch wordpress{$projectname}/.htaccess";
$syscmds[]="cp /tmp/wp-config.php wordpress{$projectname}/";


chdir($_CONFIG[ "targetdir" ]);
foreach($syscmds as $syscmd){
	system($syscmd);
}


print("\n=============================================\n");
print($_CONFIG["targetdir"]."/wordpress".$projectname);
print("\n=============================================\n");



