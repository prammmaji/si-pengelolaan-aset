<?php
    session_Start();
    $user = $_SESSION['admin'];
    include('../koneksi.php');
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $sumber = $_POST['sumber'];
    $tgl_beli = $_POST['tgl_pembelian'];

    $tgl_beli = date('Y-m-d', strtotime($tgl_beli));  
    
    $query_select = "SELECT stok from aset where nama_barang = '$nama_barang'";

    $result = mysqli_query($conn, $query_select);
    $row = mysqli_fetch_assoc($result);
    $jumlah_lama = $row['stok'];

    $jumlah_baru= $jumlah_lama+$jumlah;


    $query = "UPDATE aset SET nama_barang='$nama_barang',stok=$jumlah_baru,harga=$harga where nama_barang='$nama_barang'";

    if($conn->query($query)){
        $query_pengadaan = "INSERT INTO pengadaan (nama_barang, jumlah,sumber_dana,tgl_pembelian,
        penanggung_jawab) VALUES ('$nama_barang', $jumlah,'$sumber','$tgl_beli','$user')";
        mysqli_query($conn, $query_pengadaan);
      
        echo "<script>alert('Data berhasil disimpan.');</script>";

        //arahkan kembali ke halaman index setelah delay 2 detik
        echo "<script>setTimeout(\"location.href = 'aset.php';\",2000);</script>";
    } else {
        echo "<script>alert('Data Gagal disimpan.');</script>";

        //arahkan kembali ke halaman index setelah delay 2 detik
        echo "<script>setTimeout(\"location.href = 'aset.php';\",2000);</script>";
    }
?>