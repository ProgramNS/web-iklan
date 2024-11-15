<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $kode_pos = $_POST['kode_pos'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Buat query untuk memasukkan data ke dalam tabel
    $sql = "INSERT INTO pelanggan (nama_lengkap, alamat, kode_pos, email, no_hp, password, jenis_kelamin) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Siapkan pernyataan (statement)
    $stmt = $koneksi->prepare($sql);

    // Bind parameter
    $stmt->bind_param("ssissss", $nama_lengkap, $alamat, $kode_pos, $email, $no_hp, $hashed_password, $jenis_kelamin);

    // Eksekusi query dan cek apakah berhasil
    if ($stmt->execute()) {
        echo "<html>
                <head>
                    <style>
                        .splash-screen {
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(0, 0, 0, 0.7);
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            color: white;
                            text-align: center;
                            z-index: 1000;
                        }
                        .splash-screen-content {
                            background-color: white;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                            color: black;
                        }
                        .splash-screen-content img {
                            width: 50px;
                            height: 50px;
                        }
                        .splash-screen-content h2 {
                            margin: 10px 0;
                        }
                    </style>
                </head>
                <body>
                    <div class='splash-screen'>
                        <div class='splash-screen-content'>
                            <h2>Registrasi Berhasil!</h2>
                            <p>Selamat, akun Anda berhasil dibuat.</p>
                            <img src='https://cdn-icons-png.flaticon.com/512/190/190411.png' alt='Checkmark'>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = '../Form/login.php';
                        }, 2000);
                    </script>
                </body>
              </html>";
        // Tutup statement dan koneksi
        $stmt->close();
        $koneksi->close();
        exit();
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $koneksi->close();
}
