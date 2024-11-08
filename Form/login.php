<html>

<head>
    <title>
        MNC Login
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/regis.css">

</head>

<body>
    <div class="left">
        <div class="logo">
            <img height="80vh" width="100%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/MNCTV_logo.png/798px-MNCTV_logo.png?20180109104219" alt="logo-mnc">
        </div>
        <h1>
            Hallo
            <span>
                Pengiklan
            </span>
            👋
        </h1>
        <p>
            Pasang Iklan Lewat MNC Akan Menambah Jumlah Pengunjung Anda :)
        </p>
        <div class="footer">
            © 2024 YOGA MNC
        </div>
    </div>
    <div class="right">
        <div class="container">
            <h2>
                MNC Mania
            </h2>
            <p>
                Selamat Datang
            </p>
            <p>
                Sudah Punya Akun?
                <a href="pendaftaran.php" data-bs-toggle="modal" data-bs-target="#registrationModal">
                    Silahkan Buat Akun
                </a>
            </p>
            <form method="POST">
                <input placeholder="yoga@gmail.com" type="email" name="email" />
                <input placeholder="Password" type="password" name="password" />
                <a href="#">
                    <button>
                        Login Sekarang
                    </button>
                </a>
            </form>
            <a href="#" class="google-login" style="text-decoration: none; color:black;">
                <img alt="Google logo" height="40" src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" />
                Login dengan Google
            </a>
            <div class="forgot-password">
                <a href="#">
                    Klik Disini
                </a>
                untuk reset password
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
                    <div class="form-group">
                        <label for="nama-lengkap">Nama Lengkap</label>
                        <input type="text" id="nama-lengkap" placeholder="Masukan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="username">Alamat</label>
                        <input type="text" id="alamat" placeholder="Masukan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="kode-pos">Kode Pos</label>
                        <input type="number" id="kode-pos" placeholder="Masukan Kode Pos">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                        <label for="nomor-telepon">Nomor Telepon</label>
                        <input type="number" id="nomor-telepon" placeholder="08953332254">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Masukan password">
                    </div>

                    <div class="form-group">
                        <label for="ulangi-password">Ulangi Password</label>
                        <input type="password" id="ulangi-password" placeholder="Masukan ulang password">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="radio-group">
                            <input type="radio" id="pria" name="jenis-kelamin" value="pria">
                            <label for="pria">Pria</label>
                            <input type="radio" id="wanita" name="jenis-kelamin" value="wanita">
                            <label for="wanita">Wanita</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="submit-btn">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>