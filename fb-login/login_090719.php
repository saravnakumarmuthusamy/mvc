<?php
session_start();
require_once './vendor/autoload.php';
/*$fb = new Facebook\Facebook([
  'app_id' => '440517836743330', // Replace {app-id} with your app id
  'app_secret' => '461e23da777cad4d94fd6901dc7f6617',
  'default_graph_version' => 'v3.2',
  ]);*/

$fb = new Facebook\Facebook([
  'app_id' => '345105429569409', // Replace {app-id} with your app id
  'app_secret' => 'b7642c836ac339718c49a8556ffcad23',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions

$loginUrl = $helper->getLoginUrl('https://love.sam.ai/EAB/fb-login/fb-callback.php', $permissions);
echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>