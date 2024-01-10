<?php
session_start();
if($_SESSION['admin']== ''){
  header("location:index.php");
} else{
    include('../koneksi.php'); 
    $kode_booking = $_GET['kode_booking'];
    $user = $_SESSION['admin'];
    
    // Mengambil data dari form
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $banyak_denda = $_POST['banyak_denda'];
    $keterangan = $_POST['keterangan'];
    $nama_foto = $_FILES['foto']['name'];
    $tmp_foto = $_FILES['foto']['tmp_name'];
    $ext_foto = pathinfo($nama_foto, PATHINFO_EXTENSION);
    $nama_baru = "pelunasan_".$kode_booking.".".$ext_foto;
    $folder = "../uploads/";
    move_uploaded_file($tmp_foto, $folder.$nama_baru);

    // Update status booking menjadi "Selesai"
    $query_update_booking = mysqli_query($conn, "UPDATE booking SET status='Selesai' WHERE kode_booking='$kode_booking'");

    // Insert data ke tabel denda
    $query_insert_denda = mysqli_query($conn, "INSERT INTO denda(kode_booking, tgl_pengembalian, jumlah_denda, keterangan) VALUES ('$kode_booking', '$tanggal_pengembalian', '$banyak_denda', '$keterangan')");

    // Insert data ke tabel bukti_pembayaran
    $tgl_bayar = $tanggal_pengembalian;
    $status = "Pelunasan";
    $query_insert_pembayaran = mysqli_query($conn, "INSERT INTO bukti_pembayaran(kode_booking, tgl_bayar, foto, status) VALUES ('$kode_booking', '$tgl_bayar', '$nama_baru', '$status')");

    // Redirect ke halaman daftar pinjaman
    header("location:pinjaman.php");
}
?>