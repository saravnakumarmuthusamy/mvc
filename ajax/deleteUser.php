<?php
require_once('header.php');
$userobj = getObject('user');
if(isset($params['deleteUser'])){

	//print_r($params);exit;
	$del_user_id = $params['del_user_id'];
	$is_deleted = $params['is_deleted'];
	$data = $userobj->deleteUser($del_user_id,$is_deleted);
	//print_r($data);exit();
	if($data){
		$result = array('success'=>1 ,'message'=>'User Deleted Successfully' );
	}else{
		$result = array('success'=>0 ,'message'=>'Action Failed' );
	}
		echo json_encode($result);exit();
}


if(isset($params['userExists'])){

	//print_r($params);exit;
	$check_email = $params['check_email'];
	
	$data = $userobj->checkUserEmailExists($check_email);

	//print_r($data);exit();

	if($data){
		$result = array('success'=>1 ,'message'=>'Email Already Exists' );
	}else{
		$result = array('success'=>0 ,'message'=>'Action Failed' );
	}
		echo json_encode($result);exit();
}


if(isset($params['validUser'])){

	//print_r($params);exit;
	$check_email = $params['check_email'];
	$check_password = $params['check_password'];
	
	$data = $userobj->checkLogin($check_email,$check_password);

	//print_r($data);exit();

	if($data){
		$result = array('success'=>1 ,'message'=>'Login Successfully');
	}else{
		$result = array('success'=>0 ,'message'=>'UserName and Password are Incorrect' );
	}
		echo json_encode($result);exit();
}

