<?php
require_once 'config.php';

function createRandomString($length = 16) {
    $possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $text = '';
    
    for ($i = 0; $i < $length; $i++) {
        $text .= $possible[random_int(0, strlen($possible) - 1)];
    }
    
    return $text;
}

function generateCodeChallenge($codeVerifier) {
    $hash = hash('sha256', $codeVerifier, true);
    $codeChallenge = base64_encode($hash);
    $codeChallenge = str_replace(['+', '/', '='], ['-', '_', ''], $codeChallenge);
    return $codeChallenge;
}
?> 