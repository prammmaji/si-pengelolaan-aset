<?php
 session_Start();
 if($_SESSION['admin']== ''){
  header("location:index.php");
 }
    include('../koneksi.php');
    //get data dari from
    $id= $_GET['id'];
    //query insert to db
    $query = "SELECT * FROM user WHERE id_user = '$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <title>Edit USER | Pemerintahan Desa Beji</title>
  </head>
  <body style="background-color: #87CEFA";>
  <?php include('../include/headeradmin.php');?>
<?php include('../include/left.php');?>
 

<div class="container-data">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card" style="background-color: #87CEFA";>
            <div class="container">
            <div class="top-header">
                <label class="label-daftar">EDIT PROFIL </label>
            </div>
            <form  action="update.php" method="post">
                <div>
                <input type="hidden" name="id" value="<?php echo $row['id_user'] ?>">
                </div>
                <div class="input-field">
                    <input type="text"class="input" name="email" 
                    value="<?php echo $row['email'] ?>"  required />
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" class="input" name="nama"
                    value="<?php echo $row['nama'] ?>"
                    placeholder="Masukkan Nama" required />
                    <i class="bx bxs-user-detail"></i>
                </div>
                <div class="input-field">
                    <input type="number" class="input" name="nik" value="<?php echo $row['ktp'] ?>"
                    placeholder="Masukkan NIK"  required />
                    <i class="bx bx-id-card"></i>
                </div>
                <div class="input-field">
                    <input type="text" class="input" name="alamat" placeholder="Masukkan Alamat"
                    value="<?php echo $row['alamat'] ?>" required />
                    <i class='bx bx-location-plus'></i>
                </div>
                <div class="input-field">
                    <input type="number" class="input" name="nohp"
                    value="<?php echo $row['no_telp'] ?>"
                    placeholder="Masukkan No Telepon" required  />
                    <i class='bx bxs-phone'></i>
                </div>
                
                <div class="input-field">
                    <input type="submit" class="submit-daftar" name="submit" value="SIMPAN" />
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>

</div> 
<script>
      feather.replace();

      function validateForm() {
        var requiredFields = document.querySelectorAll('.required');
        for (var i = 0; i < requiredFields.length; i++) {
          if (requiredFields[i].value === '') {
            alert('Harap isi semua inputan yang tersedia!');
            return false;
          }
        }
        return true;
      }
    </script>
    <script>
      feather.replace();
      </script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
  </body>
</html>
