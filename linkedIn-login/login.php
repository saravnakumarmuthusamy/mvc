<?php
 
    session_start();
 
    // Script By Qassim Hassan, wp-time.com
 
    if( isset($_SESSION['user_info']) ){ // check if user is logged in
        //header("location: index.php"); // redirect user to index page
        $redirectURL = '../fbstepTwoUser.php?save_lin_det=1';
    	header('Location:'.$redirectURL);
        return false;
    }
 
    include 'config.php'; // include app info
 
    $_SESSION['login'] = 1;
 	$scope = array('r_liteprofile','r_emailaddress');
 	/* echo $scope;exit();*/
    header("location: https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=CSRF&scope=r_liteprofile%20r_emailaddress"); // redirect user to oauth page
 
?>