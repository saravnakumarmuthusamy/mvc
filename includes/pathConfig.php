<?php
$site_path = realpath(dirname(dirname(__FILE__)));

/* Define the physical path for the site */
define ('DS', DIRECTORY_SEPARATOR);
define('SITE_PATH', $site_path);
define('CACHE_PATH', SITE_PATH.DS.'cache');
define('IMAGE_PATH', SITE_PATH.DS.'images');
define('USER_IMAGE_PATH', IMAGE_PATH.DS.'userImages');
define('USER_IMAGE_PATH_THUMB', IMAGE_PATH.DS.'userImages/thumb');
define('BAND_IMAGE_PATH', IMAGE_PATH.DS.'bandImages');
define('USER_EVENT_PATH', IMAGE_PATH.DS.'userEvents');
define('CONTROLLER_PATH', SITE_PATH.DS.'controller');
define('INCLUDE_PATH', SITE_PATH.DS.'includes');
define('SMARTY_PATH', SITE_PATH.DS.'includes'.DS.'smarty'.DS);
define('TEMPLATE_PATH',  SITE_PATH.DS.'templates');

/* Define the HTTP path for the site. */
define('IMAGE_HTTP_PATH', ROOT_HTTP_PATH.'/images');
define('USER_IMAGE_HTTP_PATH', IMAGE_HTTP_PATH.'/userImages');
define('USER_EVENT_HTTP_PATH', IMAGE_HTTP_PATH.'/userEvents');
define('BAND_IMAGE_HTTP_PATH', IMAGE_HTTP_PATH.'/bandImages');
define('BAND_IMAGE_PATH', IMAGE_HTTP_PATH.'/bandImages/thumb');
define('USER_THUMP_IMAGE_PATH', IMAGE_HTTP_PATH.'/userImages/thumb');


?>