<?php
 
    // Script By Qassim Hassan, wp-time.com
 
    session_start();
 
    if( isset($_SESSION['user_info']) or !isset($_SESSION['login']) ){ // if user is logged in
       // header("location: index.php"); // redirect user to index page
        $redirectURL = '../fbstepTwoUser.php?save_lin_det=1';
        header('Location:'.$redirectURL);
        return false;
    }
 
    include 'Qassim_HTTP.php'; // include Qassim_HTTP() function
 
    include 'config.php'; // include app data
 
    $code = $_GET['code'];
 
    /* Get User Access Token */
 
    $method_ = 1; // method = 1, because we want POST method
 
    //$url_ = "https://www.linkedin.com/uas/oauth2/accessToken";
    $url_ = "https://www.linkedin.com/oauth/v2/accessToken";
 
    $header_ = array( "Content-Type: application/x-www-form-urlencoded" );
 
    $data_ = http_build_query( array(
        "client_id" => $client_id,
        "client_secret" => $client_secret,
        "redirect_uri" => $redirect_uri,
        "grant_type" => "authorization_code",
        "code" => $code
    ));
 
    $json_ = 1; // json = 1, because we want JSON response
 
    $get_access_token = Qassim_HTTP($method_, $url_, $header_, $data_, $json_);
 
    $access_token = $get_access_token['access_token']; // user access token
 
    /* Get User Info */
 
    $method = 0; // method = 0, because we want GET method
 
    //$url = "https://api.linkedin.com/v1/people/~:(id,num-connections,picture-url,email-address,first-name,last-name,picture-urls::(original))?format=json"; 
    // read about field: https://developer.linkedin.com/docs/fields/basic-profile
    $url = "https://api.linkedin.com/v2/me?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))";
 
    $header = array("Authorization: Bearer $access_token");
 
    $data = 0; // data = 0, because we do not have data
 
    $json = 1; // json = 1, because we want JSON response
 
    $user_info = Qassim_HTTP($method, $url, $header, $data, $json);


    $methodEmail = 0; // method = 0, because we want GET method
 
    //$url = "https://api.linkedin.com/v1/people/~:(id,num-connections,picture-url,email-address,first-name,last-name,picture-urls::(original))?format=json"; 
    // read about field: https://developer.linkedin.com/docs/fields/basic-profile
    $urlEmail = "https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))";
 
    $headerEmail = array("Authorization: Bearer $access_token");
 
    $dataEmail = 0; // data = 0, because we do not have data
 
    $jsonEmail = 1; // json = 1, because we want JSON response
 
    $user_infoEmail = Qassim_HTTP2($methodEmail, $urlEmail, $headerEmail, $dataEmail, $jsonEmail);
    //echo $user_info;exit();
    $email = $user_infoEmail['elements'][0]['handle~']['emailAddress'];
    $firstName = $user_info['firstName']['localized']['en_US'];
    $lastName = $user_info['lastName']['localized']['en_US'];
    $linkedinId = $user_info['id'];

    $uInfo = array('firstName'=>$firstName,'linkedinId'=>$linkedinId,'lastName'=>$lastName,'emailAddress'=>$email);
    //print_r($user_info['id']);exit();
    $_SESSION['eab_user_info'] = $uInfo; // save user info in session
    

    $redirectURL = '../fbstepTwoUser.php?save_lin_det=1';
    header('Location:'.$redirectURL);
   // header("location: index.php"); // redirect user to index page
 
?>