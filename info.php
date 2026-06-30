<?php
// ===== CONFIG =====
$client_id     = "";
$client_secret = ""; //
$redirect_uri  = "https://------.com/info.php";

$token_url = "https://------.com/oauth/token/";
$me_url    = "https://------.com/api/core/me";

if (!isset($_GET['code'])) {
    die("No code received. Go back to <a href='index.php'>login</a>.");
}
$code = $_GET['code'];

$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    "grant_type"    => "authorization_code",
    "client_id"     => $client_id,
    "client_secret" => $client_secret,
    "code"          => $code,
    "redirect_uri"  => $redirect_uri
]));
$response = curl_exec($ch);
if (!$response) {
    die("cURL error: " . curl_error($ch));
}
curl_close($ch);

$token = json_decode($response, true);
if (!isset($token['access_token'])) {
    die("Error getting token: " . htmlspecialchars($response));
}

$ch = curl_init($me_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $token['access_token']
]);
$userInfo = curl_exec($ch);
curl_close($ch);

$user = json_decode($userInfo, true);
if (!isset($user['name'])) {
    die("Error fetching user info: " . htmlspecialchars($userInfo));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= htmlspecialchars($user['name']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
            background: #f7f7f7;
        }
        .card {
            display: inline-block;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>? Logged in successfully!</h1>
        <p>Hello, <strong><?= htmlspecialchars($user['name']) ?></strong></p>
        <p>Your Forum ID: <?= htmlspecialchars($user['id']) ?></p>
        <?php if (isset($user['email'])): ?>
            <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
