<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <style>
        :root {
            --bg-main: #232526;
            --bg-card: #23272f;
            --text-main: #e0e0e0;
            --text-secondary: #b0b0b0;
            --accent: #4285F4;
            --danger: #e53935;
            --danger-hover: #c62828;
        }
        body.light-mode {
            --bg-main: #f3f6fa;
            --bg-card: #fff;
            --text-main: #232526;
            --text-secondary: #555;
            --accent: #4285F4;
            --danger: #e53935;
            --danger-hover: #c62828;
        }
        body {
            margin: 0;
            background: var(--bg-main);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--text-main);
            transition: background 0.3s, color 0.3s;
        }

        .theme-toggle-btn {
            position: absolute;
            top: 24px;
            right: 32px;
            background: var(--bg-card);
            color: var(--text-main);
            border: none;
            border-radius: 20px;
            padding: 8px 22px;
            font-size: 1em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.13);
            transition: background 0.2s, color 0.2s;
            z-index: 10;
        }
        .theme-toggle-btn:hover {
            background: var(--accent);
            color: #fff;
        }

        .profile-container {
            background: var(--bg-card);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            text-align: center;
            width: 350px;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0 0 0 4px var(--accent);
        }

        .profile-container h2 {
            margin: 0 0 10px;
            color: var(--accent);
        }

        .profile-container p {
            margin: 6px 0;
            color: var(--text-secondary);
        }

        .profile-container a {
            display: inline-block;
            margin-top: 20px;
            background: var(--danger);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .profile-container a:hover {
            background: var(--danger-hover);
        }
    </style>
</head>
<body>
    <button class="theme-toggle-btn" id="toggleThemeBtn">Light Mode</button>
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user['picture']); ?>" alt="Foto Profil">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>ID Google:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
        <a href="home.php">🔙 Kembali ke Dashboard</a>
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
