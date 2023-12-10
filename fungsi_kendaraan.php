<?php
// Menambah data kendaraan
if (isset($_POST['tambah'])) {
    $jk = $_POST['jk'];
    $nopol = $_POST['nopol'];
    $merek = $_POST['merek'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jab = $_POST['jab'];

    $tambahdata = mysqli_query($conn, "insert into kendaraan ( no_polisi, merek, j_kendaraan, nama_pegawai, nip, jab) values ('$nopol','$merek','$jk','$nama','$nip','$jab')");
    if ($tambahdata) {
        header('location:kendaraan');
    } else {
        echo 'Gagal';
        header('location:kendaraan');
    }
}

// Megubah data kendaraan
if (isset($_POST['update'])) {
    $idk = $_POST['idkendaraan'];
    $jk = $_POST['jk'];
    $merek = $_POST['merek'];
    $nopol = $_POST['nopol'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $jab = $_POST['jab'];


    $updatedata = mysqli_query($conn, "update kendaraan set no_polisi='$nopol', merek='$merek', j_kendaraan='$jk', nama_pegawai='$nama', nip='$nip', jab='$jab' where idkendaraan = '$idk' ");
    if ($updatedata) {
        header('location:kendaraan');
    } else {
        echo 'Gagal';
        header('location:kendaraan');
    }
}

// Menghapus data kendaraan
if (isset($_POST['hapus'])) {
    $idk = $_POST['idkendaraan'];

    $hapus = mysqli_query($conn, "delete from kendaraan where idkendaraan = '$idk' ");
    if ($hapus) {
        header('location:kendaraan');
    } else {
        echo 'Gagal';
        header('location:kendaraan');
    }
}
