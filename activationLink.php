<?php
require_once('includes/includes.php');

$userId = (int) base64_decode($_GET['id']);
$key = $_GET['key'];

if(!$userId){
	setMessage('Invalid User Id');
	setRedirect(ROOT_HTTP_PATH);
}

if(!$key){
	setMessage('Invalid Key');
	setRedirect(ROOT_HTTP_PATH);
}

$userObj = getObject('user');
$activation = $userObj->activateUser($userId, $key);
if($activation) {
	setMessage('Please Login To Access Your Account');
	setRedirect(ROOT_HTTP_PATH.'/index');
} else {
	setMessage('Invalid User');
	setRedirect(ROOT_HTTP_PATH);
}
?>