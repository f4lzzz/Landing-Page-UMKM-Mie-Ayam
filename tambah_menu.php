<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Menu | Mie Ayam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Tambah Menu Baru</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Menu</label>
          <input type="text" name="nama_menu" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga (Rp)</label>
          <input type="number" step="0.01" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori" class="form-control" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Makanan">Makanan</option>
          <option value="Minuman">Minuman</option>
        </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Stok Menu</label>
          <input type="number" name="stok_menu" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-success w-100">Simpan Menu</button>
      </form>

      <div class="mt-3 text-center">
        <a href="menu.php" class="btn btn-outline-secondary">Kembali ke Daftar Menu</a>
      </div>

      <?php
      if (isset($_POST['submit'])) {
          $nama_menu = $_POST['nama_menu'];
          $harga = $_POST['harga'];
          $kategori = $_POST['kategori'];
          $stok_menu = $_POST['stok_menu'];

          $query = "INSERT INTO menu (nama_menu, harga, kategori, stok_menu)
                    VALUES ('$nama_menu', '$harga', '$kategori', '$stok_menu')";

          if (mysqli_query($conn, $query)) {
              echo "<div class='alert alert-success mt-3'>✅ Menu berhasil ditambahkan!</div>";
          } else {
              echo "<div class='alert alert-danger mt-3'>❌ Gagal: " . mysqli_error($conn) . "</div>";
          }
      }
      ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
