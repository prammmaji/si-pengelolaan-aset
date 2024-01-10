<?php
    session_Start();
    $user = $_SESSION['admin'];
    include('../koneksi.php');
    //get data dari from
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $sumber = $_POST['sumber']; 
    
    $tgl_beli = $_POST['tgl_pembelian'];

    $tgl_beli = date('Y-m-d', strtotime($tgl_beli));
    $status = $_POST['status']; 
    $query1 = "SELECT COUNT(*) AS jumlah FROM aset WHERE nama_barang = '$nama_barang'";
    $result = mysqli_query($conn, $query1);
    $data = mysqli_fetch_assoc($result);
    
    //jika jumlah data yang ditemukan > 0, maka nama barang sudah ada dan operasi insert dihentikan
    if($data['jumlah'] > 0) {
      echo "<script>alert('Nama barang sudah ada. Silahkan melakukan update data');</script>";
      echo "<script>setTimeout(\"location.href = 'tambah_aset.php';\",2000);</script>";

    } else {
      //query untuk insert data ke tabel aset
      $query_pengadaan = "INSERT INTO pengadaan (nama_barang, jumlah,sumber_dana,tgl_pembelian,
      penanggung_jawab) VALUES ('$nama_barang', $jumlah,'$sumber','$tgl_beli','$user')";
      mysqli_query($conn, $query_pengadaan);
      $query_aset = "INSERT INTO aset (nama_barang,stok,harga,status) VALUES ('$nama_barang',$jumlah,$harga,$status)";
      mysqli_query($conn, $query_aset);
    
      echo "<script>alert('Data berhasil disimpan.');</script>";

      //arahkan kembali ke halaman index setelah delay 2 detik
      echo "<script>setTimeout(\"location.href = 'aset.php';\",2000);</script>";
    }


?>