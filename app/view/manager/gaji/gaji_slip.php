<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($_SESSION['user_akses'] == "Manager") { ?>
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
            $data = mysqli_fetch_array($ress);

            // deskripsi halaman
            $pagedesc = "Slip Gaji Karyawan Periode " . $no . " Periode " . $bln . "-" . $th;
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
                    Slip Gaji Karyawan Periode <?php echo $bln; ?>-<?php echo $th; ?>
                </h5>
                <br>
                <table class="table table-borderless" width="50%">
                    <tbody>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">No. Slip</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo $data['gaj_no']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">ID Karyawan</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo $data['karyawan_id']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">Nama </td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo $data['karyawan_nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">Bagian </td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo $data['bagian_nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">Metode Pembayaran </td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo $data['gaj_pay']; ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="25%">Dibayarkan Tanggal </td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="63%"><?php echo format_tanggal($data['gaj_tgl']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%" colspan=4>
                                <hr />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless" width="50%">
                    <tbody>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="5%">
                                <h5 class="text-left"><b>Pendapatan</b></h5>
                            </td>
                            <td class="text-left" colspan=3>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-left" width="5%">&nbsp;</td>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="20%">Gaji Pokok</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="83%"><?php echo format_rupiah($data['gaj_pok']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="5%">&nbsp;</td>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="20%">Lembur</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="83%"><?php echo format_rupiah($data['gaj_lembur']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="5%">&nbsp;</td>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="20%">Tunjangan</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="83%"><?php echo format_rupiah($data['gaj_tjg']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-left" width="5%">&nbsp;</td>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="20%"><b>Total Pendapatan</b></td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="83%">
                                <b><?php echo format_rupiah($data['gaj_pok'] + $data['gaj_lembur'] + $data['gaj_tjg']); ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table table-borderless" width="50%">
                    <tbody>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="5%">
                                <h5 class="text-left"><b>Pengurangan</b></h5>
                            </td>
                            <td class="text-left" colspan=3>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-left" width="5%">&nbsp;</td>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="20%">Potongan</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="83%"><?php echo format_rupiah($data['gaj_pot']); ?></td>
                        </tr>
                    </tbody>
                </table>

                <br />
                <table class="table table-borderless" width="50%">
                    <tbody>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="33%" colspan=2>
                                <h5 class="text-left"><b>Penghasilan Bersih</b></h5>
                            </td>
                            <td class="text-left" width="2%">&nbsp;</td>
                            <td class="text-left" width="53%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%">&nbsp;</td>
                            <td class="text-left" width="33%">Total Pendapatan - Total Pengurangan</td>
                            <td class="text-left" width="2%">:</td>
                            <td class="text-left" width="53%">
                                <b><?php echo format_rupiah($data['gaj_bersih']); ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" width="10%" colspan=4>
                                <hr />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br />

            </div>
        </div>
    </section>
    <?php require_once("../ui/footer.php"); ?>