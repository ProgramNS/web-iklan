<?php
// Proses Delete
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $sql_delete = "DELETE FROM pelanggan WHERE id = $delete_id";
    if ($koneksi->query($sql_delete) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        echo "<script>window.location.href='dataPelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . $koneksi->error . "');</script>";
    }
}

// Proses Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $update_id = (int)$_POST['update_id'];
    $password_baru = $koneksi->real_escape_string($_POST['password']);

    // Hash password baru sebelum menyimpannya ke database
    $password_hashed = password_hash($password_baru, PASSWORD_DEFAULT);

    // Update query dengan password yang di-hash
    $sql_update = "UPDATE pelanggan SET password = '$password_hashed' WHERE id = $update_id";
    if ($koneksi->query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!');</script>";
        echo "<script>window.location.href='dataPelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . $koneksi->error . "');</script>";
    }
}
?>
