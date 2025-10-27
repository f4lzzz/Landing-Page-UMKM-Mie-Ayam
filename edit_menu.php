<?php
include 'connection.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu='$id'");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Menu | Mie Ayam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-dark">
      <h4 class="mb-0">Edit Menu: <?= htmlspecialchars($data['nama_menu']); ?></h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Menu</label>
          <input type="text" name="nama_menu" class="form-control" value="<?= $data['nama_menu']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga (Rp)</label>
          <input type="number" step="0.01" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <input type="text" name="kategori" class="form-control" value="<?= $data['kategori']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Stok Menu</label>
          <input type="number" name="stok_menu" class="form-control" value="<?= $data['stok_menu']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-warning w-100">Perbarui Menu</button>
      </form>

      <div class="mt-3 text-center">
        <a href="menu.php" class="btn btn-outline-secondary">Kembali ke Daftar Menu</a>
      </div>

      <?php
      if (isset($_POST['update'])) {
          $nama_menu = $_POST['nama_menu'];
          $harga = $_POST['harga'];
          $kategori = $_POST['kategori'];
          $stok_menu = $_POST['stok_menu'];

          $update = "UPDATE menu SET 
                        nama_menu='$nama_menu', 
                        harga='$harga', 
                        kategori='$kategori', 
                        stok_menu='$stok_menu'
                     WHERE id_menu='$id'";

          if (mysqli_query($conn, $update)) {
              echo "<div class='alert alert-success mt-3'>✅ Data berhasil diperbarui!</div>";
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
