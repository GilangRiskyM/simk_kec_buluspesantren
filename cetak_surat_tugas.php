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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="assets/img/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        .isi {
            text-align: left;
        }

        .tanggal {
            text-align: right;
        }

        .tugas {
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <table width="625">
            <tr>
                <td>
                    <center>
                        <img src="assets/img/logo.png" width="100" height="110">
                    </center>
                </td>
                <td>
                    <center>
                        <font size="4.5">PEMERINTAH KABUPATEN KEBUMEN</font><br>
                        <font size="5"><b>KECAMATAN BULUSPESANTREN</b></font><br>
                        <font size="2">Jalan Kejayan No. 191 Setrojenar Buluspesantren Kode Pos 54391</font><br>
                        <font size="2">E-mail : kecbuluspesantren06@gmail Website: kec-buluspesantrenkab.go.id</font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b>
                    </center>
                </td>
            </tr>
        </table>
        <table width="250">
            <tr>
                <td>
                    <center>
                        <font size="6"><u>SURAT TUGAS</u></font>
                        <br>
                        <font size="3">Nomor : 094/............................</font>
                    </center>
                </td>
            </tr>
        </table>
        <br>
        <table width="625" class="isi">
            <tr>
                <td colspan="3">
                    <font size="3">Yang bertandatangan di bawah ini, Camat Buluspesantren Kabupaten Kebumen menugaskan :</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 1. Nama</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['nama_pegawai'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 2. NIP</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['nip_pegawai'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 3. Jabatan</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['jabatan'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 4. Alamat Kantor</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3">Jalan Kejayan No. 191 Setrojenar, Buluspesantren</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 5. Keperluan / Uraian Tugas</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['keperluan'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp;</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['keperluan_2'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 6. Jumlah Penumpang</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['penumpang'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 7. Tanggal</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo tgl_indonesia($data['tanggal']) ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 8. Waktu</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['waktu_angka'] ?> (<?php echo $data['waktu_huruf'] ?>) hari</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">&nbsp; 9. Kendaraan</font>
                </td>
                <td>
                    <font size="3">:</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['jenis_kendaraan'] ?> / <?php echo $data['nomor_polisi'] ?></font>
                </td>
            </tr>
        </table>
        <br><br>
        <table width="625" class="tanggal">
            <tr>
                <td>
                    <font size="3">Buluspesantren, <?php echo tgl_indonesia2($data['tanggal']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>
                </td>
            </tr>
        </table>
        <table width="625" class="tugas">
            <tr>
                <td>
                    <font size="3">Penerima Tugas</font>
                </td>
                <td>
                    <font size="3">&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td>
                    <font size="3">Yang Memberi Tugas</font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3"><br><br><br></font>
                </td>
                <td>
                    <font size="3"><br><br><br></font>
                </td>
                <td>
                    <font size="3"><br><br><br></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3"><?php echo $data['nama_pegawai'] ?></font>
                </td>
                <td>
                    <font size="3">&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td>
                    <font size="3"><?php echo $data['nama_camat'] ?></font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="3">NIP. <?php echo $data['nip_pegawai'] ?></font>
                </td>
                <td>
                    <font size="3">&nbsp;&nbsp;&nbsp;</font>
                </td>
                <td>
                    <font size="3">NIP. <?php echo $data['nip_camat'] ?></font>
                </td>
            </tr>
        </table>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>