<?php


require_once 'vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '290667678113610', // Replace {app-id} with your app id
    'app_secret' => 'eb08da22b9dfb9f5a5cfd275c3a1c2aa',
    'default_graph_version' => 'v2.1',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';