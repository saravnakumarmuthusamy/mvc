<?php
session_start();

/*** error reporting on ***/
ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);

/*$host = 'sam-development.cajtllpanexw.us-east-2.rds.amazonaws.com';
$user = 'samdev';
$pass = 'bU+;[4NS';
$name = 'eab_portal';*/

$host = 'sam-production.cajtllpanexw.us-east-2.rds.amazonaws.com';
$user = '466649_leadsk';
$pass = 'IatPzcK7';
$name = 'eab_portal';
//$dbType = 'mysql';


$http = ($_SERVER['HTTPS']) ? 'https://' : 'http://';


if($_SERVER['SERVER_NAME']) {
	define('ROOT_HTTP_PATH', 'https://'.$_SERVER['SERVER_NAME'].'/EAB');
} else {
	define('ROOT_HTTP_PATH', 'https://love.sam.ai/EAB');
}

?>