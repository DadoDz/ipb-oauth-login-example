<?php
// ===== CONFIG =====
$client_id    = "";
$redirect_uri = "https://------.com/info.php";
$auth_url     = "https://------.com/oauth/authorize/";

// ===== BUILD LOGIN URL =====
$login_url = $auth_url . "?client_id=" . urlencode($client_id) .
             "&response_type=code" .
             "&redirect_uri=" . urlencode($redirect_uri) .
             "&scope=profile email"; // request profile + email scopes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login with Forum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
            background: #f7f7f7;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 8px;
            background: #0073e6;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn:hover {
            background: #005bb5;
        }
    </style>
</head>
<body>
    <h1>Welcome</h1>
    <p>Please log in with your forum account:</p>
    <a class="btn" href="<?= $login_url ?>">Login with Forum</a>
</body>
</html>