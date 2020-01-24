<?php

require_once('includes/includes.php');



$userObj = getObject('user');
session_start();
unset($_SESSION['user_info']);
unset($_SESSION['fb_id']);
unset($_SESSION['fb_name']);
unset($_SESSION['fb_email']);
unset($_SESSION['fb_fname']);
unset($_SESSION['fb_lname']);
unset($_SESSION['successMsg']);
unset($_SESSION['login']);
require_once 'fb-login/vendor/autoload.php';
/*$fb = new Facebook\Facebook([
  'app_id' => '345105429569409', // Replace {app-id} with your app id
  'app_secret' => 'b7642c836ac339718c49a8556ffcad23',
  'default_graph_version' => 'v3.2',
  ]);*/

$fb = new Facebook\Facebook([
  'app_id' => '440517836743330', // Replace {app-id} with your app id
  'app_secret' => '461e23da777cad4d94fd6901dc7f6617',
  'default_graph_version' => 'v3.2',
  ]);

//print_r($_SESSION);exit();
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$fbloginUrl = $helper->getLoginUrl(ROOT_HTTP_PATH.'/fb-login/fb-callback.php', $permissions);
$linloginUrl = ROOT_HTTP_PATH.'/linkedIn-login/login.php';
//echo $loginUrl;exit();
if($params['Login'] == '1'){
	$authObj = getObject('authorization');
	//print_r($params);exit();
	$loginSuccess = $authObj->login($params['username'],$params['password']);
	$params = array_merge($params, $_SESSION);
	if(is_array($loginSuccess)){
		header('Location:index.php?msg=userDeleted');
	}else if($loginSuccess){

		$loginUserid=$params['eab_user']['user_id'];

		if($_SESSION['eab_user']['user_type']==2){
			//echo "1";exit();
			$entProfileObj = getObject('entreprenuerprofile');
			$checkprofileEntry= $entProfileObj->checkEntreprenuerProfileEntry($loginUserid);
			$checkEntry = $checkprofileEntry['count'];
			if($checkEntry>0){
				header('Location:entrepreneurPhase1View.php');
			}else{
				header('Location:entreprenuerProfile.php');
			}	
		}else if($_SESSION['eab_user']['user_type']==3){
			//print_r($loginUserid);exit();
			$mntProfileObj = getObject('mentorprofile');
			$checkEntry= $mntProfileObj->checkmentorProfileEntry($loginUserid);
			//echo $checkEntry = $checkEntry['count'];exit();
			$checkEntry = $checkEntry['count'];
			if($checkEntry>0){
				/*echo "MPv";exit();*/
				header('Location:mentorPhase1View.php');
			}else{
				/*echo "MP";exit();*/
				header('Location:mentorProfile.php');
			}
		}else if($_SESSION['eab_user']['user_type']==1){
		
			$adminProfileObj = getObject('adminprofile');
			$checkadminprofileEntry= $adminProfileObj->checkAdminProfileEntry($loginUserid);
		 	$checkAdminEntry = $checkadminprofileEntry['count'];
		 	//echo $checkAdminEntry;exit();
			if($checkAdminEntry>0){
				header('Location:adminProfileView.php');
			}else{
				header('Location:adminProfile.php');  
			}
		}
		
	}else{
		header('Location:index.php');
	}
}
$smarty->assign('fbloginUrl', $fbloginUrl);
$smarty->assign('linloginUrl', $linloginUrl);
$smarty->display('index.tpl');
?>