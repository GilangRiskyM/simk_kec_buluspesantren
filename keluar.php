<?php
include "koneksi.php";
require "fungsi_keluar.php";
include "fungsi_pengeluaran.php";
date_default_timezone_set('Asia/Jakarta');
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
    <title>Admin | Data Pengeluaran</title>
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
                    <h1 class="mt-4">Data Pengeluaran BBM</h1>
                    <br>
                    <h2></h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Modal Tambah -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                                Tambah Data Pengeluaran
                            </button>
                            <hr>
                            <div class="col mt-2 ml-2">
                                <label class="mb-2">Filter Data</label>
                                <form method="get" action="keluar" class="form-inline">
                                    <label>Dari Tanggal : </label>
                                    <input type="date" name="tglawal" id="" class="form-control ml-2" required>
                                    <label class="ml-2">Sampai Tanggal : </label>
                                    <input type="date" name="tglakhir" id="" class="form-control ml-2" required>
                                    <button type="submit" class="btn btn-info ml-2">Filter</button>
                                    <button type="submit" class="btn btn-primary ml-2" name="export">Cetak Excel</button>
                                    <a href="keluar" class="btn btn-danger ml-2">Batal</a>
                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis BBM</th>
                                            <th>No. Polisi</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>Jumlah (liter)</th>
                                            <th>Tanggal Memasukan Data</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        if (isset($_GET['tglawal'])) {
                                            $tglawal = $_GET['tglawal'];
                                            $tglakhir = $_GET['tglakhir'];
                                            $ambilsemuadatastok = mysqli_query($conn, "select * from keluar k, stok_bbm s, kendaraan x where s.idbbm = k.idbbm and x.no_polisi = k.no_pol and tanggal between '$tglawal' and DATE_ADD('$tglakhir',INTERVAL 1 DAY) order by idkeluar desc");
                                        } else {
                                            $ambilsemuadatastok = mysqli_query($conn, "select * from keluar k, stok_bbm s, kendaraan x where s.idbbm = k.idbbm and x.no_polisi = k.no_pol order by k.idkeluar desc");
                                        }
                                        if (mysqli_num_rows($ambilsemuadatastok) > 0) {
                                            while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                                $idb = $data['idbbm'];
                                                $jk = $data['jenis_kendaraan'];
                                                $stok = $data['stok'];

                                                $idx = $data['idkendaraan'];
                                                $jkx = $data['j_kendaraan'];
                                                $nopolx = $data['no_polisi'];
                                                $namax = $data['nama_pegawai'];
                                                $nipx = $data['nip'];
                                                $jab = $data['jab'];

                                                $idk = $data['idkeluar'];
                                                $nopolk = $data['no_pol'];
                                                $jkk = $data['jen_kendaraan'];
                                                $namak = $data['nama_peg'];
                                                $nipk = $data['no_induk_peg'];
                                                $jumlah = $data['jumlah'];
                                                $tanggal = $data['tanggal'];
                                                $jabatan = $data['jabatan'];
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $jk ?></td>
                                                    <td><?= $nopolk ?></td>
                                                    <td><?= $jkk ?></td>
                                                    <td><?= $namak ?></td>
                                                    <td><?= $nipk ?></td>
                                                    <td><?= $jabatan ?></td>
                                                    <td><?= $jumlah ?></td>
                                                    <td><?= $tanggal ?></td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#edit<?= $idk ?>">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#hapus<?= $idk ?>">
                                                                Hapus
                                                            </button>
                                                            <a href="tambah_surat_tugas?id=<?php echo $data['idkeluar'] ?>" class="btn btn-sm btn-info">Tambah Surat Tugas</a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="edit<?= $idk ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Pengeluaran</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="idk" value="<?= $idk ?>">
                                                                    <input type="hidden" name="idbbm" value="<?= $idb ?>">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Jenis BBM</center>
                                                                        </span>
                                                                        <?php
                                                                        $ambilsemuadata = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb'");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {
                                                                            $jenisnya = $fetcharray['jenis_kendaraan'];
                                                                        ?>
                                                                            <input type="text" class="form-control" value="<?= $jenisnya ?>" readonly>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>No Polisi</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $nopolk ?>" readonly>
                                                                    </div>
                                                                    <div id="edit">
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="width: 135px;">
                                                                                <center>Jenis Kendaraan</center>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="jen_kendaraan" value="<?= $jkk ?>" readonly>
                                                                        </div>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="width: 135px;">
                                                                                <center>Nama Pegawai</center>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="nama_peg" value="<?= $namak ?>" readonly>
                                                                        </div>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="width: 135px;">
                                                                                <center>NIP</center>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="no_induk_peg" value="<?= $nipk ?>" readonly>
                                                                        </div>
                                                                        <div class="input-group mb-2">
                                                                            <span class="input-group-text" style="width: 135px;">
                                                                                <center>Jabatan</center>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="jabatan" value="<?= $jabatan ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Jumlah</center>
                                                                        </span>
                                                                        <input type="num" class="form-control" name="jumlah" value="<?= $jumlah ?>" placeholder="Liter" required>
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
                                                                <h4 class="modal-title">Hapus Data</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data pengeluaran dengan Nomor Polisi <?= $nopolk ?>, jenis kendaraan <?= $jkk ?>, dengan Nama Pegawai <?= $namak ?> dan NIP <?= $nipk ?>, sebanyak <?= $jumlah ?> liter?
                                                                    <input type="hidden" name="idbbm" value="<?= $idb ?>">
                                                                    <input type="hidden" name="idkeluar" value="<?= $idk ?>">
                                                                    <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
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
                                                <td scope="row" colspan="10">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#nopol').on('change', function() {
                var nopol = $(this).val();
                $.ajax({
                    url: 'js_tambah_data_keluar.php',
                    type: "POST",
                    data: {
                        modul: 'Tambahpe',
                        id: nopol
                    },
                    success: function(respond) {
                        $("#tambahpe").html(respond);
                    },
                    error: function() {
                        alert("Gagal Mengambil Data");
                    }
                })
            })
        });
    </script>
