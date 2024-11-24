<?php
require_once "../DB/koneksi.php";

// Pengaturan limit data per halaman
$data_limit = 10;  // Setiap halaman menampilkan 10 data
$halaman_sekarang = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;  // Mengambil halaman saat ini dari parameter URL

// Hitung offset
$offset = ($halaman_sekarang - 1) * $data_limit;

// Query untuk menghitung total data transaksi
$sql_total = "SELECT COUNT(*) AS total FROM transaksi";
$result_total = $koneksi->query($sql_total);
$total_data = $result_total->fetch_assoc()['total'];  // Ambil total data transaksi
$total_halaman = ceil($total_data / $data_limit);  // Hitung jumlah total halaman

// Query untuk mengambil data transaksi dengan limit dan offset
$sql = "SELECT kode_transaksi, nama_pengiklan, total_harga, status, created_at FROM transaksi ORDER BY created_at DESC LIMIT $data_limit OFFSET $offset";
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
                <h2>Pembayaran</h2>
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
                            <th>Kode Transaksi</th>
                            <th>Nama Pengiklan</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $nomor = 1; // Nomor urut dimulai dari 1
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                    <td>{$nomor}</td>
                    <td>{$row['kode_transaksi']}</td>
                    <td>{$row['nama_pengiklan']}</td>
                    <td>Rp." . number_format($row['total_harga'], 0, ',', '.') . "</td>
                    <td>{$row['status']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                    <div class='action-btn'>
                        <span class='edit-btn' data-id='{$row['kode_transaksi']}' data-status='{$row['status']}'>
                            <i class='fas fa-check'></i>
                        </span>
                        <span class='delete-btn' data-id='{$row['kode_transaksi']}'>
                            <i class='fas fa-trash'></i>
                        </span>
                    </div>
                </td>
                 </tr>";
                                $nomor++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
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
        document.addEventListener("DOMContentLoaded", function() {
            // Logika untuk tombol centang
            document.querySelectorAll(".edit-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const status = this.getAttribute("data-status");

                    if (status === "Sukses") {
                        Swal.fire("Info", "Transaksi sudah berstatus sukses.", "info");
                        return;
                    }

                    Swal.fire({
                        title: "Apakah transaksi ini sudah dibayarkan?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Ya, ubah status",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("../DB/aksi_tombol_transaksi.php", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/x-www-form-urlencoded"
                                    },
                                    body: `id=${id}&aksi=ubah_status`
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error("Gagal memperbarui status.");
                                    }
                                    return response.text();
                                })
                                .then(data => {
                                    Swal.fire("Sukses", data, "success");
                                    setTimeout(() => location.reload(), 1500);
                                })
                                .catch(error => Swal.fire("Error", error.message, "error"));
                        }
                    });
                });
            });

            // Logika untuk tombol hapus
            document.querySelectorAll(".delete-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("../DB/aksi_tombol_transaksi.php", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/x-www-form-urlencoded"
                                    },
                                    body: `id=${id}&aksi=hapus`
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error("Gagal menghapus data.");
                                    }
                                    return response.text();
                                })
                                .then(data => {
                                    Swal.fire("Sukses", data, "success");
                                    setTimeout(() => location.reload(), 1500);
                                })
                                .catch(error => Swal.fire("Error", error.message, "error"));
                        }
                    });
                });
            });
        });
    </script>

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