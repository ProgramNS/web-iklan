<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Pemesanan</title>
  <link rel="stylesheet" href="../css/konfirmasi.css">
</head>
<body>
  <div class="confirmation-container">
    <div class="confirmation-card">
      <h1>Pesanan Berhasil</h1>
      <div class="code-box">
        <label>Kode Pemesanan Anda:</label>
        <input type="text" id="kodeTransaksi" readonly>
      </div>
      <div class="note">
        <p>Harap simpan kode diatas untuk diberikan ke admin setelah melakukan pembayaran.</p>
        <a href="https://wa.me/6288216464302">Nomor admin: <b>+62 882-1646-4302</b></a>
      </div>
      <div class="home-link">
        <a href="../index.php">Kembali ke Beranda</a>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Ambil kode transaksi dari URL atau local storage (sesuai implementasi Anda)
      const kodeTransaksi = new URLSearchParams(window.location.search).get('kode') || localStorage.getItem('kodeTransaksi');
      if (kodeTransaksi) {
        document.getElementById('kodeTransaksi').value = kodeTransaksi;
      }
    });
  </script>
</body>
</html>
