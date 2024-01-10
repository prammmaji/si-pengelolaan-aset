<?php 
    session_start(); 
    include('koneksi.php'); 
    $kode_booking = $_GET['kode_booking'];

    //query untuk menghapus data di tabel detail_booking
    mysqli_query($conn, "DELETE FROM detail_booking WHERE kode_booking='$kode_booking'");

    //query untuk menghapus data di tabel booking
    mysqli_query($conn, "DELETE FROM booking WHERE kode_booking='$kode_booking'");

    header('location: pinjam_barang.php');
?>