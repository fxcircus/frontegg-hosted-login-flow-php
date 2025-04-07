<?php
require_once 'config.php';
require_once 'utils.php';

// Generate code verifier and store it in session
$codeVerifier = createRandomString();
$_SESSION['code_verifier'] = $codeVerifier;

// Generate code challenge
$codeChallenge = generateCodeChallenge($codeVerifier);

// Construct the authorization URL
$authUrl = 'https://' . GATEWAY . '.frontegg.com/oauth/authorize?' .
    'response_type=code' .
    '&scope=openId' .
    '&client_id=' . CLIENT_ID .
    '&redirect_uri=' . urlencode(REDIRECT_URI) .
    '&code_challenge=' . $codeChallenge;

// Redirect to the authorization URL
header('Location: ' . $authUrl);
exit;
?> 