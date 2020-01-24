<?php
require_once('includes/includes.php');
$authorization = getObject('authorization');


/*unset($_SESSION['FBRLH_state']);
unset($_SESSION['user_info']);
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_last_name']);*/
unset($_SESSION['eab_user']);
unset($_SESSION['fb_id']);
unset($_SESSION['fb_name']);
unset($_SESSION['fb_email']);
unset($_SESSION['fb_fname']);
unset($_SESSION['fb_lname']);
unset($_SESSION['successMsg']);
unset($_SESSION['login']);

$authorization->logout();
//echo "hello4";exit();
//session_destroy();
setRedirect(ROOT_HTTP_PATH);
?>