
<?php

include('koneksi.php');
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
$query = mysqli_query($conn,$sql);
$results = mysqli_fetch_array($query);
if(mysqli_num_rows($query)>0){
  session_start();
	$_SESSION['alogin']=$_POST['email'];

	echo "<script type='text/javascript'> document.location = 'pinjam_barang.php'; </script>";
} 
else{
	echo "<script>alert('Password anda salah!');</script>";
}
 }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="boxicons/css/boxicons.css" />
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
    <link rel="stylesheet" href="style.css" />
    <title>Login | Pemerintahan Desa Beji</title>
  </head>
  <body background="images/background.jpg">
    <header>
      <nav class="navbar">
        <a href="#" class="navbar-logo">Desa<span>BEJI</span>.</a>
        <div class="navbar-nav"></div>

        <div class="navbar-akun">
          <a href="daftar.php">Dafar Akun?</a>
          |
          <a href="#">Login</a>
        </div>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="top-header">
          <span class="span1">Punya akun ? </span>
          <label class="label-login">LOGIN</label>
        </div>
        <form method="post">
            <div class="input-field">
                <input
                  type="text"
                  class="input"
                  name="email"
                  placeholder="Masukkan Email"
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
                <input type="submit" class="submit" name="login" value="Login" />
              </div>
              <div class="bottom">
        </form>
       
        </div>
      </div>
    </div>
    <script>
      feather.replace();
    </script>
  </body>
</html>
