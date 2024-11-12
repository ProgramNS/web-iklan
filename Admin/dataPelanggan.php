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
                <li><a href="#">
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
                    <input type="text" placeholder="Cari pelanggan...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Yoga Pratama</td>
                            <td>yoga@gmail.com</td>
                            <td>08951234567</td>
                            <td>Bekasi</td>
                            <td>12345</td>
                            <td>
                                <div class="action-btn">
                                    <span class="edit-btn"><i class="fas fa-edit"></i> Edit</span>
                                    <span class="delete-btn"><i class="fas fa-trash"></i> Hapus</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Andi Putra</td>
                            <td>andi@gmail.com</td>
                            <td>08959876543</td>
                            <td>Cirebon</td>
                            <td>67890</td>
                            <td>
                                <div class="action-btn">
                                    <span class="edit-btn"><i class="fas fa-edit"></i> Edit</span>
                                    <span class="delete-btn"><i class="fas fa-trash"></i> Hapus</span>
                                </div>
                            </td>
                        </tr>
                        <!-- Tambahkan baris data pelanggan lainnya di sini -->
                    </tbody>
                </table>
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