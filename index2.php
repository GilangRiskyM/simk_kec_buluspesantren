<?php
require "koneksi.php";
include "fungsi_tanggal_indo.php";
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
    <style>
        #kartu {
            background-color: none;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-info">
        <a class="navbar-brand" href="index"><img src="assets/img/logo.png" alt="" width="35" height="40"> <?= $nick ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <marquee behavior="" direction="">
            <h4>Selamat Datang <?= $nick ?> di Sistem Informasi Manajemen Kendaraan Dinas Berbasis Web Kecamatan Buluspesantren <?= tgl_indonesia(date('Y-m-d')) ?></h4>
        </marquee>
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
                                <a class="nav-link" href="stok">Stok BBM</a>
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
                    <h1 class="mt-4">Informasi Hari Ini</h1>
                    <br>
                    <h2></h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="card text-dark mb-2" id="kartu">
                                        <div class="card-body bg-info">
                                            <center>
                                                <b>Info Stok BBM</b>
                                            </center>
                                            <br>
                                            <?php
                                            $sql = mysqli_query($conn, "select * from stok_bbm");
                                            while ($datastok = mysqli_fetch_array($sql)) {
                                            ?>
                                                <table>
                                                    <tr>
                                                        <td>Kendaraan <?= $datastok['jenis_kendaraan'] ?> Sisa <?= $datastok['stok'] ?> liter</td>
                                                    </tr>
                                                </table>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            $ambildatastok = mysqli_query($conn, "select * from stok_bbm where stok < 1");

                                            while ($fetch = mysqli_fetch_array($ambildatastok)) {
                                                $jk = $fetch['jenis_kendaraan'];
                                            ?>
                                                <div class="alert alert-danger mt-2" role="alert">
                                                    <strong>Perhatian!</strong> Stok untuk kendaraan berjenis <?= $jk ?> sudah habis!
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-6">
                                    <div class="card text-dark mb-2" id="kartu">
                                        <div class="card-body bg-warning">
                                            <center>
                                                <b>Info Pajak (Jatuh Tempo)</b>
                                            </center>
                                            <br>
                                            <?php
                                            $tgl = date("Y-m-d");
                                            $querynotif = mysqli_query($conn, "SELECT no_polisi, DATEDIFF(jatuh_tempo,'$tgl') AS interval_tgl FROM pajak");
                                            while ($data = mysqli_fetch_array($querynotif)) {
                                                $nopol = $data['no_polisi'];
                                                if ($data['interval_tgl'] < 0) {
                                            ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> sudah melewati batas Jatuh Tempo!!
                                                    </div>
                                                <?php
                                                } elseif ($data['interval_tgl'] == 0) {
                                                ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> akan Jatuh Tempo Hari Ini!
                                                    </div>
                                                <?php
                                                } elseif ($data['interval_tgl'] == 1) {
                                                ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> Jatuh Tempo Besok!
                                                    </div>
                                                <?php
                                                } elseif ($data['interval_tgl'] >= 2 and $data['interval_tgl'] < 8) {
                                                ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> akan Jatuh Tempo <?= $data['interval_tgl'] ?> hari lagi.
                                                    </div>
                                                <?php
                                                } elseif ($data['interval_tgl'] >= 8 and $data['interval_tgl'] < 15) {
                                                ?>
                                                    <div class="alert alert-warning" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> akan Jatuh Tempo <?= $data['interval_tgl'] ?> hari lagi.
                                                    </div>
                                                <?php
                                                } elseif ($data['interval_tgl'] >= 15 and $data['interval_tgl'] <= 30) {
                                                ?>
                                                    <div class="alert alert-success" role="alert">
                                                        Kendaraan dengan No Polisi <b><?= $nopol ?></b> akan Jatuh Tempo <?= $data['interval_tgl'] ?> hari lagi.
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Gilang Risky M <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
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

</html>