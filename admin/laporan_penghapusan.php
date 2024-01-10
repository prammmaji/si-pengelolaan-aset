<?php
 session_Start();
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
    <title>Laporan Penghapusan | Pemerintahan Desa Beji</title>
</head>
<body>
<?php include('../include/headeradmin.php');?>
<?php include('../include/left.php');?>
<div class="container-data">
    <span class="span-label">Daftar Laporan Penghapusan Aset Kantor Kepala Desa Beji</span>
    <div><div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class = "card-header">
                        DATA PENGHAPUSAN | <a href="" class='bx bxs-printer' text-decoration:none> CETAK</a>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">TANGGAL PENGHAPUSAN</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">PENANGGUNG JAWAB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  include('../koneksi.php');
                                  $no= 1;
                                  $query = mysqli_query($conn,"SELECT * FROM penghapusan");
                                  while($row = mysqli_fetch_array($query))
                                  {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_barang']; ?></td>
                                    <td><?php echo $row['jumlah']; ?></td>
                                    <td><?php echo $row['tgl_penghapusan']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
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