<?php
require_once 'config.php';

if (!isset($_GET['code'])) {
    die('No authorization code received');
}

$authorizationCode = $_GET['code'];
$codeVerifier = $_SESSION['code_verifier'] ?? null;

if (!$codeVerifier) {
    die('No code verifier found in session');
}

// Token endpoint
$tokenEndpoint = 'https://' . GATEWAY . '.frontegg.com/oauth/token';

// Prepare the request body
$requestBody = [
    'grant_type' => 'authorization_code',
    'code' => $authorizationCode,
    'redirect_uri' => REDIRECT_URI,
    'code_verifier' => $codeVerifier
];

// Prepare headers
$headers = [
    'Authorization: Basic ' . base64_encode(CLIENT_ID . ':' . API_KEY),
    'Content-Type: application/x-www-form-urlencoded'
];

// Initialize cURL session
$ch = curl_init($tokenEndpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestBody));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Maximum number of redirects to follow
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Verify SSL certificate
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Verify SSL host

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

// Check for errors
if (curl_errno($ch)) {
    die('Token exchange failed: ' . curl_error($ch));
}

curl_close($ch);

// Process the response
if ($httpCode === 200) {
    $tokenData = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Failed to parse token response: ' . json_last_error_msg());
    }
    echo '<h1>Token Exchange Successful</h1>';
    echo '<p>ID Token: ' . htmlspecialchars($tokenData['id_token']) . '</p>';
    echo '<p>Access Token: ' . htmlspecialchars($tokenData['access_token']) . '</p>';
    echo '<p>You can now close this window.</p>';
} else {
    echo '<h1>Token Exchange Failed</h1>';
    echo '<p>HTTP Status Code: ' . $httpCode . '</p>';
    echo '<p>Final URL: ' . htmlspecialchars($finalUrl) . '</p>';
    echo '<p>Response: ' . htmlspecialchars($response) . '</p>';
    echo '<p>Please try again.</p>';
}
?> 