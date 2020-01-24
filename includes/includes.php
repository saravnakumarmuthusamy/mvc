<?php
ini_set('memory_limit', '-1');
require_once('global.inc.php');
require_once('pathConfig.php');
require_once('modules.php');
require_once('functions.inc.php');
require_once('commonSettings.php');
require_once('emailTemplates.php');
//require_once(SITE_PATH.'/controller/videoRate.php');
require_once(SITE_PATH.'/library/Mail.php');
require_once(SITE_PATH.'/library/class.database.mysql.php');
require_once(SITE_PATH.'/library/class.table.php');
require_once(SITE_PATH.'/library/class.page.php');
require_once(SITE_PATH.'/library/class.cache.php');
//require_once(SITE_PATH.'/facebook/config.php');

$db = new database($host,$user,$pass,$name);

$module = new modules($db);

//Get the Post, Get, Session, Cookie Variable

if(get_magic_quotes_gpc()){
	//$_REQUEST = array_map('stripslashes',$_REQUEST);
}

$params = $_REQUEST;

$params = array_merge($params, $_SESSION);

//Get the Smarty class
require_once(SMARTY_PATH.'Smarty.class.php');
$smarty =  new Smarty();
$smarty->template_dir = TEMPLATE_PATH.'/';
$smarty->compile_dir =  SITE_PATH.'/templates_c/';

$smarty->assign('appId', $appId);

ob_start();