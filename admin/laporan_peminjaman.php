<?php
 session_start();
 if($_SESSION['admin']== ''){
  header("location:index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Laporan Peminjaman | Pemerintahan Desa Beji</title>
</head>
<body>
<?php include('../include/headeradmin.php');?>
<?php include('../include/left.php');?>
<div class="container-data">
    <span class="span-label">Daftar Laporan Peminjaman Aset Kantor Kepala Desa Beji</span>
    <div><div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    DATA PEMINJAMAN | <a href="cetak_peminjaman.php" target="_blank" class='bx bxs-printer' text-decoration:none> CETAK</a>
                </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">KODE BOOKING</th>
                                    <th scope="col">TANGGAL BOOKING</th>
                                    <th scope="col">TANGGAL MULAI</th>
                                    <th scope="col">TANGGAL SELESAI</th>
                                    <th scope="col">BIAYA SEWA</th>
                                    <th scope="col">DENDA</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">TOTAL BAYAR</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  include('../koneksi.php');
                                  $no= 1;
                                  $query = mysqli_query($conn,"SELECT user.nama, user.email, booking.kode_booking, booking.tgl_booking, booking.tgl_mulai, booking.tgl_selesai, booking.total_bayar, denda.jumlah_denda, denda.keterangan
                                  FROM `user`
                                  JOIN booking
                                  ON user.email = booking.email
                                  LEFT JOIN denda
                                  ON booking.kode_booking = denda.kode_booking
                                  WHERE booking.`status`='Selesai'");
                                  while($row = mysqli_fetch_array($query))
                                  {
                                    $total_bayar = intval($row['total_bayar']) + intval($row['jumlah_denda']);
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['kode_booking']; ?></td>
                                    <td><?php echo $row['tgl_booking']; ?></td>
                                    <td><?php echo $row['tgl_mulai']; ?></td>
                                    <td><?php echo $row['tgl_selesai']; ?></td>
                                    <td><?php echo $row['total_bayar']; ?></td>
                                    <td><?php echo $row['jumlah_denda']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><?php echo $total_bayar; ?></td>
                                    <td class="text-center">
                                    <a href="detail_pinjam.php?kode_booking=<?php echo $row['kode_booking'] ?>" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>