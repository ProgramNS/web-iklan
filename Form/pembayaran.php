<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pemesanan Pasang Iklan</title>
  <link rel="stylesheet" href="../css/pembayaran.css">
</head>

<body>
  <div class="form-container">
    <h1>Pemesanan Pasang Iklan</h1>
    <form id="adForm">
      <!-- Jenis Iklan -->
      <div class="form-group">
        <label for="jenisIklan">Jenis Iklan</label>
        <select id="jenisIklan" name="jenisIklan" required>
          <option value="">Pilih Jenis Iklan</option>
          <option value="digital">Iklan Digital</option>
          <option value="billboard">Iklan Billboard</option>
          <option value="televisi">Iklan Televisi</option>
        </select>
      </div>

      <!-- Judul Iklan -->
      <div class="form-group">
        <label for="judulIklan">Judul Iklan</label>
        <input type="text" id="judulIklan" name="judulIklan" placeholder="Masukkan Judul Iklan" required>
      </div>

      <!-- Lama Durasi -->
      <div class="form-group">
        <label for="lamaDurasi">Lama Durasi (Detik)</label>
        <input type="number" id="lamaDurasi" name="lamaDurasi" placeholder="Masukkan Lama Durasi (max: 180)" min="1" max="180" required>
      </div>

      <!-- Nama Pengiklan -->
      <div class="form-group">
        <label for="namaPengiklan">Nama Pengiklan</label>
        <input type="text" id="namaPengiklan" name="namaPengiklan" placeholder="Masukkan Nama Pengiklan" required>
      </div>

      <!-- Tanggal Penayangan -->
      <div class="form-group">
        <label for="tanggalPenayangan">Tanggal Penayangan</label>
        <input type="date" id="tanggalPenayangan" name="tanggalPenayangan" required>
      </div>

      <!-- Metode Pembayaran -->
      <div class="form-group">
        <label for="metodePembayaran">Metode Pembayaran</label>
        <select id="metodePembayaran" name="metodePembayaran" required>
          <option value="">Pilih Metode Pembayaran</option>
          <option value="bca">BCA (275022545)</option>
          <option value="gopay">Gopay (088216464302)</option>
          <option value="dana">Dana (088216464302)</option>
        </select>
      </div>

      <!-- Total Harga + PPN -->
      <div class="form-group">
        <label for="totalHarga">Total Harga + PPN</label>
        <input type="text" id="totalHarga" name="totalHarga" placeholder="Rp 0" disabled>
      </div>

      <!-- Button Pesan -->
      <div class="form-button">
        <button type="button" onclick="hitungHarga()">Cek Harga</button>
        <button type="button" onclick="pesanIklan()">Pesan Iklan</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    function hitungHarga() {
      const lamaDurasi = parseInt(document.getElementById('lamaDurasi').value);
      const totalHargaField = document.getElementById('totalHarga');

      if (lamaDurasi > 0 && lamaDurasi <= 180) {
        let harga;
        if (lamaDurasi < 60) {
          harga = 200000;
        } else {
          harga = 250000;
        }

        const ppn = harga * 0.11;
        const totalHarga = harga + ppn;

        totalHargaField.value = `Rp ${totalHarga}`;
      } else {
        alert("Durasi iklan harus antara 1 hingga 180 detik!");
      }
    }

    function pesanIklan() {
      Swal.fire({
        title: 'Apakah Anda yakin ingin memesan iklan dengan data yang sudah diisi?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Pesan!',
        cancelButtonText: 'Tidak, Batalkan'
      }).then((result) => {
        if (result.isConfirmed) {
          // Ambil data dari form
          const jenisIklan = document.getElementById('jenisIklan').value;
          const judulIklan = document.getElementById('judulIklan').value;
          const lamaDurasi = document.getElementById('lamaDurasi').value;
          const namaPengiklan = document.getElementById('namaPengiklan').value;
          const tanggalPenayangan = document.getElementById('tanggalPenayangan').value;
          const metodePembayaran = document.getElementById('metodePembayaran').options[document.getElementById('metodePembayaran').selectedIndex].text;
          const totalHarga = document.getElementById('totalHarga').value;
          const statusPembayaran = 'Pending';

          if (!jenisIklan || !judulIklan || !lamaDurasi || !namaPengiklan || !tanggalPenayangan || !metodePembayaran || !totalHarga) {
            Swal.fire('Error', 'Harap lengkapi semua data sebelum memesan iklan!', 'error');
            return;
          }

          // Mengambil nilai totalHarga tanpa simbol Rp dan format mata uang lainnya
          const totalHargaNumeric = parseFloat(totalHarga.replace(/[^\d.-]/g, ''));

          // Format untuk memastikan dua angka desimal
          const formattedTotalHarga = totalHargaNumeric.toFixed(2); // Format angka ke dua desimal

          const kodeTransaksi = generateRandomCode(10);

          // Kirim data ke backend
          const dataTransaksi = {
            kode_transaksi: kodeTransaksi,
            jenis_iklan: jenisIklan,
            judul_iklan: judulIklan,
            lama_durasi: parseInt(lamaDurasi),
            nama_pengiklan: namaPengiklan,
            tanggal_penayangan: tanggalPenayangan,
            metode_pembayaran: metodePembayaran,
            total_harga: formattedTotalHarga, // Kirimkan nilai totalHarga dengan dua desimal
            status: statusPembayaran
          };

          fetch('../DB/simpan_transaksi.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dataTransaksi)
            })
            .then(response => response.json())
            .then(result => {
              if (result.success) {
                Swal.fire('Berhasil', 'Transaksi berhasil disimpan!', 'success').then(() => {
                  localStorage.setItem('kodeTransaksi', kodeTransaksi);
                  window.location.href = '../Form/konfirmasi.php';
                });
              } else {
                Swal.fire('Gagal', 'Gagal menyimpan transaksi: ' + result.message, 'error');
              }
            })
            .catch(error => console.error('Error:', error));
        }
      });
    }

    function generateRandomCode(length) {
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let result = '';
      for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      return result;
    }
  </script>
</body>

</html>
