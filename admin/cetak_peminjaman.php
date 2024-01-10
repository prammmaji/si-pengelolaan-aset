<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Peminjaman</title>
</head>
<body onload="window.print()">
    <div class="container-data">
        <span class="span-label">Daftar Laporan Peminjaman Aset Kantor Kepala Desa Beji</span>
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">KODE BOOKING</th>
                                        <th scope="col">TANGGAL BOOKING</th>
                                        <th scope="col">TANGGAL MULAI</th>
                                        <th scope="col">TANGGAL SELESAI</th>
                                        <th scope="col">BIAYA SEWA</th>
                                        <th scope="col">DENDA</th>
                                        <th scope="col">KETERANGAN</th>
                                        <th scope="col">TOTAL BAYAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include('../koneksi.php');
                                        $no= 1;
                                        $query = mysqli_query($conn,"SELECT user.nama, user.email, booking.kode_booking, booking.tgl_booking, booking.tgl_mulai, booking.tgl_selesai, booking.total_bayar, denda.jumlah_denda, denda.keterangan
                                        FROM `user`
                                        JOIN booking
                                        ON user.email = booking.email
                                        LEFT JOIN denda
                                        ON booking.kode_booking = denda.kode_booking
                                        WHERE booking.`status`='Selesai'");
                                        while($row = mysqli_fetch_array($query))
                                        {
                                            $total_bayar = intval($row['total_bayar']) + intval($row['jumlah_denda']);
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['kode_booking']; ?></td>
                                        <td><?php echo $row['tgl_booking']; ?></td>
                                        <td><?php echo $row['tgl_mulai']; ?></td>
                                        <td><?php echo $row['tgl_selesai']; ?></td>
                                        <td><?php echo $row['total_bayar']; ?></td>
                                        <td><?php echo $row['jumlah_denda']; ?></td>
                                        <td><?php echo $row['keterangan']; ?></td>
                                        <td><?php echo $total_bayar; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>