<?php
session_start();
include('../koneksi.php');
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['nohp'];

    $query = "UPDATE user SET nama='$nama',email='$email',ktp='$nik', alamat='$alamat', no_telp='$no_telp' WHERE id_user='$id'";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>alert('Data Berhasil diubah!');</script>";
        echo "<script>setTimeout(\"location.href = 'user.php';\",1000);</script>";
    }else{
        echo "Data gagal diupdate";
    }
}
?>

