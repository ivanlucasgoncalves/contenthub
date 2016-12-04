<?php

require '../vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '371815733162514', // Replace {app-id} with your app id
  'app_secret' => '6154d076858cce732dbda0f3f7aeb6dd',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://10.1.1.54:8789/contentHub/theme/social-logins/fb-callback.php', $permissions);

?>
