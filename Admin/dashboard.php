<?php
include '../DB/koneksi.php';
session_start(); // Mulai sesi

// Cek apakah admin sudah login
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Jika belum login atau bukan admin, redirect ke halaman login
    header("Location: ../Form/login.php");
    exit();
}

// Query untuk menghitung total pelanggan berdasarkan jumlah id_pelanggan
$query_pelanggan = "SELECT COUNT(id) AS total_pelanggan FROM pelanggan";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
$row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$total_pelanggan = $row_pelanggan['total_pelanggan'];

// Query untuk menghitung total data iklan berdasarkan jumlah id_iklan
$query_iklan = "SELECT COUNT(id) AS total_iklan FROM data_iklan";
$result_iklan = mysqli_query($koneksi, $query_iklan);
$row_iklan = mysqli_fetch_assoc($result_iklan);
$total_iklan = $row_iklan['total_iklan'];

// Query untuk menghitung total pendapatan berdasarkan jumlah id_transaksi
$query_pendapatan = "SELECT SUM(total_harga) AS total_pendapatan FROM transaksi";
$result_pendapatan = mysqli_query($koneksi, $query_pendapatan);
$row_pendapatan = mysqli_fetch_assoc($result_pendapatan);
$total_pendapatan = $row_pendapatan['total_pendapatan'];

$nama_admin = $_SESSION['nama_lengkap'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../css/dashboard.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/MNCTV_logo.png/798px-MNCTV_logo.png?20180109104219" alt="">
            </div>

            <span class="logo_name">Vision Panel</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href="dataIklan.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Iklan</span>
                    </a></li>
                <li><a href="transaksi.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Transaksi</span>
                    </a></li>
                <li><a href="dataPelanggan.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Pengguna</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../DB/proses_logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <h2><?php echo $nama_admin; ?></h2>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user-circle"></i>
                        <span class="text">Total Pelanggan</span>
                        <span class="number"><?php echo number_format($total_pelanggan); ?></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-analysis"></i>
                        <span class="text">Total Data Iklan</span>
                        <span class="number"><?php echo number_format($total_iklan); ?></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-money-insert"></i>
                        <span class="text">Total Pendapatan</span>
                        <span class="number">Rp. <?php echo number_format($total_pendapatan); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const body = document.querySelector("body"),
            modeToggle = body.querySelector(".mode-toggle");
        sidebar = body.querySelector("nav");
        sidebarToggle = body.querySelector(".sidebar-toggle");

        let getMode = localStorage.getItem("mode");
        if (getMode && getMode === "dark") {
            body.classList.toggle("dark");
        }

        let getStatus = localStorage.getItem("status");
        if (getStatus && getStatus === "close") {
            sidebar.classList.toggle("close");
        }

        modeToggle.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                localStorage.setItem("mode", "dark");
            } else {
                localStorage.setItem("mode", "light");
            }
        });

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if (sidebar.classList.contains("close")) {
                localStorage.setItem("status", "close");
            } else {
                localStorage.setItem("status", "open");
            }
        })
    </script>
</body>

</html>