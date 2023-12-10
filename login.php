<?php
require "koneksi.php";
$error = '';
session_start();

if (isset($_POST['login'])) {
    $username   =   $_POST['username'];
    $password   =   $_POST['password'];
    $qry = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($qry);
    if ($cek == 1) {
        $_SESSION['userweb'] = $username;
        header("location:index");
        exit;
    } else {
        $error = "Username atau Password Anda Salah!";
    }
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
    <title>SI Kendaraan | Login</title>
    <link rel="icon" href="assets/img/logo.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
    </style>
</head>

<body class="bg-success">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <center>
                                        <img src="assets/img/logo.png" alt="Gambar gagal dimuat..." width="100" height="120">
                                    </center>
                                    <h5 class="text-center font-weight-light my-1">Sistem Informasi Manajemen Kendaraan Dinas <br>Kecamatan Buluspesantren</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Username</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Masukan Username Anda" name="username" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" placeholder="Masukan Password Anda" name="password" />
                                        </div>
                                        <?php
                                        if ($error) {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?= $error ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group d-flex align-items-center justify-content-center">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>