<?php
require_once('../includes/includes.php');

//checkSpammers();
//Get the Smarty class
require_once(SMARTY_PATH.DS.'Smarty.class.php');
$smarty =  new Smarty();
$smarty->template_dir = TEMPLATE_PATH.DS;
$smarty->compile_dir =  SITE_PATH.DS.'templates_c'.DS;


//Modules
$module = new modules($db);
?>