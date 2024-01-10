<?php
session_start();
if($_SESSION['admin']== ''){
  header("location:index.php");
} else{
    include('../koneksi.php'); 
    $kode_booking = $_GET['kode_booking'];
    $user = $_SESSION['admin'];
}
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
    <title>Pelunasan Pinjaman | Pemerintahan Desa Beji</title>
  </head>
  <body>
  <?php include('../include/headeradmin.php');?>
 

<div class="container-data">
        <h1>Pelunasan Pinjaman</h1>
        <form action="proses_pelunasan.php?kode_booking=<?php echo $kode_booking; ?>" method="post"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
            </div>
            <div class="form-group">
                <label for="banyak_denda">Banyak Denda</label>
                <input type="number" class="form-control" id="banyak_denda" name="banyak_denda" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto Pelunasan</label>
                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="../script.js"></script>

</body>
</html>