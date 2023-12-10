<?php
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";

$query = "select * from keluar k, stok_bbm s, kendaraan x where s.idbbm = k.idbbm and x.no_polisi = k.no_pol order by tanggal asc";
$results = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
$allOrders = array();
while ($order = mysqli_fetch_assoc($results)) {
    $allOrders[] = $order;
}
$startDateMessage = '';
$endDate = '';
$noResult = '';
if (isset($_GET["export"])) {
    if (empty($_GET["tglawal"])) {
        $startDateMessage = '<label class="text-danger">Select start date.</label>';
    } else if (empty($_GET["tglakhir"])) {
        $endDate = '<label class="text-danger">Select end date.</label>';
    } else {
        $orderQuery = "select * from keluar where tanggal >= '" . $_GET["tglawal"] . "' AND tanggal <= '" . $_GET["tglakhir"] . "' order by idkeluar ASC";
        $orderResult = mysqli_query($conn, $orderQuery) or die("database error:" . mysqli_error($conn));
        $filterOrders = array();
        while ($order = mysqli_fetch_assoc($orderResult)) {
            $filterOrders[] = $order;
        }
        if (count($filterOrders)) {
            $tglawal = date("Y-m-d", strtotime($_GET['tglawal']));
            $tglakhir = date("Y-m-d", strtotime($_GET['tglakhir']));
            $filename = "Data Pengeluaran BBM " . $tglawal . " Sampai " . $tglakhir . ".xls";

            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment;filename="' . $filename . '";');
            $show_coloumn = true;

            $file = fopen('php://output', 'w');
            $header = "select * from keluar";
            foreach ($filterOrders as $order) {
                $show_coloumn = false;
                foreach ($filterOrders as $order) {
                    if (!$show_coloumn) {
                        //menampilkan nama kolom di baris pertama
                        echo implode("\t", array_keys($order)) . "\n";
                        $show_coloumn = true;
                    }
                    // looping data dari database
                    echo implode("\t", array_values($order)) . "\n";
                }
                exit;
            }
            exit;
        } else {
            $noResult = '<label class="text-danger">Data Kosong</label>';
        }
    }
}
