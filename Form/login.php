<!DOCTYPE html>
<html lang="en">
<head>
    <title>MNC Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/regis.css">
    <link rel="stylesheet" href="../css/animationLoad.css">
</head>

<body>
    <!-- Overlay animasi loading -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="atom-spinner">
            <div class="spinner-inner">
                <div class="spinner-circle"></div>
                <div class="spinner-circle"></div>
                <div class="spinner-circle"></div>
            </div>
        </div>
    </div>

    <!-- Bagian Kiri -->
    <div class="left">
        <div class="logo">
            <img height="80vh" width="100%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/MNCTV_logo.png/798px-MNCTV_logo.png?20180109104219" alt="logo-mnc">
        </div>
        <h1>Hallo <span>Pengiklan</span> 👋</h1>
        <p>Pasang Iklan Lewat MNC Akan Menambah Jumlah Pengunjung Anda :)</p>
        <div class="footer">© 2024 YOGA MNC</div>
    </div>

    <!-- Bagian Kanan -->
    <div class="right">
        <div class="container">
            <h2>MNC Mania</h2>
            <p>Selamat Datang</p>
            <p>Sudah Punya Akun? <a href="" data-bs-toggle="modal" data-bs-target="#registrationModal">Silahkan Buat Akun</a></p>
            <form id="loginForm" method="POST" action="../DB/proses_login_user.php">
                <input placeholder="yoga@gmail.com" type="email" name="email" required />
                <input placeholder="Password" type="password" name="password" required />
                <button type="submit">Login Sekarang</button>
            </form>
            <div class="forgot-password">
                <a href="#">Klik Disini</a> untuk reset password
            </div>
        </div>
    </div>

    <!-- Formulir Registrasi Mengambang -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationModalLabel">Form Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="post" action="../DB/proses_pendaftaran.php">
                        <div class="form-group">
                            <label for="nama-lengkap">Nama Lengkap</label>
                            <input type="text" id="nama-lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="kode-pos">Kode Pos</label>
                            <input type="number" id="kode-pos" name="kode_pos" placeholder="Masukan Kode Pos" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukan Email" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor-telepon">Nomor Telepon</label>
                            <input type="number" id="nomor-telepon" name="no_hp" placeholder="08953332254" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Masukan password" required>
                        </div>

                        <div class="form-group">
                            <label for="ulangi-password">Ulangi Password</label>
                            <input type="password" id="ulangi-password" name="ulangi_password" placeholder="Masukan ulang password" required>
                            <small id="passwordError" style="color: red; display:none;">Password tidak sama</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="radio-group">
                                <input type="radio" id="pria" name="jenis_kelamin" value="pria" required>
                                <label for="pria">Pria</label>
                                <input type="radio" id="wanita" name="jenis_kelamin" value="wanita" required>
                                <label for="wanita">Wanita</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="submit-btn" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function cekPassword() {
            const password = document.getElementById("password");
            const ulangiPassword = document.getElementById("ulangi-password");
            const passwordError = document.getElementById("passwordError");

            if (password.value !== ulangiPassword.value) {
                passwordError.style.display = "block";
                password.style.borderColor = "red";
                ulangiPassword.style.borderColor = "red";
                return false;
            } else {
                passwordError.style.display = "none";
                password.style.borderColor = "green";
                ulangiPassword.style.borderColor = "green";
                return true;
            }
        }
        document.getElementById("ulangi-password").addEventListener("input", cekPassword);
    </script>
</body>
</html>
