<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_or_username = $_POST['email']; // Bisa berupa email pelanggan atau username admin
    $password = $_POST['password'];

    // Query gabungan untuk pelanggan dan administrator
    $sql = "SELECT *, 
                   CASE 
                       WHEN email IS NOT NULL THEN 'pelanggan' 
                       ELSE 'admin' 
                   END AS user_role 
            FROM (
                SELECT id, email, password, nama_lengkap, NULL AS username, 'pelanggan' AS role FROM pelanggan
                UNION ALL
                SELECT id, NULL AS email, password, nama_lengkap, username, 'admin' AS role FROM administrator
            ) AS users 
            WHERE email = ? OR username = ?";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Simpan data ke sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Simpan nama lengkap
            $_SESSION['is_logged_in'] = true;

            // Tentukan redirect berdasarkan peran pengguna
            if ($user['user_role'] === 'pelanggan') {
                echo "<script>
                        alert('Login berhasil sebagai pelanggan!');
                        window.location.href = '../index.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Login berhasil sebagai administrator!');
                        window.location.href = '../Admin/dashboard.php';
                      </script>";
            }
        } else {
            echo "<script>alert('Password salah!'); window.location.href = '../Form/login.php';</script>";
        }
    } else {
        echo "<script>alert('Pengguna tidak ditemukan!'); window.location.href = '../Form/login.php';</script>";
    }

    $stmt->close();
    $koneksi->close();
}
?>
