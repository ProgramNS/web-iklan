<?php
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $isLoggedIn = true;
    $userId = $_SESSION['user_id']; // Ambil ID user jika diperlukan
} else {
    $isLoggedIn = false;
}

// Debugging: Kirim informasi ke konsol browser
echo "<script>console.log('Login Status: " . ($isLoggedIn ? 'Logged In' : 'Not Logged In') . "');</script>";
if ($isLoggedIn) {
    echo "<script>console.log('User ID: $userId');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perusahaan Iklan</title>
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/MNCTV_logo.png/798px-MNCTV_logo.png?20180109104219" alt="MNCTV Logo">
                </div>
                <ul class="nav-links">
                    <li><a href="#home" class="active">Beranda</a></li>
                    <li><a href="#ads">Jenis Iklan</a></li>
                    <li><a href="Form/pembayaran.php" id="order-link">Pemesanan Iklan</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <a href="Form/pembayaran.php" id="order-link" class="btn-primary">Pesan Sekarang</a>
                <?php if ($isLoggedIn): ?>
                    <a href="DB/proses_logout.php" class="btn-secondary logout-btn">Logout</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Solusi Iklan Terbaik untuk Bisnis Anda</h1>
                <p>
                    Tingkatkan eksposur dan jangkauan bisnis Anda bersama MNC! Kami menawarkan layanan iklan inovatif yang dirancang untuk menarik perhatian, membangun merek, dan mendorong hasil yang nyata. Jadikan iklan Anda berbicara lebih keras di platform digital, televisi, dan media luar ruang.
                </p>
                <div class="hero-image">
                    <img src="src/mnc.jpg" alt="Periklanan Modern" />
                </div>
                <br>
                <a href="#ads" class="btn-secondary">Lihat Jenis Iklan</a>
            </div>
        </div>
    </section>
    <section id="company-profile" class="company-profile">
        <div class="container">
            <h2>Tentang MNC</h2>
            <p>
                MNC adalah perusahaan terkemuka di bidang periklanan yang telah dipercaya oleh ribuan bisnis di Indonesia. Dengan pengalaman lebih dari dua dekade, kami telah membantu berbagai perusahaan mencapai tujuan pemasaran mereka melalui strategi yang kreatif dan terukur.
            </p>
            <p>
                Sebagai bagian dari salah satu grup media terbesar, MNC memanfaatkan jangkauan luas dan teknologi canggih untuk menawarkan berbagai solusi periklanan, termasuk:
            </p>
            <ul>
                <li><strong>Iklan Televisi:</strong> Menjangkau jutaan penonton dengan tayangan berkualitas tinggi.</li>
                <li><strong>Iklan Digital:</strong> Kampanye online yang strategis untuk meningkatkan kehadiran digital Anda.</li>
                <li><strong>Billboard dan Media Luar Ruang:</strong> Lokasi premium untuk memastikan merek Anda terlihat.</li>
            </ul>
            <p>
                MNC selalu mengutamakan kepuasan klien dengan memberikan hasil yang nyata. Visi kami adalah menjadi mitra terbaik untuk semua kebutuhan periklanan Anda, dari tahap perencanaan hingga pelaksanaan.
            </p>
        </div>
    </section>
    <!-- Jenis Iklan Section -->
    <section id="ads" class="ads">
        <div class="container">
            <h2>Jenis Iklan</h2>
            <div class="ads-grid">
                <div class="ads-item">
                    <i class="uil uil-monitor"></i>
                    <h3>Iklan Digital</h3>
                    <p>Mencakup media sosial, Google Ads, dan promosi digital lainnya.</p>
                </div>
                <div class="ads-item">
                    <i class="uil uil-bill"></i>
                    <h3>Iklan Billboard</h3>
                    <p>Papan reklame di lokasi strategis untuk menarik perhatian.</p>
                </div>
                <div class="ads-item">
                    <i class="uil uil-tv-retro"></i>
                    <h3>Iklan Televisi</h3>
                    <p>Produksi video berkualitas tinggi untuk menjangkau audiens luas.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal" id="login-modal">
        <div class="modal-content">
            <h2>Login Diperlukan</h2>
            <p>Anda harus login terlebih dahulu untuk melakukan pemesanan.</p>
            <a href="Form/login.php" class="btn">Login Sekarang</a>
        </div>
    </div>
    <!-- Kontak Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Kontak Kami</h2>
            <p>Hubungi kami untuk informasi lebih lanjut atau konsultasi langsung.</p>
            <div class="contact-info">
                <div>
                    <i class="uil uil-phone"></i>
                    <p>+62 882-1646-4302</p>
                </div>
                <div>
                    <i class="uil uil-envelope"></i>
                    <p>permatayoga1@gmail.com</p>
                </div>
                <div>
                    <i class="uil uil-map-marker"></i>
                    <p>Gedung MNC Tower Lantai 27, Jalan Kebon Sirih Raya No. 17-19, Kebon Sirih, Menteng, Jakarta Pusat 10340</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Yoga MNC. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // Simulasi status login
        const isLoggedIn = <?= json_encode($isLoggedIn); ?>;

        // Elemen modal
        const loginModal = document.getElementById('login-modal');

        // Event handler untuk klik tombol pemesanan
        document.querySelectorAll('#order-link, .btn-primary').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah navigasi default
                if (!isLoggedIn) {
                    // Tampilkan modal jika belum login
                    loginModal.style.display = 'flex';
                } else {
                    // Redirect ke halaman pemesanan jika sudah login
                    window.location.href = 'Form/pembayaran.php';
                }
            });
        });

        // Menutup modal ketika klik di luar kontennya
        window.addEventListener('click', function(e) {
            if (e.target === loginModal) {
                loginModal.style.display = 'none';
            }
        });
    </script>

</body>

</html>