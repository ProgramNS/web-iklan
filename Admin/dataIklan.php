<?php
require_once "../DB/koneksi.php";

// Query Pengambilan Data

$data_limit = 10;
$data_diambil = "";
$halaman_sekarang = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Ambil halaman saat ini dari parameter URL

// Hitung offset
$offset = ($halaman_sekarang - 1) * $data_limit;

// Hitung total data untuk pagination
$sql_total = "SELECT COUNT(*) AS  total FROM data_iklan $data_diambil";
$result_total = $koneksi->query($sql_total);
$total_data = $result_total->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $data_limit);

$sql = "SELECT * FROM data_iklan $data_diambil LIMIT $data_limit OFFSET $offset";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/tabel.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Data Iklan</title>
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
        </div>
        <div class="table-container">
            <br>
            <br>
            <div class="table-header">
                <h2>Pengajuan Iklan</h2>
                <div class="search-box">
                    <input type="text" placeholder="Cari data...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengiklan</th>
                            <th>Judul Iklan</th>
                            <th>Lama Durasi</th>
                            <th>Tanggal Penayangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $nomor = ($halaman_sekarang - 1) * $data_limit + 1; // Mulai nomor dari 1 pada setiap halaman
                            while ($row = $result->fetch_assoc()) {
                                echo " <tr>
                    <td>{$nomor}</td>
                    <td>{$row['nama_pengiklan']}</td>
                    <td>{$row['judul_iklan']}</td>
                    <td>{$row['lama_durasi']} menit</td>
                    <td>{$row['tanggal_penayangan']}</td>
                    <td>{$row['status_iklan']}</td>
                    <td>
                    <div class='action-btn'>
                        <button class='edit-btn' style='border:none;' ><i class='fas fa-check'></i></button>
                        <button class='delete-btn'style='border:none;'><i class='fas fa-trash'></i></button>
                    </div>
                    </td>
                 </tr>";
                                $nomor++; // Increment nomor untuk baris berikutnya
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_halaman; $i++) {
                        $active = ($i === $halaman_sekarang) ? 'class="active"' : '';
                        echo "<a href='?halaman=$i' $active>$i</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        document.addEventListener("DOMContentLoaded", function () {
        // Tombol untuk mengubah status menjadi 'Diterima'
        document.querySelectorAll(".edit-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                const row = this.closest("tr"); // Baris tabel
                const id = row.querySelector("td:first-child").innerText; // ID data
                const status = row.querySelector("td:nth-child(6)").innerText; // Status kolom

                // Jika status sudah 'Diterima', tampilkan notifikasi
                if (status.trim() === "Diterima") {
                    Swal.fire({
                        title: "Info",
                        text: "Data ini sudah berstatus 'Diterima'.",
                        icon: "info",
                        confirmButtonText: "OK",
                    });
                    return;
                }

                // Jika status belum 'Diterima', tampilkan konfirmasi perubahan
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Status iklan akan diubah menjadi 'Diterima'.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Ya, ubah status",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("../DB/aksi_tombol.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: `id=${id}&aksi=ubah_status`,
                        })
                            .then(response => response.text())
                            .then(result => {
                                Swal.fire("Sukses", result, "success");
                                setTimeout(() => location.reload(), 1500);
                            })
                            .catch(error => {
                                Swal.fire("Error", "Terjadi kesalahan saat memproses permintaan.", "error");
                            });
                    }
                });
            });
        });

        // Tombol untuk menghapus data
        document.querySelectorAll(".delete-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                const id = this.closest("tr").querySelector("td:first-child").innerText;

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("../DB/aksi_tombol.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: `id=${id}&aksi=hapus`,
                        })
                            .then(response => response.text())
                            .then(result => {
                                Swal.fire("Sukses", result, "success");
                                setTimeout(() => location.reload(), 1500);
                            })
                            .catch(error => {
                                Swal.fire("Error", "Terjadi kesalahan saat memproses permintaan.", "error");
                            });
                    }
                });
            });
        });
    });
    </script>
</body>

</html>