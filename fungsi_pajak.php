<?php
date_default_timezone_set('Asia/Jakarta');
// Menambah data pajak
if (isset($_POST['tambah'])) {
    $merek = $_POST['merek'];
    $nopol = $_POST['no_polisi'];
    $tahun_kendaraan = $_POST['tahun_kendaraan'];
    $jatuh_tempo = $_POST['jatuh_tempo'];
    $lima_tahun_awal = $_POST['5_tahun_awal'];
    $lima_tahun_akhir = $_POST['5_tahun_akhir'];
    $ket = $_POST['keterangan'];

    $tambahdata = mysqli_query($conn, "insert into pajak (merek, no_polisi, tahun_kendaraan, jatuh_tempo, 5_tahun_awal, 5_tahun_akhir, keterangan) values ('$merek','$nopol','$tahun_kendaraan','$jatuh_tempo','$lima_tahun_awal','$lima_tahun_akhir','$ket')");
    if ($tambahdata) {
        header('location:pajak');
    } else {
        echo 'Gagal';
        header('location:pajak');
    }
}
// Megubah data pajak
if (isset($_POST['update'])) {
    $id = $_POST['idpajak'];
    $merek = $_POST['merek'];
    $nopol = $_POST['no_polisi'];
    $tahun_kendaraan = $_POST['tahun_kendaraan'];
    $jatuh_tempo = $_POST['jatuh_tempo'];
    $lima_tahun_awal = $_POST['5_tahun_awal'];
    $lima_tahun_akhir = $_POST['5_tahun_akhir'];
    $ket = $_POST['keterangan'];


    $updatedata = mysqli_query($conn, "update pajak set merek='$merek', no_polisi='$nopol', tahun_kendaraan='$tahun_kendaraan', jatuh_tempo='$jatuh_tempo', 5_tahun_awal='$lima_tahun_awal', 5_tahun_akhir='$lima_tahun_akhir', keterangan='$ket' where idpajak = '$id' ");
    if ($updatedata) {
        header('location:pajak');
    } else {
        echo 'Gagal';
        header('location:pajak');
    }
}

// Menghapus data pajak
if (isset($_POST['hapus'])) {
    $id = $_POST['idpajak'];

    $hapus = mysqli_query($conn, "delete from pajak where idpajak = '$id' ");
    if ($hapus) {
        header('location:pajak');
    } else {
        echo 'Gagal';
        header('location:pajak');
    }
}
