<?php
session_start();
if($_SESSION['admin']== ''){
    header("location:index.php");
} else{
    include('../koneksi.php');
    $kode_booking = $_GET['kode_booking'];
        //delete data dari tabel bukti_pembayaran
        $query_delete_bukti = mysqli_query($conn, "DELETE FROM bukti_pembayaran WHERE kode_booking='$kode_booking'");

    //delete data dari tabel booking
    $query_delete_booking = mysqli_query($conn, "DELETE FROM booking WHERE kode_booking='$kode_booking'");

    //hapus file dari folder uploads
    $query_file = mysqli_query($conn, "SELECT foto FROM bukti_pembayaran WHERE kode_booking='$kode_booking'");
    $data_file = mysqli_fetch_array($query_file);
    $file_name = $data_file['foto'];
    $file_path = "../uploads/".$file_name;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    if ($query_delete_booking && $query_delete_bukti) {
        //jika berhasil, tampilkan pesan sukses dan kirim email notifikasi ke pengguna
        $query_user = mysqli_query($conn, "SELECT id_user, email FROM user WHERE email=(SELECT email FROM booking WHERE kode_booking='$kode_booking')");
        $data_user = mysqli_fetch_array($query_user);
        $user_id = $data_user['id_user'];
        $email = $data_user['email'];

        $to = $email;
        $subject = "Pemesanan Peminjaman Aset Desa Beji Dibatalkan";
        $message = "Halo, pemesanan aset desa dengan kode booking $kode_booking telah dibatalkan. Mohon maaf atas ketidaknyamanannya. Silahkan hubungi admin untuk informasi lebih lanjut.";
        $headers = "From: admin@desabeji.com";

        mail($to, $subject, $message, $headers); //kirim email notifikasi

        echo "<script>alert('Pesanan berhasil dibatalkan!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=pinjaman.php'>";
    } else {
        //jika gagal, tampilkan pesan error dan kembali ke halaman sebelumnya
        echo "<script>alert('Gagal membatalkan pesanan!');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>