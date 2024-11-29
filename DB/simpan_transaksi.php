<?php
require_once "../DB/koneksi.php";

// Ambil data dari request
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $kode_transaksi = $koneksi->real_escape_string($data['kode_transaksi']);
    $jenis_iklan = $koneksi->real_escape_string($data['jenis_iklan']);
    $judul_iklan = $koneksi->real_escape_string($data['judul_iklan']);
    $lama_durasi = (int)$data['lama_durasi'];
    $nama_pengiklan = $koneksi->real_escape_string($data['nama_pengiklan']);
    $tanggal_penayangan = $koneksi->real_escape_string($data['tanggal_penayangan']);
    $metode_pembayaran = $koneksi->real_escape_string($data['metode_pembayaran']);
    $total_harga = (float)$data['total_harga'];
    $status = $koneksi->real_escape_string($data['status']);

    // Query untuk menyimpan data di tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (
        kode_transaksi, jenis_iklan, judul_iklan, lama_durasi, nama_pengiklan, tanggal_penayangan, metode_pembayaran, total_harga, status
    ) VALUES (
        '$kode_transaksi', '$jenis_iklan', '$judul_iklan', $lama_durasi, '$nama_pengiklan', '$tanggal_penayangan','$metode_pembayaran', $total_harga, '$status'
    )";

    if ($koneksi->query($query_transaksi) === TRUE) {
        // Query untuk menyimpan data di tabel data_iklan
        $query_data_iklan = "INSERT INTO data_iklan (
            nama_pengiklan, judul_iklan, jenis_iklan, lama_durasi, tanggal_penayangan, status_iklan
        ) VALUES (
            '$nama_pengiklan', '$judul_iklan','$jenis_iklan', $lama_durasi, '$tanggal_penayangan', '$status'
        )";

        if ($koneksi->query($query_data_iklan) === TRUE) {
            echo json_encode(["success" => true, "message" => "Data berhasil disimpan"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menyimpan data di tabel data_iklan: " . $koneksi->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data di tabel transaksi: " . $koneksi->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak valid"]);
}

// Tutup koneksi
$koneksi->close();
?>
