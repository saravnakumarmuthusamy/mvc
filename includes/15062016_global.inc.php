<?php
session_start();

/*** error reporting on ***/
ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);

$host = 'mysql50-52.wc2.dfw1.stabletransit.com';
$user = '624342_bandjamit';
$pass = 'Bandjamit1';
$name = '624342_bandjamit';

$http = ($_SERVER['HTTPS']) ? 'https://' : 'http://';
define('ROOT_HTTP_PATH', $http.$_SERVER['SERVER_NAME']);
?>