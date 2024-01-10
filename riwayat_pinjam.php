<?php
 session_Start();
 if($_SESSION['alogin']== ''){
  header("location:index.php");
 }
 $user = $_SESSION['alogin'];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Riwayat Peminjaman | Pemerintahan Desa Beji</title>
  </head>
  <body>
  <?php include('include/header.php');?> 
  <?php include('include/left_user.php');?> 
<div class="container-data">
    <span class="span-label">RIWAYAT PEMINJAMAN BARANG
</span>
<div><div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class = "card-header">
                        DATA  PEMINJAMAN
                    </div>
                    <div class="card-body">
                        <a href="pinjam_barang.php" class="btn btn-sm btn-success" style="margin-bottom: 10px;">Tambah Data</a>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">KODE BOOKING</th>
                                    <th scope="col">TANGGAL MULAI</th>
                                    <th scope="col">TANGGAL SELESAI</th>
                                    <th scope="col">TOTAL PEMBAYARAN</th>
                                    <th scope="col">STATUS </th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  include('koneksi.php');
                                  $no= 1;
                                  $query = mysqli_query($conn,"select * from booking where email = '$user'");
                                  while($row = mysqli_fetch_array($query))
                                  {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['kode_booking']; ?></td>
                                    <td><?php echo $row['tgl_mulai']; ?></td>
                                    <td><?php echo $row['tgl_selesai']; ?></td>
                                    <td>Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                                    <td><?php echo $row['status'];?></td>
                                    <td class="text-center">
                                        <a href="detail_pinjam.php?kode_booking=<?php echo $row['kode_booking'] ?>" class="btn btn-sm btn-primary"> DETAIL</a>
                                    </td>
                                </tr>
                                <?php
                                  }
                                  ?>
                            </tbody>
                        </table>
                    </div>
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
