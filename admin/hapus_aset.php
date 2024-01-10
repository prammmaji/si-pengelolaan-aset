<?php
    session_Start();
    $user = $_SESSION['admin'];
    include('../koneksi.php');
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $tgl_hapus = $_POST['tgl_penghapusan'];
    $keterangan = $_POST['keterangan'];
    $tgl_hapus = date('Y-m-d', strtotime($tgl_hapus));  
    
    $query_select = "SELECT stok from aset where nama_barang = '$nama_barang'";

    $result = mysqli_query($conn, $query_select);
    $row = mysqli_fetch_assoc($result);
    $jumlah_lama = $row['stok'];

    $jumlah_baru= $jumlah_lama-$jumlah;


    $query = "UPDATE aset SET nama_barang='$nama_barang',stok=$jumlah_baru where nama_barang='$nama_barang'";

    if($conn->query($query)){
        $query_penghapusan = "INSERT INTO penghapusan (nama_barang, jumlah,tgl_penghapusan,
        keterangan,penanggung_jawab) VALUES ('$nama_barang', $jumlah,'$tgl_hapus','$keterangan','$user')";
        mysqli_query($conn, $query_penghapusan);
      
        echo "<script>alert('Data berhasil disimpan.');</script>";

        //arahkan kembali ke halaman index setelah delay 2 detik
        echo "<script>setTimeout(\"location.href = 'aset.php';\",2000);</script>";
    } else {
        echo "<script>alert('Data Gagal disimpan.');</script>";

        //arahkan kembali ke halaman index setelah delay 2 detik
        echo "<script>setTimeout(\"location.href = 'aset.php';\",2000);</script>";
    }
?>