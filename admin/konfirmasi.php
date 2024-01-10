<?php
session_Start();
if($_SESSION['admin']== ''){
  header("location:index.php");
} else{
    include('../koneksi.php'); 

    $kode_booking = $_GET['kode_booking'];

    //update status booking menjadi "Dikonfirmasi"
    $query_update = mysqli_query($conn, "UPDATE booking SET status='Dikonfirmasi' WHERE kode_booking='$kode_booking'");

    if ($query_update) {
        //jika berhasil, tampilkan pesan sukses dan kembali ke halaman peminjaman.php
        echo "<script>alert('Konfirmasi Pesanan Berhasil!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=pinjaman.php'>";
    } else {
        //jika gagal, tampilkan pesan error dan kembali ke halaman sebelumnya
        echo "<script>alert('Konfirmasi Pesanan Gagal!');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>