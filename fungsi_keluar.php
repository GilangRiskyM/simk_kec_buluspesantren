<?php
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
// Menambah bbm keluar dan mengurangi stok
if (isset($_POST['tambah'])) {
    $idb = $_POST['idbbm'];
    $nopol = $_POST['nopol'];
    $jk = $_POST['jen_kendaraan'];
    $nama = $_POST['nama_peg'];
    $nip = $_POST['no_induk_peg'];
    $jab = $_POST['jabatan'];
    $jumlah = $_POST['jumlah'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb'"); //perintah untuk mengambil data dari tabel stok
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];

    if ($stoksekarang >= $jumlah) {

        // Kalau stoknya cukup

        $kurangistoksekarangdenganquantity = $stoksekarang - $jumlah; //untuk mengurangi stok yg ada di tabel stok

        $sqltambah = mysqli_query($conn, "insert into keluar (idbbm, no_pol, jen_kendaraan, nama_peg, no_induk_peg, jabatan, jumlah) values('$idb','$nopol','$jk','$nama','$nip','$jab','$jumlah')"); //perintah untuk menambah data stok yg masuk di tabel masuk
        $updatestok = mysqli_query($conn, "update stok_bbm set stok='$kurangistoksekarangdenganquantity' where idbbm='$idb'"); //perintah untuk menambah stok yg ada di tabel stok
        if ($updatestok) {
            header('location:keluar');
        } else {
            echo 'Gagal';
            header('location:keluar');
        }
    } else {
        // Kalau stoknya kurang
        echo '
            <script>
                alert("Stok bbm untuk kendaraan jenis ini tidak mencukupi!");
                window.location.href="keluar";
            </script>
            ';
    }
}

// Mengubah data keluar
if (isset($_POST['update'])) {
    $idb = $_POST['idbbm'];
    $idk = $_POST['idk'];
    $nopol = $_POST['nopole'];
    $jk = $_POST['jen_kendaraan'];
    $nama = $_POST['nama_peg'];
    $nip = $_POST['no_induk_peg'];
    $jab = $_POST['jabatan'];
    $qty = $_POST['jumlah'];

    $lihatstok = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stok'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['jumlah'];

    if ($qty > $qtyskrg) { //mengurangi stok jika kuantitas barang yg diketik lebih besar dari data sebelumnya
        $selisih = $qty - $qtyskrg;
        $kurangin = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok_bbm set stok='$kurangin' where idbbm='$idb' ");
        $updatenya = mysqli_query($conn, "update keluar set jumlah='$qty' where idkeluar='$idk' ");
        if ($kurangistoknya && $updatenya) {
            header('location:keluar');
        } else {
            echo 'Gagal';
            header('location:keluar');
        }
    } elseif ($qty < $qtyskrg) { //menambah stok jika kuantitas barang yg diketik lebih kecil dari data sebelumnya
        $selisih = $qtyskrg - $qty;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok_bbm set stok='$kurangin' where idbbm='$idb' ");
        $updatenya = mysqli_query($conn, "update keluar set jumlah='$qty' where idkeluar='$idk' ");
        if ($kurangistoknya && $updatenya) {
            header('location:keluar');
        } else {
            echo 'Gagal';
            header('location:keluar');
        }
    } elseif ($qty = $qtyskrg) {
        $updatenya = mysqli_query($conn, "update keluar set jumlah='$qty' where idkeluar='$idk' ");
        if ($updatenya) {
            header('location:keluar');
        } else {
            echo 'Gagal';
            header('location:keluar');
        }
    }
}

// Menghapus data keluar
if (isset($_POST['hapus'])) {
    $idb = $_POST['idbbm'];
    $idk = $_POST['idkeluar'];
    $qty = $_POST['jumlah'];

    $getdatastok = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb' ");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "update stok_bbm set stok = '$selisih' where idbbm = '$idb' "); //menambah kuantitas yang ada di stok ketika data dihapus
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar = '$idk' "); //perintah menghapus data dari tabel di database

    if ($update && $hapusdata) {
        header('location:keluar');
    } else {
        echo 'Gagal';
        header('location:keluar');
    }
}
