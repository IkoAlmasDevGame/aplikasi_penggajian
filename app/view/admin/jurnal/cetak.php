<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
        <?php $bln = $_GET['bl']; ?>
        <?php $th = $_GET['th']; ?>
        <?php if (!$bln == 'all'): ?>
            <?php
            $pagedesc = "Semua Data Jurnal";
            $periode = "- Semua";
            $sql = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl ASC";
            $ress = mysqli_query($koneksi, $sql);
            ?>
        <?php else: ?>
            <?php
            if ($bln == "01") {
                $bl = "Januari";
            } else if ($bln == "02") {
                $bl = "Februari";
            } else if ($bln == "03") {
                $bl = "Maret";
            } else if ($bln == "04") {
                $bl = "April";
            } else if ($bln == "05") {
                $bl = "Mei";
            } else if ($bln == "06") {
                $bl = "Juni";
            } else if ($bln == "07") {
                $bl = "Juli";
            } else if ($bln == "08") {
                $bl = "Agustus";
            } else if ($bln == "09") {
                $bl = "September";
            } else if ($bln == "10") {
                $bl = "Oktober";
            } else if ($bln == "11") {
                $bl = "November";
            } else {
                $bl = "Desember";
            }
            $pagedesc = "Data Jurnal Periode " . $bl . "-" . $th;
            $periode = "Periode " . $bl . " " . $th;
            $sql = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode!='0' AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$th' ORDER BY jurnal.jurnal_tgl ASC";
            $ress = mysqli_query($koneksi, $sql);
            // deskripsi halaman
            ?>
            <?php $pagetitle = str_replace(" ", "_", $pagedesc); ?>
        <?php endif; ?>
    <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
    <?php } ?>
    <title><?php echo $pagetitle ?></title>
</head>

<body onload="window.print();">
    <section class="content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="20%" class="text-start">
                                <img src="../../../../assets/admin/user_logo.png" width="70" alt="logo">
                            </td>
                            <td class="text-center" width="60%">
                                <b>APLIKASI PENGGAJIAN KARYAWAN</b><br>
                                Jl. Jend. Sudirman Km. 31 Kranji Bekasi<br>
                                Telp: 021-12345678<br>
                            <td class="text-right" width="20%">
                            </td>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="border border-dark border-top">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="content-header">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <h5 class="text-center">Data Jurnal <?php echo $periode; ?></h5>
                    <br>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="5%">
                                    <center>No</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>No. Trx</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>No. Reff</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>Akun</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>Tanggal</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>Keterangan</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>Beban Gaji (D)</center>
                                </th>
                                <th style="font-size: 12px; font-family: 'Times New Roman';" width="8%">
                                    <center>Hutang Gaji (K)</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php while ($data = mysqli_fetch_array($ress)) { ?>
                                <tr>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo $n; ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo $data['jurnal_trx']; ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo $data['jurnal_reff']; ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo $data['akun_kode']; ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo format_tanggal($data['jurnal_tgl']); ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo $data['jurnal_ket']; ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo format_rupiah($data['jurnal_jml']); ?></center>
                                    </td>
                                    <td style="font-size: 12px; font-family: 'Times New Roman';">
                                        <center><?php echo format_rupiah($data['jurnal_jml']); ?></center>
                                    </td>
                                </tr>
                                <?php $n++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("../ui/footer.php"); ?>