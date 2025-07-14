<?php
session_start();

// Simulasi login dummy jika belum login
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'name' => 'Admin Kelompok 4',
        'picture' => 'img/admin.jpg'
    ];
}

$user = $_SESSION['user'];

// Data anggota
$berita = [
    [
        'judul' => 'Retno Dwi Pangestika',
        'isi' => 'Kamu lebih kuat dari yang kamu pikirkan, dan lebih mampu dari yang kamu bayangkan. Selalu percaya pada dirimu sendiri, bahkan ketika orang lain meragukanmu.',
        'tanggal' => '22230018',
        'link' => 'https://github.com/redkaapangestika',
        'role' => 'Front-End Developer',
        'foto' => 'assets/retno.jpg'
    ],
    [
        'judul' => 'Prasetio Umbu Sangaji Pateduk',
        'isi' => 'Kesuksesan tidak datang secara instan, ia adalah hasil dari usaha yang konsisten. Percayalah pada proses, bukan hanya pada hasil.',
        'tanggal' => '22230024',
        'link' => 'https://github.com/tioA81',
        'role' => 'Back-End Developer',
        'foto' => 'assets/tio.jpg'
    ],
    [
        'judul' => 'M. Thirza Salendra',
        'isi' => 'Setiap tantangan adalah kesempatan untuk tumbuh dan belajar. Jangan menyerah hanya karena perjalanan terasa berat.',
        'tanggal' => '22230029',
        'link' => 'https://github.com/thirza-rep/',
        'role' => 'Data Analyst',
        'foto' => 'assets/thirza.jpg'
    ],
    [
        'judul' => 'Langgeng Prayitno',
        'isi' => 'Ketika dunia jahat kepadamu, maka berusahalah untuk menghadapinya, karena tidak ada orang yang membantumu jika kau tidak berusaha.',
        'tanggal' => '22230013',
        'link' => 'https://github.com/Langgengprayitno',
        'role' => 'Full-Stack Developer',
        'foto' => 'assets/langgeng.jpg'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portofolio Kelompok 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="brand">Portofolio</div>
        <div class="nav-center">
            <form class="search-box" autocomplete="off">
                <input type="text" name="q" placeholder="Cari anggota...">
            </form>
        </div>
        <div class="nav-right">
            <div class="profile-dropdown">
                <button class="profile-btn" type="button">
                    <img src="<?php echo htmlspecialchars($user['picture']); ?>" alt="Foto Profil">
                    <span><?php echo htmlspecialchars($user['name']); ?></span>
                </button>
                <div class="dropdown-content">
                    <a href="profil.php">Profil Saya</a>
                    <a href="welcome.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <h2>Anggota Kelompok 4</h2>
        <p>Total anggota: <strong><?php echo count($berita); ?></strong></p>
        <div class="berita" id="berita-list">
            <?php foreach ($berita as $item): ?>
            <div class="berita-item">
                <img src="<?php echo htmlspecialchars($item['foto']); ?>" alt="Foto" class="berita-foto" onerror="this.src='img/default.jpg'">
                <div class="berita-judul"><?php echo htmlspecialchars($item['judul']); ?></div>
                <div class="berita-role"><?php echo htmlspecialchars($item['role']); ?></div>
                <div class="berita-tanggal">ID: <?php echo htmlspecialchars($item['tanggal']); ?></div>
                <div class="berita-isi"><?php echo htmlspecialchars($item['isi']); ?></div>
                <a class="github-link" href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank">🔗 GitHub</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Tambahkan di dalam <body> -->
    <button class="theme-toggle-btn" id="toggleThemeBtn">Light Mode</button>
    <script>
        const btn = document.getElementById('toggleThemeBtn');
        btn.addEventListener('click', function() {
            document.body.classList.toggle('light-mode');
            btn.textContent = document.body.classList.contains('light-mode') ? 'Dark Mode' : 'Light Mode';
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle dropdown profil
            const profileBtn = document.querySelector('.profile-btn');
            const dropdown = document.querySelector('.profile-dropdown');

            if (profileBtn && dropdown) {
                profileBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });

                document.addEventListener('click', function () {
                    dropdown.classList.remove('show');
                });
            }

            // Fitur pencarian real-time
            const searchInput = document.querySelector('input[name="q"]');
            const beritaItems = document.querySelectorAll('.berita-item');

            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase();
                beritaItems.forEach(function (item) {
                    const title = item.querySelector('.berita-judul').textContent.toLowerCase();
                    const id = item.querySelector('.berita-tanggal').textContent.toLowerCase();
                    if (title.includes(query) || id.includes(query)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
