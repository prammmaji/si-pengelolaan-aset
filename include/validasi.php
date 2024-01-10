<?php
// Baca ID pengguna dari session
$user_id = $_SESSION['user_id'];

// Koneksi ke database
include('../koneksi.php');

// Query untuk mengambil data email pengguna dari database
$query = "SELECT email FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);

// Ambil data email pengguna dari hasil query
if(mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $email = $row['email'];
}

?>