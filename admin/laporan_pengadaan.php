<?php
    session_start();
    if($_SESSION['admin']== ''){
        header("location:index.php");
    }

    if(isset($_POST['filter'])){
        $_SESSION['tgl_mulai'] = $_POST['tgl_mulai'];
        $_SESSION['tgl_selesai'] = $_POST['tgl_selesai'];
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
    <title>Laporan Pengadaan | Pemerintahan Desa Beji</title>
</head>
<body>
    <?php include('../include/headeradmin.php');?>
    <?php include('../include/left.php');?>
    <div class="container-data">
        <span class="span-label">Daftar Laporan Pengadaan Aset Kantor Kepala Desa Beji</span>
        <div>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="tgl_mulai">Mulai Tanggal</label>
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?php echo isset($_SESSION['tgl_mulai']) ? $_SESSION['tgl_mulai'] : ''; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tgl_selesai">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?php echo isset($_SESSION['tgl_selesai']) ? $_SESSION['tgl_selesai'] : ''; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="filter">&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control" name="filter"><i class="ri-filter-3-line"></i> Filter</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            DATA PENGADAAN | <a href="cetak_pengadaan.php?tgl_mulai=<?php echo isset($_SESSION['tgl_mulai']) ? $_SESSION['tgl_mulai'] : ''; ?>&tgl_selesai=<?php echo isset($_SESSION['tgl_selesai']) ? $_SESSION['tgl_selesai'] : ''; ?>" target="_blank" class='bx bxs-printer' text-decoration:none> CETAK</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
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
                                    $query = "SELECT * FROM pengadaan";
                                    if(isset($_SESSION['tgl_mulai']) && isset($_SESSION['tgl_selesai'])){
                                        $tgl_mulai = $_SESSION['tgl_mulai'];
                                        $tgl_selesai = $_SESSION['tgl_selesai'];
                                        if(!empty($tgl_mulai) && !empty($tgl_selesai)){
                                            $query .= " WHERE tgl_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
                                        }
                                    }
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
    </div> 
    <script>
        const navLinks = document.querySelectorAll('left ul li');
        navLinks.forEach(link => {
            const subMenu = link.querySelector('ul');
            if (subMenu) {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    subMenu.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>