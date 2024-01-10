<?php 
    session_start(); 
    include('koneksi.php'); 
    $kode_booking = $_GET['kode_booking'];
    $user = $_SESSION['alogin'];

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
    $update_booking = mysqli_query($conn, "UPDATE booking SET total_bayar='$total_pembayaran' WHERE kode_booking='$kode_booking'");

    if (!$update_booking) {
    echo "Gagal mengupdate total pembayaran di tabel booking: " . mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/feather-icons"></script> 
    <link rel="stylesheet" href="boxicons/css/boxicons.css" /> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com" /> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" /> 
    <link rel="stylesheet" href="style.css" /> 
    <title>Upload Bukti Pembayaran | Pemerintahan Desa Beji</title>
    
</head>
<body>
    <?php include('include/header.php'); ?>
    <div class="left">
        <ul>
            <li><a href="#">Pinjam Barang</a></li>
            <li><a href="#">Riwayat Pinjaman</a></li>
        </ul>
    </div>
    <div class="container-data">
        <h1>Upload Bukti Pembayaran</h1>
        <p>Silakan bayar 25% dari total pembayaran yaitu sebesar Rp<?php echo number_format($total_pembayaran * 0.25, 0, ".", "."); ?> ke nomor rekening 101111011 atas nama Pramudya.</p>
        <form action="upload_bukti.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_pembayaran">
            </div>
            <input type="hidden" name="kode_booking" value="<?php echo $kode_booking; ?>">
            <input type="hidden" name="total_bayar" value="<?php echo $total_pembayaran; ?>">
            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
        <div style="margin-top: 10px;">
        <a href="riwayat_pinjam.php" class="btn btn-secondary">Upload Pembayaran Nanti</a>
        <a href="detail_pinjam.php?kode_booking=<?php echo $kode_booking; ?>" class="btn btn-secondary">Kembali ke halaman sebelumnya</a>             
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
    <script>
        feather.replace();
        $(document).ready(function() {
            $('#table_id').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<i class='bx bx-chevron-left'></i>",
                        "next": "<i class='bx bx-chevron-right'></i>"
                    }
                }
            });
        });
    </script> 
    <script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            var file = $('#bukti_pembayaran').val();
            if (file == "") {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda belum memilih file!'
                });
            }
        });
    });
</script>
</body>
</html>