<?php
// Frontegg Configuration
define('CLIENT_ID', '04017595-4e5d-4e7e-aff6-93c58d489d2f');
define('API_KEY', '68525549-1876-4d39-a08a-c529d2a2c1af');
define('GATEWAY', 'app-frtqiefxjqn9');
define('PORT', 3000);
define('REDIRECT_URI', 'http://localhost:' . PORT . '/callback.php');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();
?> 