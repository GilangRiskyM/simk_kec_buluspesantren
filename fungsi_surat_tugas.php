<?php
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";

// Mengubah data cetak
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $keperluan = $_POST['keperluan'];
    $keperluan_2 = $_POST['keperluan_2'];
    $penumpang = $_POST['penumpang'];
    $tanggal = $_POST['tanggal'];
    $waktu_angka = $_POST['waktu_angka'];
    $waktu_huruf = $_POST['waktu_huruf'];
    $harga = $_POST['harga_bbm'];
    $jumlah_bbm = $_POST['jumlah_bbm'];
    $nilai_voucher = $harga * $jumlah_bbm;
    $nama_camat = $_POST['nama_camat'];
    $nip_camat = $_POST['nip_camat'];
    $nama_kasubbag = $_POST['nama_kasubbag'];

    $update = mysqli_query($conn, "update cetak set keperluan='$keperluan', keperluan_2='$keperluan_2', penumpang='$penumpang', nama_camat='$nama_camat', nip_camat='$nip_camat', tanggal='$tanggal', waktu_huruf='$waktu_huruf', waktu_angka='$waktu_angka', nama_kasubbag='$nama_kasubbag', nilai_voucher='$nilai_voucher', harga_bbm='$harga' where id='$id'");

    if ($update) {
        header('location:surat_tugas');
    } else {
        echo 'Gagal';
        header('location:surat_tugas');
    }
}

// Menghapus data kendaraan
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $hapus = mysqli_query($conn, "delete from cetak where id = '$id' ");
    if ($hapus) {
        header('location:surat_tugas');
    } else {
        echo 'Gagal';
        header('location:surat_tugas');
    }
}
