<?php
include("php-sdk-fb/facebook.php");//For FB
//~~~~~~~~~~FACEBOOK LOGIN START~~~~~~~~~~~~~~~
// Create our Application instance (replace this with your appId and secret).	
$facebook = new Facebook(array(
  'appId'  => '292685000903014',
  'secret' => '9ac03d2a6c693404fc9fbc9856027f3f',
  'allowSignedRequest' => false,
));

$params = array(
  'scope' => 'email',
  'redirect_uri' => 'http://vivekvishal.in/theporter/login_fb.php'
  );
  


?>