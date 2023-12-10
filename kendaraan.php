<?php
include "koneksi.php";
require "fungsi_kendaraan.php";
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
    <title>Admin | Data Kendaraan</title>
    <link rel="icon" href="assets/img/logo.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-info">
        <a class="navbar-brand" href="index"><img src="assets/img/logo.png" alt="" width="35" height="40"> <?= $nick ?></a>
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
                    <h1 class="mt-4">Data Kendaraan</h1>
                    <br>
                    <h2></h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Modal Tambah -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data Kendaraan
                            </button>
                            <hr>
                            <label>Pencarian Data : </label>
                            <form action="kendaraan" method="get" class="form-inline">
                                <div class="mb-2">
                                    <input type="text" name="cari" class="form-control ml-2" required>
                                    <button type="submit" class="btn btn-info">Cari</button>
                                    <a href="kendaraan" class="btn btn-danger">Batal</a>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Polisi</th>
                                            <th>Merek</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        if (isset($_GET['cari'])) {
                                            $cari = $_GET['cari'];
                                            $ambilsemuadatatabel = mysqli_query($conn, "select * from kendaraan where no_polisi like '%" . $cari . "%' or  j_kendaraan like '%" . $cari . "%' or nama_pegawai like '%" . $cari . "%' or nip like '%" . $cari . "%' or jab like '%" . $cari . "%' ");
                                        } else {
                                            $ambilsemuadatatabel = mysqli_query($conn, "select * from kendaraan");
                                        }
                                        if (mysqli_num_rows($ambilsemuadatatabel) > 0) {
                                            while ($data = mysqli_fetch_array($ambilsemuadatatabel)) {
                                                $jk = $data['j_kendaraan'];
                                                $nama = $data['nama_pegawai'];
                                                $nopol = $data['no_polisi'];
                                                $merek  = $data["merek"];
                                                $nip = $data['nip'];
                                                $idk = $data['idkendaraan'];
                                                $jab = $data['jab'];

                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $nopol ?></td>
                                                    <td><?= $merek ?></td>
                                                    <td><?= $jk ?></td>
                                                    <td><?= $nama ?></td>
                                                    <td><?= $nip ?></td>
                                                    <td><?= $jab ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#edit<?= $idk ?>">
                                                            Edit
                                                        </button>
                                                        <input type="hidden" name="idbarangygmaudihapus" value="">
                                                        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#hapus<?= $idk ?>">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="edit<?= $idk ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Kendaraan</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="idkendaraan" value="<?= $idk; ?>">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Nomor Polisi</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="nopol" value="<?= $nopol ?>" required>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Merek</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="merek" value="<?= $merek ?>" required>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Jenis Kendaraan</center>
                                                                        </span>
                                                                        <select class="form-select" name="jk">
                                                                            <option><?= $jk; ?></option>
                                                                            <option>Roda 2 (dua)</option>
                                                                            <option>Roda 4 (empat)</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Nama Pegawai</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="nama" value="<?= $nama ?>" required>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>NIP</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="nip" value="<?= $nip ?>" required>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Jabatan</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="jab" value="<?= $jab ?>" required>
                                                                    </div>
                                                                    <center>
                                                                        <button type="submit" class="btn btn-primary" name="update">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                    </center>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="hapus<?= $idk ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Barang</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data kendaraan berjenis <?= $jk ?> dengan no polisi <?= $nopol ?> yang dipakai oleh <?= $nama ?> dengan NIP <?= $nip ?>?
                                                                    <input type="hidden" name="idkendaraan" value="<?= $idk ?>">
                                                                    <br>
                                                                    <div class="alert alert-danger">
                                                                        <strong>Perhatian!</strong> Data yang telah dihapus tidak dapat dikembalikan.
                                                                    </div>
                                                                    <br>
                                                                    <br>
                                                                    <center>
                                                                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                                                                    </center>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td scope="row" colspan="6">
                                                    <center>
                                                        <h3>
                                                            Data Kosong
                                                        </h3>
                                                    </center>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
<!-- Modal Tambah Data -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Nomor Polisi</center>
                        </span>
                        <input type="text" class="form-control" name="nopol" required>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Merek</center>
                        </span>
                        <input type="text" class="form-control" name="merek" required>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Jenis Kendaraan</center>
                        </span>
                        <select class="form-select" name="jk">
                            <option>-- Pilih Jenis Kendaraan --</option>
                            <option>Roda 2 (dua)</option>
                            <option>Roda 4 (empat)</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Nama Pegawai</center>
                        </span>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>NIP</center>
                        </span>
                        <input type="text" class="form-control" name="nip" required>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Jabatan</center>
                        </span>
                        <input type="jab" class="form-control" name="jab" value="" required>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

</html>