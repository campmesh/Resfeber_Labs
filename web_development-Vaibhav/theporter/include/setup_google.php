<?php
// Includes
require_once 'google-plus-api/apiClient.php';
require_once 'google-plus-api/contrib/apiOauth2Service.php';

// Google API. Obtain these settings from https://code.google.com/apis/console/

$redirect_url = 'http://vivekvishal.in/theporter/login_google.php'; // The url of your web site
$client_id = '540185728630-ll9fo4i3s79n1fj4v6pmp9sea1kv801f.apps.googleusercontent.com';
$client_secret = 'Dqq9yxxr68atX_78gXZuNpK-';
$api_key = '';

// Create a new Google API client
$client = new apiClient();
//$client->setApplicationName("ResferberLabs");
// Configure it
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setDeveloperKey($api_key);
$client->setRedirectUri($redirect_url);
$client->setApprovalPrompt(false);
?>