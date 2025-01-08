<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Data Gaji Approve"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php error_reporting(0); ?>
        <?php
        $kry = $_GET['kry'];
        $abs = $_GET['abs'];
        $no  = $_GET['no'];

        $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
        $ressa = mysqli_query($koneksi, $sqla);
        $dataa = mysqli_fetch_array($ressa);
        $bln = $dataa['abs_bln'];
        $th = $dataa['abs_th'];
        $bl = $dataa['abs_bl'];

        $sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
			WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
			AND gaji_karyawan.gaj_no='$no'";
        $ress = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_array($ress);

        // deskripsi halaman
        $pagedesc = "Slip Gaji Karyawan No. " . $no . " Periode " . $bln . "-" . $th;
        $pagetitle = str_replace(" ", "_", $pagedesc);
        ?>
        <title><?php echo $pagetitle; ?></title>
    <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
    <?php } ?>
</head>

<body onload="window.print();">
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered">
                    <tbody></tbody>
                </table>
                <hr class="border border-top">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <h5 class="text-center">
                    Slip Gaji Karyawan Periode <?php echo $bln; ?>-<?php echo $th; ?>
                </h5>
                <br>
                <table class="table table-borderless" width="50%">
                    <tbody></tbody>
                </table>
                <table class="table table-borderless" width="50%">
                    <tbody>
                    </tbody>
                </table>
                <br>
                <table class="table table-borderless" width="50%">
                    <tbody>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </section>
    <?php require_once("../ui/footer.php") ?>