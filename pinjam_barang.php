<?php session_start(); 
include('koneksi.php'); 
$tgl_mulai = date('Y-m-d');
$tgl_selesai = date('Y-m-d', strtotime('+1 day'));

// Jika tanggal mulai dan tanggal selesai dipilih dari form, gunakan nilai baru
if (isset($_POST['tgl_mulai']) && isset($_POST['tgl_selesai'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
}

// Query untuk mendapatkan data stok dari tabel aset
$sql = "SELECT * FROM aset";
$result = mysqli_query($conn, $sql);

// Buat array untuk menyimpan stok terbaru dari tiap barang
$stok_terbaru = array();

// Looping untuk tiap barang pada tabel aset
while ($row = mysqli_fetch_assoc($result)) {
    $nama_barang = $row['nama_barang'];
    $stok = $row['stok'];

    // Query untuk mendapatkan jumlah barang yang telah dipesan pada rentang tanggal yang dipilih
    $sql = "SELECT SUM(jumlah) AS jumlah_dipesan FROM detail_booking 
            INNER JOIN booking ON detail_booking.kode_booking=booking.kode_booking 
            WHERE nama_barang='$nama_barang' AND booking.tgl_mulai <= '$tgl_selesai' AND booking.tgl_selesai >= '$tgl_mulai' AND booking.status='Dikonfirmasi'";

    $result2 = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_assoc($result2);
    $jumlah_dipesan = $row2['jumlah_dipesan'];

    // Jika tidak ada pesanan pada tanggal tersebut, stok terbaru sama dengan stok awal
    if ($jumlah_dipesan == null) {
        $stok_terbaru[$nama_barang] = $stok;
    } else {
        // Jika ada pesanan pada tanggal tersebut, stok terbaru dikurangi dengan jumlah barang yang telah dipesan
        $stok_terbaru[$nama_barang] = $stok - $jumlah_dipesan;
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
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com" /> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" /> 
<link rel="stylesheet" href="style.css" /> 
<title>Pinjam Barang | Pemerintahan Desa Beji</title> 
</head> 
<body> 
<?php include('include/header.php');?> 
<?php include('include/left_user.php');?> 
<div class="container-data"> 
<h1>Form Peminjaman Barang</h1> 
<p>Harap Masukkan Tanggal Peminjaman Terlebih Dahulu Untuk Mengetahui Ketersediaan Barang!</p>
<form action="" method="post">
<div class="form-group">
            <label for="tgl_mulai"><b>Tanggal Mulai Peminjaman:</b></label>
            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
        </div>
        <div class="form-group">
            <label for="tgl_selesai"><b>Tanggal Selesai Peminjaman:</b></label>
            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
        </div>
        <button type="submit" class="btn btn-primary" >Tampilkan Stok Tersedia</button>
</form>
    <form method="post" action="simpan_pinjaman.php"> 
    <input type="hidden" name="tgl_mulai" value="<?php echo $tgl_mulai ?>">
    <input type="hidden" name="tgl_selesai" value="<?php echo $tgl_selesai ?>">
        <table class="table table-bordered" id="myTable"> 
            <thead> 
                <tr> 
                    <th scope="col">NO</th> 
                    <th scope="col">NAMA ASET</th> 
                    <th scope="col">STOK</th> 
                    <th scope="col">JUMLAH PINJAM</th> 
                </tr> 
            </thead> 
            <tbody> 
                <?php 
                $no=0; 
                $noq=0;
                 foreach ($stok_terbaru as $nama_barang => $stok) { ?>
                    <tr>
                        <td><?php echo $no+1; ?></td> 
                        <td><?php echo $nama_barang; ?></td>
                        <td><?php echo $stok; ?></td>
                    <td><input type="number" placeholder= "0" name="jumlahbarang<?php echo $no+1; ?>" class="form-control" min="0" max="<?php echo $stok; ?>" required></td> 
                </tr> 
                <?php 
                    $no++; 
                } 
                ?> 
            </tbody> 
        </table>
        <p><strong>Tanggal yang dipilih: <?php echo $tgl_mulai; ?> sampai <?php echo $tgl_selesai; ?></strong></p>
        <button type="submit" class="btn btn-primary">Simpan</button> 
    </form> 
</div>
</div>

<script> feather.replace(); </script> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
</body> 
</html>