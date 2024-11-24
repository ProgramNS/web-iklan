<?php
require_once "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $aksi = $_POST['aksi'];

    if ($aksi === 'ubah_status') {
        // Mengubah status menjadi diterima
        $query = "UPDATE data_iklan SET status_iklan = 'Diterima' WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "Status berhasil diperbarui.";
        } else {
            echo "Gagal memperbarui status.";
        }
    } elseif ($aksi === 'hapus') {
        // Menghapus data iklan
        $query = "DELETE FROM data_iklan WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Gagal menghapus data.";
        }
    }
}