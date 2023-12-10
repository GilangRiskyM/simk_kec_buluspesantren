<?php
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');

// Menambah Stok Anggaran
if (isset($_POST['tambah'])) {
    $jk = $_POST['jk'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "insert into stok_bbm (jenis_kendaraan, stok) values('$jk','$stok')");
    if ($addtotable) {
        header('location:stok');
    } else {
        echo 'Gagal';
        header('location:stok');
    }
}

// Mengubah Stok Anggaran
if (isset($_POST['update'])) {
    $idb = $_POST['idbbm'];
    $jk = $_POST['jk'];
    $stok = $_POST['stok'];

    $update = mysqli_query($conn, "update stok_bbm set jenis_kendaraan='$jk', stok='$stok' where idbbm = '$idb'");
    if ($update) {
        header('location:stok');
    } else {
        echo 'Gagal';
        header('location:stok');
    }
}

// Menghapus Anggaran
if (isset($_POST['hapus'])) {
    $idb = $_POST['idbbm'];

    $hapus = mysqli_query($conn, "delete from stok_bbm where idbbm= '$idb' ");
    if ($hapus) {
        header('location:stok');
    } else {
        echo 'Gagal';
        header('location:stok');
    }
}
