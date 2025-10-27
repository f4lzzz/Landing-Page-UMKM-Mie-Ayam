<?php
session_start();
include 'connection.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data dari tabel admin sesuai username
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        // Verifikasi password (pastikan di database tersimpan hasil password_hash)
        if (password_verify($password, $data['password'])) {

            // Simpan data ke session
            $_SESSION['login'] = true;
            $_SESSION['id_admin'] = $data['id_admin'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['level_akses'] = $data['level_akses'];

            // Redirect ke halaman utama
            header("Location: menu.php");
            exit;

        } else {
            $error = "❌ Password salah!";
        }
    } else {
        $error = "⚠️ Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Mie Ayam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow border-0">
        <div class="card-header bg-success text-white text-center">
          <h4 class="mb-0">Login Admin</h4>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-success w-100">Login</button>
          </form>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?= $error; ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
