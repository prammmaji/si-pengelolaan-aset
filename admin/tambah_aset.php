<?php
 session_Start();
 if($_SESSION['admin']== ''){
  header("location:index.php");
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
    <title>Tambah Aset Aset | Pemerintahan Desa Beji</title>
  </head>
  <body>
  <?php include('../include/headeradmin.php');?>
 

<div class="container-data">
    <span class="span-label">TAMBAH ASET KANTOR KEPALA DESA BEJI
</span>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    TAMBAH DATA ASET 
                </div>
                <div class="card-body">
                    <form action="simpan_aset.php" method="post">
                        <div class="form-grup">
                            <label><strong>NAMA ASET : </strong></label>
                            <input type="text" name="nama_barang" placeholder="Masukkan Nama" class="form-control required">
                        </div>
                        <div class="form-grup mt-2">
                            <label><strong>Jumlah : </strong></label>
                            <input type="number" name="jumlah" placeholder="Masukkan Harga Sewa " class="form-control required">
                        </div>
                        <div class="form-grup mt-2">
                            <label><strong>HARGA SEWA : </strong></label>
                            <input type="number" name="harga" placeholder="Masukkan Harga Sewa " class="form-control required">
                        </div>
                        <div class="form-grup mt-2">
                            <label for="sumber"><strong>Sumber Dana : </strong></label>
                            <select id="sumber" name="sumber">
                            <option value="APBDesa">APBDesa</option>
                            <option value="Hibah / Sumbangan">Hibah / Sumbangan</option>
                            <option value="Pendapatan Aslii">Pendapatan Asli Desa</option>
                            <option value="Pinjaman">Pinjaman</option>
                            </select>
                        </div>
                        <div class="form-grup mt-2">
                            <label><strong>Tanggal Pembelian</strong></label>
                            <input type="date" name="tgl_pembelian" class="form-control required">
                        </div>
                        <div class="form-grup mt-2">
                            <label for="status"><strong>Status Aset :</strong></label>
                            <select name="status" id="status">
                                <option value="Disewakan">Disewakan</option>
                                <option value="Tidak Disewakan">Tidak Disewakan</option>
                            </select>
                        </div>
                        <div class="mt-3">
                        <button class="btn btn-primary"  >SIMPAN</button>
                        <a href="aset.php" class="btn btn-danger">BATAL</a>
                        </div>
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> 
    <script>
      feather.replace();
      </script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
  </body>
</html>
