<?php

require_once "Facebook/autoload.php";

$fb = new Facebook\Facebook([
    'app_id' => '290667678113610', // Replace {app-id} with your app id
    'app_secret' => 'eb08da22b9dfb9f5a5cfd275c3a1c2aa',
    'default_graph_version' => 'v2.1',
]);

$helper = $fb->getRedirectLoginHelper();

$redirectURL ="http://localhost/B2/B2_TP_PHP_Sondages/Iteration_4/Srcs/Facebook/fb-callback.php";
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

