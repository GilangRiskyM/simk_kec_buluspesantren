<?php
include "koneksi.php";

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
    <title>Admin | Stok BBM</title>
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
                    <h1 class="mt-4">Stok BBM</h1>
                    <br>
                    <h2></h2>
                    <div class="card mb-4">
                        <div class="card-body">

                            <?php
                            $ambildatastok = mysqli_query($conn, "select * from stok_bbm where stok < 1");

                            while ($fetch = mysqli_fetch_array($ambildatastok)) {
                                $jk = $fetch['jenis_kendaraan'];
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stok untuk kendaraan berjenis <?= $jk ?> sudah habis!
                                </div>

                            <?php
                            }
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Stok (liter)</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        $ambilsemuadatastok = mysqli_query($conn, "select * from stok_bbm");
                                        if (mysqli_num_rows($ambilsemuadatastok) > 0) {
                                            while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                                $jk = $data['jenis_kendaraan'];
                                                $stok = $data['stok'];
                                                $idb = $data['idbbm'];


                                        ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $jk ?></td>
                                                    <td><?= $stok ?></td>

                                                </tr>
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="edit<?= $idb ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Barang</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="idbbm" value="<?= $idb ?>">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Jenis Kendaraan</center>
                                                                        </span>
                                                                        <select class="form-select" aria-label="Default select example" name="jk">
                                                                            <option><?= $jk ?></option>
                                                                            <option>Roda 2 (dua)</option>
                                                                            <option>Roda 4 (empat)</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text" style="width: 135px;">
                                                                            <center>Stok</center>
                                                                        </span>
                                                                        <input type="num" class="form-control" name="stok" value="<?= $stok ?>" required>
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
                                                <div class="modal fade" id="hapus<?= $idb ?>">
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
                                                                    Apakah Anda yakin ingin menghapus data kendaraan berjenis <?= $jk ?>?
                                                                    <input type="hidden" name="idbbm" value="<?= $idb ?>">
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
                                                <td scope="row" colspan="4">
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

</html>