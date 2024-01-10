<?php
session_start();
include('../koneksi.php');
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$query = mysqli_query($conn,$sql);
$results = mysqli_fetch_array($query);
if(mysqli_num_rows($query)>0){
	$_SESSION['admin']=$_POST['username'];
	echo "<script type='text/javascript'> document.location = 'aset.php'; </script>";
} else{
	echo "<script>alert('Password anda salah!');</script>";
}
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="../boxicons/css/boxicons.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <title>Login Admin | Pemerintahan Desa Beji</title>
  </head>
  <body background="../images/background.jpg">
    <header>
      <nav class="navbar">
        <a href="#" class="navbar-logo">Desa<span>BEJI</span>.</a>
        <div class="navbar-nav"></div>

        <div class="navbar-akun">
          <a href="index.html">Login User</a>
        </div>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="top-header">
          <label class="label-login-admin">LOGIN ADMIN</label>
        </div>
      <form method="post">
        <div class="input-field">
          <input
            type="text"
            class="input"
            name="username"
            placeholder="Masukkan Username"
            required
          />
          <i class="bx bx-user"></i>
        </div>
        <div class="input-field">
          <input
            type="password"
            class="input"
            name="password"
            placeholder="Masukkan Password"
            required
          />
          <i class="bx bx-lock"></i>
        </div>
        <div class="input-field">
          <input type="submit" class="submit" name="submit" value="Login" />
          </div>
        </div>

      </form>
    </div>
    <script>
      feather.replace();
    </script>
  </body>
</html>
