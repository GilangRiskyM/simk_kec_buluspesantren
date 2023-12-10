<?php
include 'koneksi.php';
include 'fungsi_tanggal_indo.php';
date_default_timezone_set('Asia/Jakarta');
$sql = mysqli_query($conn, "SELECT * FROM cetak WHERE id = '" . $_GET['id'] . "'");
$data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="assets/img/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Voucher BBM</title>
    <link rel="icon" href="assets/img/logo.png" />
    <style>
        body {
            margin-left: 20px;
        }

        table tr td {
            font-size: 13;
        }

        .untuk {
            text-align: right;
        }
    </style>
</head>

<body>
    <table width="550" class="untuk">
        <tr>
            <td>
                <font size="4">
                    <b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Untuk Kecamatan</b>
                </font>
            </td>
        </tr>
    </table>
    <table width="520">
        <tr>
            <td>
                <font size="4.5">
                    <b>VOUCHER BBM KECAMATAN BULUSPESANTREN</b>
                </font>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>&nbsp;<?php echo tgl_indonesia($data['tanggal']) ?></td>
        </tr>
        <tr>
            <td>Jenis Kendaraan</td>
            <td>:</td>
            <td>&nbsp;<?php echo $data['jenis_kendaraan'] ?></td>
        </tr>
        <tr>
            <td>Nomor Polisi</td>
            <td>:</td>
            <td>&nbsp;<?php echo $data['nomor_polisi'] ?></td>
        </tr>
        <tr>
            <td>Jenis BBM</td>
            <td>: </td>
            <td>&nbsp;Pertamax</td>
        </tr>
        <tr>
            <td>Nilai Voucher</td>
            <td>:</td>
            <td>&nbsp;Rp. <?php echo $data['nilai_voucher'] ?> ,-</td>
        </tr>
        <tr>
            <td>Sub Kegiatan</td>
            <td>:</td>
            <td>&nbsp;Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;dan Perizinan Kendaraan Dinas Operasional atau Lapangan.</td>
        </tr>
    </table>
    <table width="550">
        <tr>
            <td>
                <center>
                    Kepala Sub Bag Umum dan
                </center>
            </td>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <center>
                    Kepegawaian
                </center>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <center>
                    Kec. Buluspesantren
                </center>
            </td>
            <td>
                <center>
                    Pemakai Kendaraan
                </center>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <center>
                    Petugas SPBU
                </center>
            </td>
        </tr>
        <tr>
            <td><br><br><br></td>
            <td><br><br><br></td>
            <td><br><br><br></td>
            <td><br><br><br></td>
        </tr>
        <tr>
            <td>
                <center>
                    <?php echo $data['nama_kasubbag'] ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $data['nama_pegawai'] ?>
                </center>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <center>
                    ..................................
                </center>
            </td>
        </tr>
    </table>
    <br><br><br>
    <br><br><br>
    <table width="520" class="untuk">
        <tr>
            <td>
                <font size="4">
                    <b>Untuk SPBU</b>
                </font>
            </td>
        </tr>
    </table>
    <table width="550">
        <tr>
            <td>
                <font size="4.5">
                    <b>VOUCHER BBM KECAMATAN BULUSPESANTREN</b>
                </font>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>&nbsp;<?php echo tgl_indonesia($data['tanggal']) ?></td>
        </tr>
        <tr>
            <td>Jenis Kendaraan</td>
            <td>:</td>
            <td>&nbsp;<?php echo $data['jenis_kendaraan'] ?></td>
        </tr>
        <tr>
            <td>Nomor Polisi</td>
            <td>:</td>
            <td>&nbsp;<?php echo $data['nomor_polisi'] ?></td>
        </tr>
        <tr>
            <td>Jenis BBM</td>
            <td>: </td>
            <td>&nbsp;Pertamax</td>
        </tr>
        <tr>
            <td>Nilai Voucher</td>
            <td>:</td>
            <td>&nbsp;Rp. <?php echo $data['nilai_voucher'] ?> ,-</td>
        </tr>
        <tr>
            <td>Sub Kegiatan</td>
            <td>:</td>
            <td>&nbsp;Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;dan Perizinan Kendaraan Dinas Operasional atau Lapangan.</td>
        </tr>
    </table>
    <table width="550">
        <tr>
            <td>
                <center>
                    Kepala Sub Bag Umum dan
                </center>
            </td>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <center>
                    Kepegawaian
                </center>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <center>
                    Kec. Buluspesantren
                </center>
            </td>
            <td>
                <center>
                    Pemakai Kendaraan
                </center>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <center>
                    Petugas SPBU
                </center>
            </td>
        </tr>
        <tr>
            <td><br><br><br></td>
            <td><br><br><br></td>
            <td><br><br><br></td>
            <td><br><br><br></td>
        </tr>
        <tr>
            <td>
                <center>
                    <?php echo $data['nama_kasubbag'] ?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $data['nama_pegawai'] ?>
                </center>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>
                <center>
                    ..................................
                </center>
            </td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>