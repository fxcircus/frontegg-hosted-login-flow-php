<?php
// Frontegg Configuration
define('CLIENT_ID', 'YOUR_CLIENT_ID');
define('GATEWAY', 'YOUR_GATEWAY');
define('PORT', 3000);
define('REDIRECT_URI', 'http://localhost:' . PORT . '/callback.php');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();
?> 