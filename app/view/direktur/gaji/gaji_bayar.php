<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
        <?php error_reporting(0); ?>
        <?php
        if (isset($_GET['abs'])):
            $abs = $_GET['abs'];

            $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
            $ressa = mysqli_query($koneksi, $sqla);
            $dataa = mysqli_fetch_array($ressa);
            $bln = $dataa['abs_bln'];
            $th = $dataa['abs_th'];
            $bl = $dataa['abs_bl'];

            $sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
			WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
			AND gaji_karyawan.abs_id='$abs' AND gaji_karyawan.gaj_stt='Approved'";
            $ress = $koneksi->query($sql);

            // deskripsi halaman
            $pagedesc = "Rekap Gaji Karyawan Periode " . $no . " Periode " . $bln . "-" . $th;
            $pagetitle = str_replace(" ", "_", $pagedesc);
        endif;
        ?>
        <title><?php echo $pagetitle; ?></title>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
    </head>

    <body onload="window.print()">
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="20%" class="text-start">
                                    <img src="../../../../assets/default/user_logo.png" width="70" alt="logo">
                                </td>
                                <td class="text-center" width="60%">
                                    <b>APLIKASI PENGGAJIAN KARYAWAN</b><br>
                                    Jl. Jend. Sudirman Km. 31 Kranji Bekasi<br>
                                    Telp: 021-12345678<br>
                                <td class="text-end" width="20%">
                            </tr>
                        </tbody>
                    </table>
                    <hr class="border border-top">
                </div>
            </div>
        </section>
        <section class="content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <h5 class="text-center">
                        Rekap Gaji Karyawan Periode <?php echo $bln; ?>-<?php echo $th; ?>
                    </h5>
                    <br>
                    <table class="table table-bordered" id="datatable3">
                        <thead>
                            <tr>
                                <th class="text-center fw-normal">No. </th>
                                <th class="text-center fw-normal">ID Karyawan</th>
                                <th class="text-center fw-normal">Nama</th>
                                <th class="text-center fw-normal">Metode Pembayaran</th>
                                <th class="text-center fw-normal">Tanggal</th>
                                <th class="text-center fw-normal">Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $tot = 0; ?>
                            <?php foreach ($ress as $data): ?>
                            <?php $gaji = $data['gaj_bersih']; ?>
                            <tr>
                                <td class="text-center fw-normal"><?php echo $no; ?></td>
                                <td class="text-center fw-normal"><?php echo $data['karyawan_id'] ?></td>
                                <td class="text-center fw-normal"><?php echo $data['karyawan_nama'] ?></td>
                                <td class="text-center fw-normal"><?php echo $data['gaj_pay'] ?></td>
                                <td class="text-center fw-normal"><?php echo format_tanggal($data['gaj_tgl']) ?></td>
                                <td class="text-center fw-normal"><?php echo format_rupiah($data['gaj_bersih']) ?></td>
                            </tr>
                            <?php $no++; ?>
                            <?php $tot += $gaji; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <th class="text-center fw-normal" colspan="5">
                                Total Pembayaran Gaji
                            </th>
                            <th class="text-center fw-normal"><?php echo format_rupiah($tot); ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
        <?php require_once("../ui/footer.php"); ?>