<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Frontegg Login Flow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Frontegg Login Flow</h1>
    <p>Click the button below to start the login process:</p>
    <a href="login.php" class="login-button">Login with Frontegg</a>
</body>
</html> 