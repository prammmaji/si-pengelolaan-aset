<?php
    require_once 'koneksi.php'; // Koneksi ke database

    /**
     * Cegah akses ke halaman login saat sedang login.
     */
    if(isset($_SESSION['is_login']) || isset($_COOKIE['_logged'])) {
      header('location: /');
    }

    if(isset($_POST['submit'])) {
      /**
       * Mendapatkan data dari formulir pendaftaran.
       * Data: Email, Kata Sandi, Nama Lengkap, dan NIM.
       */
      $email    = strip_tags($_POST['email']);
      $nama = strip_tags($_POST['nama']);
      $password     = strip_tags($_POST['password']);
      $nik      = strip_tags($_POST['nik']);
      $alamat      = strip_tags($_POST['alamat']);
      $nohp      = strip_tags($_POST['nohp']);
      if(empty($email) || empty($nama) || empty($password) || empty($nik) || empty($alamat) || empty($nohp)) {
        /**
         * Cek apakah formulir telah terisi data.
         */
        echo '<b>Warning!</b> Silahkan isi data yang diperlukan.';
      } elseif(count((array) $conn->query('SELECT email FROM user WHERE email = "'.$email.'" OR ktp = "'.$nik.'"')->fetch_array()) > 1) {
        /**
         * Cek jika email atau NIK telah terdaftar.
         */
        echo '<b>Warning!</b> Email atau NIK telah terdaftar.';
      } else {
        /**
         * Memasukkan data ke database.
         */
        $insert = $conn->query("INSERT INTO user (nama,email, password,ktp, alamat,no_telp) VALUES('$nama','$email','$password', '$nik','$alamat','$nohp')");
        if($insert) {
          echo '<script language="javascript">
              alert ("Registrasi Berhasil Di Lakukan!");
              window.location="index.php";
              </script>';
              exit();
        } else {
          echo '<script language="javascript">
              alert ("Registrasi Gagal Lakukan!");
              window.location="daftar.php";
              </script>';
              exit();
        }
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
    <title>Daftar Akun | Pemerintahan Desa Beji</title>
  </head>
  <body background="images/background.jpg">
    <header>
      <nav class="navbar">
        <a href="#" class="navbar-logo">Desa<span>BEJI</span>.</a>
        <div class="navbar-nav"></div>

        <div class="navbar-akun">
          <a href="#">Daftar Akun?</a>
          |
          <a href="index.php">Login</a>
        </div>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="top-header">
          <label class="label-daftar">DAFTAR AKUN</label>
        </div>
        <form  method="post">
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
            type="text"
            class="input"
            name="nama"
            placeholder="Masukkan Nama"
            required
          />
          <i class="bx bxs-user-detail"></i>
          </div>
          <div class="input-field">
          <input
            type="number"
            class="input"
            name="nik"
            placeholder="Masukkan NIK"
            required
          />
          <i class="bx bx-id-card"></i>
          </div>
          <div class="input-field">
          <input
            type="text"
            class="input"
            name="alamat"
            placeholder="Masukkan Alamat"
            required
          />
          <i class='bx bx-location-plus'></i>
          </div>
          <div class="input-field">
          <input
            type="number"
            class="input"
            name="nohp"
            placeholder="Masukkan No Telepon"
            required
          />
          <i class='bx bxs-phone'></i>
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
          <input type="submit" class="submit-daftar" name="submit" value="Daftar" />
          </div>
        </form>
        </div>
      </div>
    </div>
    <script>
      feather.replace();
    </script>
  </body>
</html>

<?php
    session_destroy();
    ?>