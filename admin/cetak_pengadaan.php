<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:index.php");
    exit();
    
}
$tgl_mulai = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Cetak Laporan Pengadaan | Pemerintahan Desa Beji</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Laporan Pengadaan Aset Kantor Kepala Desa Beji</h3>
                        <?php
                        if(isset($_SESSION['filter'])){
                            $tgl_mulai = $_SESSION['filter']['tgl_mulai'];
                            $tgl_selesai = $_SESSION['filter']['tgl_selesai'];
                            echo "<h5 class='text-center'>Periode: " . date('d-m-Y', strtotime($tgl_mulai)) . " sampai " . date('d-m-Y', strtotime($tgl_selesai)) . "</h5>";
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">SUMBER DANA</th>
                                    <th scope="col">TANGGAL PEMBELIAN</th>
                                    <th scope="col">PENANGGUNG JAWAB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../koneksi.php');
                                $no= 1;
                                $query = "SELECT * FROM pengadaan WHERE tgl_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
                              
                                $query .= " ORDER BY tgl_pembelian DESC";
                                $result = mysqli_query($conn, $query);
                                if(mysqli_num_rows($result) == 0){
                                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data yang sesuai dengan filter yang dipilih</td></tr>";
                                }
                                while($row = mysqli_fetch_array($result))
                                {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_barang']; ?></td>
                                        <td><?php echo $row['jumlah']; ?></td>
                                        <td><?php echo $row['sumber_dana']; ?></td>
                                        <td><?php echo $row['tgl_pembelian']; ?></td>
                                        <td><?php echo $row['penanggung_jawab']; ?></td>
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
    <?php

    ?>
    <script>
        window.print();
    </script>
</body>
</html>