<?php
include "koneksi.php";

$id = $_POST['id'];
$modul = $_POST['modul'];
$hasil = '';

if ($modul == 'Tambahpe') {
    $sql = mysqli_query($conn, "SELECT * FROM kendaraan where no_polisi='$id' order by j_kendaraan ASC");
    while ($dt = mysqli_fetch_array($sql)) {
        $hasil .= '<div class="input-group mb-2">
        <span class="input-group-text" style="width: 135px;">
            <center>Jenis Kendaraan</center>
        </span>
        <input type="text" class="form-control" name="jen_kendaraan" value="' . $dt['j_kendaraan'] . '" readonly>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text" style="width: 135px;">
            <center>Nama Pegawai</center>
        </span>
        <input type="text" class="form-control" name="nama_peg" value="' . $dt['nama_pegawai'] . '" readonly>
    </div>
    <div class="input-group mb-2">
        <span class="input-group-text" style="width: 135px;">
            <center>NIP</center>
        </span>
        <input type="num" class="form-control" name="no_induk_peg" value="' . $dt['nip'] . '" readonly>
    </div><div class="input-group mb-2">
    <span class="input-group-text" style="width: 135px;">
        <center>Jabatan</center>
    </span>
    <input type="num" class="form-control" name="jabatan" value="' . $dt['jab'] . '" readonly>
</div>';
    }

    echo $hasil;
}
