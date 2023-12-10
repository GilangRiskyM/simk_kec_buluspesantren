<?php
date_default_timezone_set('Asia/Jakarta');
// Menambah barang masuk dan menambah stok bbm
if (isset($_POST['tambah'])) {
    $jk = $_POST['jk'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok_bbm where idbbm='$jk'"); //perintah untuk mengambil data dari tabel stok
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);
    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdgjumlah = $stoksekarang + $jumlah; //untuk menambah stok yg ada di tabel stok

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbbm, keterangan, jumlah) values('$jk','$keterangan','$jumlah')"); //perintah untuk menambah data stok yg masuk di tabel masuk
    $updatestokmasuk = mysqli_query($conn, "update stok_bbm set stok='$tambahstoksekarangdgjumlah' where idbbm='$jk'"); //perintah untuk menambah stok yg ada di tabel stok
    if ($addtomasuk) {
        header('location:masuk');
    } else {
        echo 'Gagal';
        header('location:masuk');
    }
}

// Mengubah data stok bbm yg masuk
if (isset($_POST['update'])) {
    $idb = $_POST['idbbm'];
    $idm = $_POST['idmasuk'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $lihatstok = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stok'];

    $sql = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $data = mysqli_fetch_array($sql);
    $jmlskrg = $data['jumlah'];

    if ($jumlah > $jmlskrg) { //menambah stok jika kuantitas barang yg diketik lebih besar dari data sebelumnya
        $selisih = $jumlah - $jmlskrg;
        $tambah = $stokskrg + $selisih;
        $tambahstoknya = mysqli_query($conn, "update stok_bbm set stok='$tambah' where idbbm='$idb' ");
        $update = mysqli_query($conn, "update masuk set keterangan='$keterangan', jumlah='$jumlah' where idmasuk='$idm' ");
        if ($tambahstoknya && $update) {
            header('location:masuk');
        } else {
            echo 'Gagal';
            header('location:masuk');
        }
    } elseif ($jumlah < $jmlskrg) { //mengurangi stok jika kuantitas barang yg diketik lebih kecil dari data sebelumnya
        $selisih = $jmlskrg - $jumlah;
        $kurang = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok_bbm set stok='$kurang' where idbbm='$idb' ");
        $update = mysqli_query($conn, "update masuk set keterangan='$keterangan', jumlah='$jumlah' where idmasuk='$idm' ");
        if ($kurangistoknya && $update) {
            header('location:masuk');
        } else {
            echo 'Gagal';
            header('location:masuk');
        }
    } elseif ($jumlah = $jmlskrg) {
        $update = mysqli_query($conn, "update masuk set keterangan='$keterangan', jumlah='$jumlah' where idmasuk='$idm' ");
        if ($update) {
            header('location:masuk');
        }
    }
}

// Menghapus data bbm tambahan masuk
if (isset($_POST['hapus'])) {
    $idb = $_POST['idbbm'];
    $idm = $_POST['idmasuk'];
    $jumlah = $_POST['jumlah'];

    $getdatastok = mysqli_query($conn, "select * from stok_bbm where idbbm='$idb' ");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    $selisih = $stok - $jumlah;

    $update = mysqli_query($conn, "update stok_bbm set stok='$selisih' where idbbm='$idb' "); //mengurangi kuantitas yang ada di stok ketika data dihapus
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm' "); //perintah menghapus data dari tabel di database

    if ($update && $hapusdata) {
        header('location:masuk');
    } else {
        echo 'Gagal';
        header('location:masuk');
    }
}
