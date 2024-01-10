<?php
 session_Start();
 if($_SESSION['admin']== ''){
  header("location:index.php");
 } else{


    include('../koneksi.php'); 
    $kode_booking = $_GET['kode_booking'];
    $user = $_SESSION['admin'];

    //query untuk mengambil data peminjaman
    $query_booking = mysqli_query($conn, "SELECT * FROM booking WHERE kode_booking='$kode_booking'");
    $data_booking = mysqli_fetch_array($query_booking);
    $tgl_mulai = $data_booking['tgl_mulai'];
    $tgl_selesai = $data_booking['tgl_selesai'];

    //query untuk mengambil data detail peminjaman
    $query_detail = mysqli_query($conn, "SELECT * FROM detail_booking WHERE kode_booking='$kode_booking'");

    //menghitung total pembayaran
    $total_pembayaran = 0;
    $tanggal_mulai = new DateTime($tgl_mulai);
    $tanggal_selesai = new DateTime($tgl_selesai);
    $selisih = $tanggal_selesai->diff($tanggal_mulai)->days + 0; //jumlah hari peminjaman
    while($row = mysqli_fetch_array($query_detail)) {
        $nama_barang = $row['nama_barang'];
        $jumlah = $row['jumlah'];
        $query_harga = mysqli_query($conn, "SELECT harga FROM aset WHERE nama_barang='$nama_barang'");
        $data_harga = mysqli_fetch_array($query_harga);
        $harga_sewa = $data_harga['harga'];
        $total_pembayaran += $harga_sewa * $jumlah * $selisih;
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
    <title>Detail Peminjaman | Pemerintahan Desa Beji</title>
  </head>
  <body>
  <?php include('../include/headeradmin.php');?>
 
  
<div class="container-data">
        <h1>Detail Pinjaman</h1>
        <table class="table table-bordered">
            <tr>
                <th>Kode Booking</th>
                <td><?php echo $data_booking['kode_booking']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Booking</th>
                <td><?php echo $data_booking['tgl_booking']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <td><?php echo $tgl_mulai; ?></td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td><?php echo $tgl_selesai; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $data_booking['status']; ?></td>
            </tr>
            <?php if ($data_booking['status'] == 'Menunggu Konfirmasi' || $data_booking['status'] == 'Dikonfirmasi') { ?>
                <tr>
                    <th>Bukti Bayar</th>
                    <td>
                        <?php
                            $query_bukti = mysqli_query($conn, "SELECT foto FROM bukti_pembayaran WHERE kode_booking='$kode_booking'");
                            $data_bukti = mysqli_fetch_array($query_bukti);
                            if ($data_bukti['foto'] != '') {
                                echo '<a href="../uploads/'.$data_bukti['foto'].'" target="_blank">Lihat Bukti</a>';
                            } else {
                                echo '-';
                            }
                        ?>
                    </td>
                </tr>
            <?php } elseif ( $data_booking['status' == 'Selesai']) { ?>
                <tr>
                    <th>Bukti Bayar</th>
                    <td>
                        <?php
                        $query_buktidp = mysqli_query($conn, "SELECT foto FROM bukti_pembayaran WHERE kode_booking='$kode_booking'");
                        $data_buktidp = mysqli_fetch_array($query_buktidp);
                            $query_bukti = mysqli_query($conn, "SELECT foto FROM bukti_pembayaran WHERE kode_booking='$kode_booking' and status='Pelunasan'");
                            $data_bukti = mysqli_fetch_array($query_bukti);
                            if ($data_bukti['foto'] != '') {
                                echo '<a href="../uploads/'.$data_buktidp['foto'].'" target="_blank">Lihat Bukti</a>';
                                echo ' / ';
                                echo '<a href="../uploads/'.$data_bukti['foto'].'" target="_blank">Lihat Bukti</a>';
                            } else {
                                echo '-';
                            }
                        ?>
                    </td>
                </tr>
            <?php }  ?>
            
        </table>
        <h2>Detail Barang</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" >No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Sewa per Hari</th>
                    <th scope="col">Total Harga Sewa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    mysqli_data_seek($query_detail, 0);
                    while($row = mysqli_fetch_array($query_detail)) {
                        $nama_barang = $row['nama_barang'];
                        $jumlah = $row['jumlah'];
                        $query_harga = mysqli_query($conn, "SELECT harga FROM aset WHERE nama_barang='$nama_barang'");
                        $data_harga = mysqli_fetch_array($query_harga);
                        $harga_sewa = $data_harga['harga'];
                        $total_harga_sewa = $harga_sewa * $jumlah * $selisih;
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $nama_barang; ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp<?php echo number_format($harga_sewa, 0, ',', '.'); ?></td>
                            <td>Rp<?php echo number_format($total_harga_sewa, 0, ',', '.'); ?></td>
                          </tr>
                <?php 
                    } 
                ?>
            </tbody>
            <tfoot>
    <tr>
        <td colspan="4">Total Pembayaran</td>
        <td>Rp<?php echo number_format($total_pembayaran, 0, ',', '.'); ?></td>
    </tr>
    <tr>
        <td colspan="5">
            <?php if ($data_booking['status'] == 'Menunggu Konfirmasi') { ?>
                <form method="post" action="pembayaran.php">
                    <div style="text-align: right; margin-top: 10px;">
                        <a href="konfirmasi.php?kode_booking=<?php echo $kode_booking; ?>" class="btn btn-success">Konfirmasi Pesanan</a>
                        <a href="hapus_booking.php?kode_booking=<?php echo $kode_booking; ?>" class="btn btn-danger">Batalkan Pesanan</a>
                        <a href="pinjaman.php" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
            <?php } elseif ($data_booking['status'] == 'Dikonfirmasi') { ?>
                <div style="text-align: right; margin-top: 10px;">
                    <a href="pelunasan.php?kode_booking=<?php echo $kode_booking; ?>" class="btn btn-success">Pelunasan</a>
                    <a href="pinjaman.php?kode_booking=<?php echo $kode_booking; ?>" class="btn btn-primary">Kembali</a>
                </div>
            <?php } else { ?>
                <div style="text-align: right; margin-top: 10px;">
                    <a href="laporan_peminjaman.php" class="btn btn-primary">Kembali</a>
                </div>
            <?php } ?>
        </td>
    </tr>
</tfoot>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
  </body>
</html>
