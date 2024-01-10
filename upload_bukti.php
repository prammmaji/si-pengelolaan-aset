<?php
    session_start();
    include('koneksi.php');

    $kode_booking = $_POST['kode_booking'];
    $tanggal_bayar = date('Y-m-d');
    $foto = $_FILES['bukti_pembayaran']['name'];
    $status = "DP";
    $total_bayar = $_POST['total_bayar'];
    //upload foto bukti pembayaran
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["bukti_pembayaran"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File yang diupload bukan gambar!');</script>";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('File yang diupload sudah ada!');</script>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["bukti_pembayaran"]["size"] > 500000) {
        echo "<script>alert('Ukuran file terlalu besar! (maksimal 500 KB)');</script>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<script>alert('Format file tidak diizinkan! (hanya JPG, JPEG, PNG, dan GIF)');</script>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>window.location.href='pembayaran.php?kode_booking=$kode_booking';</script>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO bukti_pembayaran (kode_booking, tgl_bayar, foto, status) VALUES ('$kode_booking', '$tanggal_bayar', '$foto', '$status')";
            if(mysqli_query($conn, $query)) {
                $queryup = "UPDATE booking SET total_bayar='$total_bayar' where kode_booking ='$kode_booking'";
                mysqli_query($conn, $queryup);
                $queryup2 = "UPDATE booking SET status='Menunggu Konfirmasi' where kode_booking ='$kode_booking'";
                mysqli_query($conn, $queryup2);
                echo "<script>alert('Bukti pembayaran berhasil diupload!');</script>";
                echo "<script>window.location.href='riwayat_pinjam.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload bukti pembayaran.');</script>";
                echo "<script>window.location.href='pembayaran.php?kode_booking=$kode_booking';</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengupload bukti pembayaran.');</script>";
            echo "<script>window.location.href='pembayaran.php?kode_booking=$kode_booking';</script>";
        }
    }
?>