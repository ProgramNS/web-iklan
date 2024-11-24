<?php
require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $aksi = $_POST['aksi'];

    if ($aksi === 'ubah_status') {
        // Mengubah status transaksi menjadi 'Sukses'
        $statusBaru = ucfirst('sukses'); // Huruf pertama kapital
        $query = "UPDATE transaksi SET status = ? WHERE kode_transaksi = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ss", $statusBaru, $id);
    
        if ($stmt->execute()) {
            echo "Status berhasil diperbarui menjadi $statusBaru.";
        } else {
            http_response_code(500);
            echo "Gagal memperbarui status.";
        }
    
        $stmt->close();
    } elseif ($aksi === 'hapus') {
        // Menghapus data transaksi berdasarkan kode_transaksi
        $query = "DELETE FROM transaksi WHERE kode_transaksi = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus.";
        } else {
            http_response_code(500);
            echo "Gagal menghapus data.";
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo "Aksi tidak valid.";
    }
} else {
    http_response_code(405);
    echo "Metode tidak diizinkan.";
}

$koneksi->close();