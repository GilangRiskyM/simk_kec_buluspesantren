<?php
include "koneksi.php";
require "fungsi_surat_tugas.php";
include "fungsi_tanggal_indo.php";
include "fungsi_ex_surat.php";
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
    <title>Admin | Surat Tugas</title>
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
                    <h1 class="mt-4">Surat Tugas</h1>
                    <br>
                    <h2></h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="col mt-2 ml-2">
                                <label>Pencarian Data : </label>
                                <form action="surat_tugas" method="get" class="form-inline">
                                    <div class="mb-2">
                                        <input type="text" name="cari" class="form-control ml-2" required>
                                        <button type="submit" class="btn btn-info">Cari</button>
                                        <a href="surat_tugas" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                                <hr>
                                <label class="mb-2">Filter Data</label>
                                <form method="get" action="surat_tugas" class="form-inline">
                                    <label>Dari Tanggal : </label>
                                    <input type="date" name="tglawal" id="" class="form-control ml-2" required>
                                    <label class="ml-2">Sampai Tanggal : </label>
                                    <input type="date" name="tglakhir" id="" class="form-control ml-2" required>
                                    <button type="submit" class="btn btn-info ml-2">Filter</button>
                                    <button type="submit" class="btn btn-primary ml-2" name="export">Cetak Excel</button>
                                    <a href="surat_tugas" class="btn btn-danger ml-2">Batal</a>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Polisi</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Pegawai</th>
                                            <th>NIP Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>Keperluan</th>
                                            <th>Penumpang</th>
                                            <th>Nama Camat</th>
                                            <th>NIP Camat</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Nama Kasubbag</th>
                                            <th>Nilai Voucher</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        if (isset($_GET['tglawal'])) {
                                            $tglawal = $_GET['tglawal'];
                                            $tglakhir = $_GET['tglakhir'];
                                            $ambilsemuadata = mysqli_query($conn, "select * from cetak where tanggal between '$tglawal' and DATE_ADD('$tglakhir',INTERVAL 1 DAY) order by id desc");
                                        } elseif (isset($_GET['cari'])) {
                                            $cari = $_GET['cari'];
                                            $ambilsemuadata = mysqli_query($conn, "select * from cetak where nomor_polisi like '%" . $cari . "%' or jenis_kendaraan like '%" . $cari . "%' or nama_pegawai like '%" . $cari . "%' or nip_pegawai like '%" . $cari . "%' or jabatan like '%" . $cari . "%' or keperluan like '%" . $cari . "%' or keperluan_2 like '%" . $cari . "%' or penumpang like '%" . $cari . "%' or nama_camat like '%" . $cari . "%' or nip_camat like '%" . $cari . "%' or nilai_voucher like '%" . $cari . "%' or harga_bbm like '%" . $cari . "%' order by id desc");
                                        } else {
                                            $ambilsemuadata = mysqli_query($conn, "select * from cetak order by id desc");
                                        }
                                        if (mysqli_num_rows($ambilsemuadata) > 0) {
                                            while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                                $id = $data['id'];
                                                $nopol = $data['nomor_polisi'];
                                                $jk = $data['jenis_kendaraan'];
                                                $nama_pegawai = $data['nama_pegawai'];
                                                $nip_pegawai = $data['nip_pegawai'];
                                                $jab = $data['jabatan'];
                                                $keperluan = $data['keperluan'];
                                                $keperluan_2 = $data['keperluan_2'];
                                                $penumpang = $data['penumpang'];
                                                $nama_camat = $data['nama_camat'];
                                                $nip_camat = $data['nip_camat'];
                                                $tanggal = $data['tanggal'];
                                                $waktu_huruf = $data['waktu_huruf'];
                                                $waktu_angka = $data['waktu_angka'];
                                                $nama_kasubbag = $data['nama_kasubbag'];
                                                $nilai_voucher = $data['nilai_voucher'];
                                                $jumlah = $data['jumlah_bbm'];
                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $nopol ?></td>
                                                    <td><?= $jk ?></td>
                                                    <td><?= $nama_pegawai ?></td>
                                                    <td><?= $nip_pegawai ?></td>
                                                    <td><?= $jab ?></td>
                                                    <td><?= $keperluan ?>&nbsp;<?= $keperluan_2 ?></td>
                                                    <td><?= $penumpang ?> Orang</td>
                                                    <td><?= $nama_camat ?></td>
                                                    <td><?= $nip_camat ?></td>
                                                    <td><?= tgl_indonesia3($tanggal) ?></td>
                                                    <td><?= $waktu_angka ?>&nbsp;(<?= $waktu_huruf ?>)&nbsp;hari</td>
                                                    <td><?= $nama_kasubbag ?></td>
                                                    <td>Rp. <?= $nilai_voucher ?>,- / <?= $jumlah ?> liter</td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#edit<?= $id ?>">
                                                                Edit
                                                            </button>
                                                            <br>
                                                            <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#hapus<?= $id ?>">
                                                                Hapus
                                                            </button>
                                                            <br>
                                                            <a href="cetak_surat_tugas?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-info mb-2">Surat Tugas</a>
                                                            <br>
                                                            <a href="cetak_bbm?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-info">Voucher BBM</a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="edit<?= $id ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Data Surat Tugas</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                                    <?php
                                                                    $sql = mysqli_query($conn, "select * from cetak where id = '$id'");
                                                                    $dt = mysqli_fetch_array($sql);
                                                                    ?>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Nama Pegawai</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['nama_pegawai'] ?>" name="nama_pegawai" readonly>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>NIP Pegawai</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['nip_pegawai'] ?>" name="nip_pegawai" readonly>
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
                                                                        <input type="text" class="form-control" value="<?= $dt['keperluan'] ?>" name="keperluan" placeholder="Baris pertama di surat tugas">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>&nbsp;</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['keperluan_2'] ?>" name="keperluan_2" placeholder="Baris kedua di surat tugas">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Jumlah Penumpang</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['penumpang'] ?>" name="penumpang">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Tanggal</center>
                                                                        </span>
                                                                        <input type="date" class="form-control" value="<?= $dt['tanggal'] ?>" name="tanggal">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Waktu</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['waktu_angka'] ?>" name="waktu_angka" placeholder="Diisi dengan angka">
                                                                        <input type="text" class="form-control" value="<?= $dt['waktu_huruf'] ?>" name="waktu_huruf" placeholder="Diisi dengan huruf">
                                                                        <span class="input-group-text" style="width: 50px;">
                                                                            hari
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Kendaraan</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['jenis_kendaraan'] ?>" name="jenis_kendaraan" readonly>
                                                                        <input type="text" class="form-control" value="<?= $dt['nomor_polisi'] ?>" name="nomor_polisi" readonly>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Harga BBM</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['harga_bbm'] ?>" name="harga_bbm" placeholder="Diisi dengan angka contoh 10000">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Jumlah BBM</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['jumlah_bbm'] ?>" name="jumlah_bbm" readonly>
                                                                        <span class="input-group-text" style="width: 50px;">
                                                                            liter
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Nilai Voucher</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" value="<?= $dt['nilai_voucher'] ?>" name="" placeholder="" readonly>
                                                                        <span class="input-group-text">
                                                                            <center> Nilai Voucher akan berubah ketika data disimpan.</center>
                                                                        </span>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>Nama Camat</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="nama_camat" value="<?= $dt['nama_camat'] ?>">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            <center>NIP Camat</center>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="nip_camat" value="<?= $dt['nip_camat'] ?>">
                                                                    </div>
                                                                    <hr>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 220px;">
                                                                            Kasubbag Umum & Kepeg.
                                                                        </span>
                                                                        <input type="text" class="form-control" value="Nur Fatimah, S.IP" name="nama_kasubbag">
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
                                                <div class="modal fade" id="hapus<?= $id ?>">
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
                                                                    Apakah Anda yakin ingin menghapus data dibawah ini?<br>
                                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                                    Nomor Polisi : <?= $nopol ?><br>
                                                                    Jenis Kendaraan : <?= $jk ?><br>
                                                                    Nama Pegawai : <?= $nama_pegawai ?><br>
                                                                    NIP Pegawai : <?= $nip_pegawai ?><br>
                                                                    Jabatan : <?= $jab ?><br>
                                                                    Keperluan : <?= $keperluan ?>&nbsp;<?= $keperluan_2 ?><br>
                                                                    Penumpang : <?= $penumpang ?><br>
                                                                    Nama Camat : <?= $nama_camat ?><br>
                                                                    NIP Camat : <?= $nip_camat ?><br>
                                                                    Tanggal : <?= tgl_indonesia3($tanggal) ?><br>
                                                                    Waktu : <?= $waktu_angka ?>&nbsp;(<?= $waktu_huruf ?>)&nbsp;hari <br>
                                                                    Nama Kasubbag : <?= $nama_kasubbag ?><br>
                                                                    Nilai Voucher : Rp. <?= $nilai_voucher ?>,- / <?= $jumlah ?> liter <br>
                                                                    <div class="alert alert-danger">
                                                                        <strong>Perhatian!</strong> Data yang telah dihapus tidak dapat dikembalikan.
                                                                    </div>
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
                                                <td scope="row" colspan="15">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>

</html>