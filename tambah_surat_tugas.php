<?php
require "koneksi.php";
session_start();
if (!isset($_SESSION['userweb'])) {
    header("location: login");
    exit;
}

$username = $_SESSION['userweb'];
$ambildatalogin = mysqli_query($conn, "select * from login where username='$username' ");
while ($logininfo = mysqli_fetch_array($ambildatalogin)) {
    $nick = $logininfo['nick'];
}

$sql = mysqli_query($conn, "select * from keluar where idkeluar = '" . $_GET['id'] . "' ");
$dt = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Dashboard</title>
    <link rel="icon" href="assets/img/logo.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-info">
        <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="..." width="35" height="40"> <?= $nick ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index">
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#databbm" aria-expanded="false" aria-controls="collapseLayouts">
                            Data BBM
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="databbm" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="stok">Data Stok BBM</a>
                                <a class="nav-link" href="masuk">Tambah Stok BBM</a>
                                <a class="nav-link" href="keluar">Data Pengeluaran BBM</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kendaraan" aria-expanded="false" aria-controls="collapseLayouts">
                            Kendaraan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="kendaraan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="kendaraan">Data Kendaraan</a>
                                <a class="nav-link" href="pajak">Informasi Pajak</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="surat_tugas">
                            Surat Tugas
                        </a>
                        <a class="nav-link" href="logout">
                            Keluar
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="card mb-2 mt-2">
                        <div class="card-header">
                            <center>
                                <h2>Tambah Surat Tugas</h2>
                            </center>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Nama</center>
                                    </span>
                                    <input type="text" class="form-control" value="<?= $dt['nama_peg'] ?>" name="nama_pegawai" readonly>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>NIP</center>
                                    </span>
                                    <input type="text" class="form-control" value="<?= $dt['no_induk_peg'] ?>" name="nip_pegawai" readonly>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Jabatan</center>
                                    </span>
                                    <input type="text" class="form-control" value="<?= $dt['jabatan'] ?>" name="jabatan" readonly>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Keperluan / Uraian Tugas</center>
                                    </span>
                                    <input type="text" class="form-control" value="" name="keperluan" placeholder="Baris pertama di surat tugas">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>&nbsp;</center>
                                    </span>
                                    <input type="text" class="form-control" value="" name="keperluan_2" placeholder="Baris kedua di surat tugas">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Jumlah Penumpang</center>
                                    </span>
                                    <input type="text" class="form-control" value="" name="penumpang">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Tanggal</center>
                                    </span>
                                    <input type="date" class="form-control" value="" name="tanggal">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Waktu</center>
                                    </span>
                                    <input type="text" class="form-control" value="" name="waktu_angka" placeholder="Diisi dengan angka">
                                    <input type="text" class="form-control" value="" name="waktu_huruf" placeholder="Diisi dengan huruf">
                                    <span class="input-group-text" style="width: 50px;">
                                        hari
                                    </span>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Kendaraan</center>
                                    </span>
                                    <input type="text" class="form-control" value="<?= $dt['jen_kendaraan'] ?>" name="jenis_kendaraan" readonly>
                                    <input type="text" class="form-control" value="<?= $dt['no_pol'] ?>" name="nomor_polisi" readonly>
                                </div>
                                <hr>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Harga BBM</center>
                                    </span>
                                    <input type="text" class="form-control" value="" name="harga_bbm" placeholder="Diisi dengan angka contoh 10000">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Jumlah BBM</center>
                                    </span>
                                    <input type="text" class="form-control" value="<?= $dt['jumlah'] ?>" name="jumlah_bbm" readonly>
                                    <span class="input-group-text" style="width: 50px;">
                                        liter
                                    </span>
                                </div>
                                <hr>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>Nama Camat</center>
                                    </span>
                                    <input type="text" class="form-control" name="nama_camat">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        <center>NIP Camat</center>
                                    </span>
                                    <input type="text" class="form-control" name="nip_camat">
                                </div>
                                <hr>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" style="width: 220px;">
                                        Kasubbag Umum & Kepeg.
                                    </span>
                                    <input type="text" class="form-control" value="Nur Fatimah, S.IP" name="nama_kasubbag">
                                </div>
                                <br>
                                <center>
                                    <button class="btn btn-primary mr-2" type="submit" name="kirim">Simpan</button>
                                    <a href="keluar" class="btn btn-secondary">Kembali</a>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Gilang Risky M 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>
<?php

if (isset($_POST['kirim'])) {
    $nomor_polisi = $_POST['nomor_polisi'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $nip_pegawai = $_POST['nip_pegawai'];
    $jabatan = $_POST['jabatan'];
    $keperluan = $_POST['keperluan'];
    $keperluan_2 = $_POST['keperluan_2'];
    $penumpang = $_POST['penumpang'];
    $nama_camat = $_POST['nama_camat'];
    $nip_camat = $_POST['nip_camat'];
    $tanggal = $_POST['tanggal'];
    $waktu_huruf = $_POST['waktu_huruf'];
    $waktu_angka = $_POST['waktu_angka'];
    $nama_kasubbag = $_POST['nama_kasubbag'];
    $harga = $_POST['harga_bbm'];
    $jumlah_bbm = $_POST['jumlah_bbm'];
    $nilai_voucher = $harga * $jumlah_bbm;

    $sql = "insert into cetak (nomor_polisi,jenis_kendaraan,nama_pegawai,nip_pegawai,jabatan,keperluan,keperluan_2,penumpang,nama_camat,nip_camat,tanggal,waktu_huruf,waktu_angka,nama_kasubbag,nilai_voucher,jumlah_bbm,harga_bbm) values('$nomor_polisi','$jenis_kendaraan','$nama_pegawai','$nip_pegawai','$jabatan','$keperluan','$keperluan_2','$penumpang','$nama_camat','$nip_camat','$tanggal','$waktu_huruf','$waktu_angka','$nama_kasubbag','$nilai_voucher','$jumlah_bbm','$harga')";

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "
            <script>
                window.location='surat_tugas'
            </script>
            ";
    }
}
?>

</html>