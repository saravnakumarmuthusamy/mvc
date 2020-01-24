<?php
session_start();

/*** error reporting on ***/
ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);

$host = 'mysql50-96.wc2.dfw1.stabletransit.com';
$user = '466649_band';
$pass = 'Band2011';
$name = '466649_band';

define('ROOT_HTTP_PATH', 'http://'.$_SERVER['SERVER_NAME']);
?>