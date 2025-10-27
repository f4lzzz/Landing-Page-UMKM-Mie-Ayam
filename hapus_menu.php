<?php
include 'connection.php';

$id = $_GET['id'];
$query = "DELETE FROM menu WHERE id_menu='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Menu berhasil dihapus!');
            window.location='menu.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus menu: " . mysqli_error($conn) . "');
            window.location='menu.php';
          </script>";
}
?>
