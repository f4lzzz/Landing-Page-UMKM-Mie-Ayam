<?php
include 'connection.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Cek apakah username sudah digunakan
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "❌ Username sudah digunakan!";
    } elseif ($password !== $confirm) {
        $error = "⚠️ Password dan konfirmasi tidak cocok!";
    } else {
        // Enkripsi password
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashed')");
        if ($query) {
            $success = "✅ Akun berhasil dibuat! Silakan login.";
        } else {
            $error = "❌ Gagal membuat akun.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Akun Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">Daftar Akun Admin</h4>
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
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="confirm" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
          </form>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?= $error; ?></div>
          <?php elseif (isset($success)): ?>
            <div class="alert alert-success mt-3"><?= $success; ?></div>
          <?php endif; ?>

          <div class="text-center mt-3">
            <a href="login.php">Sudah punya akun? Login di sini</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
