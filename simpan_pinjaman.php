<?php 
    session_start(); 
    $user = $_SESSION['alogin']; 
    include('koneksi.php'); 
    
    //get data dari form 
    $queryid = "SELECT id_user from user where email='$user'"; 
    $result = mysqli_query($conn, $queryid); 
    $row = mysqli_fetch_array($result); 
    $id_user = $row['id_user'];
    $kode_booking = 'KD'.date('Ymd').rand(10,9999).$id_user; 

    //looping untuk menyimpan data peminjaman barang ke dalam database
    $no=1; 
    $query = mysqli_query($conn,"select * from aset where status='Disewakan' ORDER BY nama_barang ASC"); 
    while($row = mysqli_fetch_array($query)) { 
        $nama_barang= $row['nama_barang']; 
        $jumlah = $_POST['jumlahbarang'.$no++]; 
            $query_in = "INSERT INTO detail_booking (kode_booking,id_user,nama_barang,jumlah) values ('$kode_booking','$id_user','$nama_barang','$jumlah')"; 
            mysqli_query($conn, $query_in); 
            $query_del = "DELETE FROM detail_booking where jumlah = '0'";
            mysqli_query($conn, $query_del);
    }
    $tgl_booking = date("Y-m-d");
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $status = "Belum dikonfirmasi";
    $total = "0";
    $query_booking = "INSERT INTO booking (kode_booking, email, tgl_booking, tgl_mulai, tgl_selesai,total_bayar, status) VALUES ('$kode_booking', '$user', '$tgl_booking', '$tgl_mulai', '$tgl_selesai','$total', '$status')";
    mysqli_query($conn, $query_booking);
    //tampilkan pesan berhasil disimpan dan arahkan kembali ke halaman detail_pinjam.php setelah delay 2 detik
    echo "<script>setTimeout(\"location.href = 'detail_pinjam.php?kode_booking=".$kode_booking."';\",1000);</script>";
?>