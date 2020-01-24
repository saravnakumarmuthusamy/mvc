<?php
session_start();
require_once './vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '440517836743330', // Replace {app-id} with your app id
  'app_secret' => '461e23da777cad4d94fd6901dc7f6617',
  'default_graph_version' => 'v3.2',
  ]);

/*$fb = new Facebook\Facebook([
  'app_id' => '345105429569409', // Replace {app-id} with your app id
  'app_secret' => 'b7642c836ac339718c49a8556ffcad23',
  'default_graph_version' => 'v3.2',
  ]);*/

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
/*echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());*/

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
/*echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);
*/
// Validation (these will throw FacebookSDKException's when they fail)
//$tokenMetadata->validateAppId('345105429569409'); // Replace {app-id} with your app id
$tokenMetadata->validateAppId('440517836743330'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  /*echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());*/
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');





try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email,gender', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

/*echo 'Name: ' . $user['name'];*/

/*print_r($user['id']);
print_r($user['name']);
print_r($user['email']);*/


//print_r($user);exit();

$_SESSION['fb_id'] = $user['id'];
$_SESSION['fb_name'] = $user['name'];
$_SESSION['fb_email'] = $user['email'];

$names=explode(' ', $user['name']);

if(count($names) >0){
  $_SESSION['fb_fname']=$names[0];
  $_SESSION['fb_lname']=$names[1];
}else{
  $_SESSION['fb_fname']=$user['name'];
}


//print_r($_SESSION);exit();
$redirectURL = '../fbstepTwoUser.php?save_fb_det=1';
header('Location:'.$redirectURL);

// OR
// echo 'Name: ' . $user->getName();


//age_range,birthday,education,first_name,gender,hometown,last_name,location,name
?>
