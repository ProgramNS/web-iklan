<?php
require_once "../DB/koneksi.php";
require_once "../DB/proses_data_pelanggan.php";


session_start(); // Mulai sesi
// Cek apakah admin sudah login
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Jika belum login atau bukan admin, redirect ke halaman login
    header("Location: ../Form/login.php");
    exit();
}




// Query untuk mengambil data
// Atur jumlah data per halaman
$data_per_halaman = 10;

// Ambil halaman saat ini dari parameter URL
$halaman_sekarang = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Hitung offset
$offset = ($halaman_sekarang - 1) * $data_per_halaman;

// Ambil kata kunci pencarian dari parameter URL
$kata_kunci = isset($_GET['search']) ? $_GET['search'] : "";

// Tambahkan kondisi pencarian jika ada kata kunci
$kondisi_pencarian = "";
if (!empty($kata_kunci)) {
    $kondisi_pencarian = "WHERE nama_lengkap LIKE '%" . $koneksi->real_escape_string($kata_kunci) . "%'";
}

// Hitung total data untuk pagination (dengan pencarian)
$sql_total = "SELECT COUNT(*) AS total FROM pelanggan $kondisi_pencarian";
$result_total = $koneksi->query($sql_total);
$total_data = $result_total->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $data_per_halaman);

// Query untuk mengambil data pelanggan dengan pagination dan pencarian
$sql = "SELECT * FROM pelanggan $kondisi_pencarian LIMIT $data_per_halaman OFFSET $offset";
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
                <h2>Data Pelanggan</h2>
                <div class="search-box">
                    <form method="get">
                        <input type="text" name="search" placeholder="Cari Pelanggan..."
                            value="<?= htmlspecialchars($kata_kunci) ?>">
                        <button type="submit" style="cursor: pointer;"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nama_lengkap"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["no_hp"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["kode_pos"] . "</td>
                <td>" . $row["jenis_kelamin"] . "</td>
                <td>
                    <div class='action-btn'>
                        <a href='#' class='edit-btn' onclick=\"openEditModal(" . $row['id'] . ", '" . $row['nama_lengkap'] . "', '" . $row['email'] . "', '" . $row['no_hp'] . "', '" . $row['alamat'] . "', '" . $row['kode_pos'] . "', '" . $row['jenis_kelamin'] . "')\">
                            <i class='fas fa-edit'></i> Edit
                        </a>
                        <a href='?delete_id=" . $row['id'] . "' class='delete-btn' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">
                            <i class='fas fa-trash'></i> Hapus
                        </a>
                    </div>
                </td>
            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div id="editModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeEditModal()">&times;</span>
                        <h2>Edit Data Pelanggan</h2>
                        <form action="" method="POST">
                            <input type="hidden" name="update_id" id="edit-id">
                            <div>
                                <label>Nama Lengkap:</label>
                                <input type="text" id="edit-nama" readonly>
                            </div>
                            <div>
                                <label>Email:</label>
                                <input type="text" id="edit-email" readonly>
                            </div>
                            <div>
                                <label>No HP:</label>
                                <input type="text" id="edit-nohp" readonly>
                            </div>
                            <div>
                                <label>Alamat:</label>
                                <input type="text" id="edit-alamat" readonly>
                            </div>
                            <div>
                                <label>Kode Pos:</label>
                                <input type="text" id="edit-kodepos" readonly>
                            </div>
                            <div>
                                <label>Jenis Kelamin:</label>
                                <input type="text" id="edit-jenis-kelamin" readonly>
                            </div>
                            <div>
                                <label>Password Baru:</label>
                                <input type="password" name="password" required>
                            </div>
                            <button type="submit">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
                <!-- Navigasi Pagination -->
                <div class="pagination">
                    <?php if ($halaman_sekarang > 1): ?>
                        <a href="?halaman=<?= $halaman_sekarang - 1 ?>&search=<?= urlencode($kata_kunci) ?>">&laquo; Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                        <a href="?halaman=<?= $i ?>&search=<?= urlencode($kata_kunci) ?>"
                            class="<?= ($i == $halaman_sekarang) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($halaman_sekarang < $total_halaman): ?>
                        <a href="?halaman=<?= $halaman_sekarang + 1 ?>&search=<?= urlencode($kata_kunci) ?>">Berikutnya &raquo;</a>
                    <?php endif; ?>
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

        function openEditModal(id, nama, email, nohp, alamat, kodepos, jenisKelamin) {
            // Set data pada elemen input
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-nohp').value = nohp;
            document.getElementById('edit-alamat').value = alamat;
            document.getElementById('edit-kodepos').value = kodepos;
            document.getElementById('edit-jenis-kelamin').value = jenisKelamin;

            // Tampilkan modal
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            // Sembunyikan modal
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>

</html>
<?php
$koneksi->close();
?>