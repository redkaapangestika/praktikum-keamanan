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
    <title>Selamat Datang - Portal Kelompok 4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
        
        :root {
            --bg-main: #232526;
            --bg-panel: #181c24;
            --bg-card: #23272f;
            --bg-gradient: linear-gradient(135deg, #232526, #414345);
            --text-main: #e0e0e0;
            --text-secondary: #b0b0b0;
            --accent: #4285F4;
            --card-shadow: 0 10px 25px rgba(0,0,0,0.25);
            --divider: #333;
            --github-bg: #24292e;
            --github-hover: #444c56;
            --quote-color: #ffe082;
        }
        body.light-mode {
            --bg-main: #f3f6fa;
            --bg-panel: #fff;
            --bg-card: #f9f9f9;
            --bg-gradient: linear-gradient(135deg, #e3f0ff, #f9f9f9);
            --text-main: #232526;
            --text-secondary: #555;
            --accent: #4285F4;
            --card-shadow: 0 10px 25px rgba(0,0,0,0.08);
            --divider: #e0e0e0;
            --github-bg: #e0e0e0;
            --github-hover: #bdbdbd;
            --quote-color: #fbc02d;
        }
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            transition: background 0.3s, color 0.3s;
        }
        .theme-toggle-btn {
            position: fixed;
            bottom: 24px;
            right: 32px;
            background: var(--bg-card);
            color: var(--text-main);
            border: none;
            border-radius: 16px;
            padding: 6px 18px;
            font-size: 1em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.13);
            transition: background 0.2s, color 0.2s;
            z-index: 1000;
            height: auto;
            width: auto;
            min-width: 0;
        }
        .theme-toggle-btn:hover {
            background: var(--accent);
            color: #fff;
        }
        .split-container {
            display: flex;
            min-height: 100vh;
        }
        .left-panel {
            flex: 1;
            background: var(--bg-panel);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 24px;
        }
        .form-box {
            width: 100%;
            max-width: 370px;
            background: var(--bg-card);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 36px 32px 28px 32px;
            text-align: center;
        }
        .form-box h2 {
            color: var(--accent);
            margin-bottom: 10px;
            font-size: 1.6em;
            font-weight: 700;
        }
        .form-box p {
            color: var(--text-secondary);
            margin-bottom: 28px;
            font-size: 1.05em;
        }
        .google-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            width: 100%;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-bottom: 10px;
            text-decoration: none;
        }
        .google-login-btn:hover {
            background: #3367D6;
        }
        .google-login-btn img {
            width: 24px;
            height: 24px;
        }
        .or-divider {
            margin: 18px 0;
            color: #bbb;
            font-size: 0.95em;
            position: relative;
        }
        .or-divider:before, .or-divider:after {
            content: "";
            display: inline-block;
            width: 40%;
            height: 1px;
            background: var(--divider);
            vertical-align: middle;
            margin: 0 8px;
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--github-bg);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            width: 100%;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-bottom: 10px;
            text-decoration: none;
        }
        .google-btn:hover {
            background: var(--github-hover);
        }
        .google-btn img {
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
        }
        .right-panel {
            flex: 1;
            background: var(--bg-gradient);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--text-main);
            position: relative;
            overflow: hidden;
        }
        .right-panel .logo-box {
            background: rgba(255,255,255,0.07);
            border-radius: 24px;
            padding: 32px 36px;
            margin-bottom: 30px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.10);
        }
        .right-panel .logo-box img {
            width: 80px;
            height: 80px;
            display: block;
            margin: 0 auto;
        }
        .right-panel .quote {
            font-size: 1.1em;
            font-style: italic;
            margin-bottom: 18px;
            text-align: center;
            max-width: 350px;
            color: var(--text-main);
        }
        .right-panel .author {
            font-size: 1em;
            font-weight: 600;
            color: var(--quote-color);
            text-align: center;
        }
        @media (max-width: 900px) {
            .split-container { flex-direction: column; }
            .right-panel, .left-panel { min-height: 320px; }
        }
        @media (max-width: 600px) {
            .form-box { padding: 20px 8vw; }
            .right-panel .logo-box { padding: 18px 12px; }
        }
    </style>
</head>
<body>
    <button class="theme-toggle-btn" id="toggleThemeBtn">Light Mode</button>
    <div class="split-container">
        <div class="left-panel">
            <div class="form-box">
                <h2>Portal Kelompok 4</h2>
                <p>Login dengan akun Google untuk mengakses dashboard anggota dan berita.</p>
                <a href="<?php echo htmlspecialchars($googleOAuthUrl); ?>" class="google-login-btn">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
                    Login dengan Google
                </a>
                <div class="or-divider">atau</div>
                <a href="https://github.com/thirza-rep/google-oauth-project" target="_blank" class="google-btn">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="GitHub">
                    Lihat di GitHub
                </a>
            </div>
        </div>
        <div class="right-panel">
            <div class="logo-box">
                <img src="assets/logo.jpg" alt="Logo Kelompok 4" />
            </div>
            <div class="quote">
                "Bersama, kita membangun aplikasi yang bermanfaat dan modern untuk masa depan."
            </div>
            <div class="author">
                &mdash; Kelompok 4
            </div>
        </div>
    </div>
    <script>
        const btn = document.getElementById('toggleThemeBtn');
        btn.addEventListener('click', function() {
            document.body.classList.toggle('light-mode');
            btn.textContent = document.body.classList.contains('light-mode') ? 'Dark Mode' : 'Light Mode';
        });
    </script>
</body>
</html>