</body>
<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pengeluaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST">
                <div class="modal-body">

                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>No Polisi</center>
                        </span>
                        <select class="form-select" name="nopol" id="nopol">
                            <option>-- Pilih No Polisi --</option>
                            <?php
                            $sql = mysqli_query($conn, "select * from kendaraan");
                            while ($r = mysqli_fetch_array($sql)) {
                                $nop = $r['no_polisi'];
                                $jken = $r['j_kendaraan'];
                                $nam = $r['nama_pegawai'];
                                $noinduk = $r['nip'];
                            ?>
                                <option><?= $nop ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div id="tambahpe">
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="width: 135px;">
                                <center>Jenis Kendaraan</center>
                            </span>
                            <input type="text" class="form-control" name="jen_kendaraan" value="" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="width: 135px;">
                                <center>Nama Pegawai</center>
                            </span>
                            <input type="text" class="form-control" name="nama_peg" value="" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="width: 135px;">
                                <center>NIP</center>
                            </span>
                            <input type="text" class="form-control" name="no_induk_peg" value="" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="width: 135px;">
                                <center>Jabatan</center>
                            </span>
                            <input type="text" class="form-control" name="jabatan" value="" readonly>
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>BBM</center>
                        </span>
                        <select class="form-select" name="idbbm">
                            <option>-- Pilih BBM --</option>
                            <?php
                            $ambilsemuadata = mysqli_query($conn, "select * from stok_bbm");
                            while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {
                                $jenisnya = $fetcharray['jenis_kendaraan'];
                                $idbbmnya = $fetcharray['idbbm'];
                            ?>
                                <option value="<?= $idbbmnya; ?>"><?= $jenisnya; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text" style="width: 135px;">
                            <center>Jumlah</center>
                        </span>
                        <input type="num" class="form-control" name="jumlah" placeholder="Liter" required>
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