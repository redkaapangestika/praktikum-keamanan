<?php
session_start();
require_once 'config.php';

$googleOAuthUrl = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query([
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => 'email profile',
    'access_type' => 'offline',
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Kelompok 4</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .login-container h2 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #333;
        }

        .google-login-btn img {
            width: 240px;
            transition: transform 0.3s;
        }

        .google-login-btn img:hover {
            transform: scale(1.05);
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Masuk ke Dashboard</h2>
        <a href="<?php echo htmlspecialchars($googleOAuthUrl); ?>" class="google-login-btn">
            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Login dengan Google">
        </a>
        <div class="footer">Kelompok 4 - Pemrograman Web Lanjut</div>
    </div>
</body>
</html>
