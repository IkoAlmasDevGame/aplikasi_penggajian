<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Data Jurnal Gaji"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'admin') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../../config/config.php"); ?>
        <?php require_once("../../../../library/rupiah.php"); ?>
        <?php require_once("../../../../library/tanggal.php"); ?>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
            <div class="panel-heading py-4 container-fluid">
                <h4 class="panel-title display-4 fs-3"
                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                    <?php echo $pagedesc ?>
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=jurnal_gaji" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h4 class="card-title display-4 fs-3"
                                        style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                        <?php echo $pagedesc ?>
                                    </h4>
                                    <form action="?page=jurnal_gaji" method="post" class="form-group">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-4">Bulan</label>
                                            <label class="col-form-label col-sm-4">Tahun</label>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <select class="form-control" name="bln" required>
                                                    <option value="" selected>== Pilih Bulan ==</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="thn" required>
                                                    <option value="" selected>== Pilih Tahun ==</option>
                                                    <?php
                                                $ynow = date('Y');
                                                for ($x = $ynow; $x >= 2010; $x--) {
                                                ?>
                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="submit" name="submit" value="Lihat"
                                                    class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body my-2">
                                    <div class="card-tools">
                                        <div class="text-start">
                                            <a href="?page=jurnal_gaji" aria-current="page">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fas fa-refresh fa-fw fa-1x"></i>
                                                    Muat Ulang Halaman
                                                </button>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-end flex-wrap">
                                            <div class="col-sm-4 col-md-4 text-center">
                                                <div class="rounded-2 bg-info py-2 text-light fs-5 fw-bold">
                                                    <marquee behavior="scroll" scrollamount="15" direction="left">
                                                        <?php echo salam() . ", " . $_SESSION['nama'] ?>
                                                    </marquee>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-1">
                                        <div class="table-responsive">
                                            <div class="container-fluid">
                                                <?php if (isset($_POST['submit'])): ?>
                                                <?php
                                                $no = 0;
                                                $bln = $_POST['bln'];
                                                $thn = $_POST['thn'];
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
                                                $sql = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode = akun.akun_kode AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$thn' 
                                                AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl DESC";
                                                $ress = $koneksi->query($sql);
                                                ?>
                                                <h6 class="m-1 fw-bold text-primary">Jurnal Gaji Periode
                                                    <?php echo $bl; ?>-<?php echo $thn; ?>
                                                </h6>
                                                <div class="my-1"></div>
                                                <table class="table table-striped-columns table-bordered"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="fw-normal text-center" width="1%">No</th>
                                                            <th class="fw-normal text-center" width="10%">No. Trx</th>
                                                            <th class="fw-normal text-center" width="10%">No. Reff</th>
                                                            <th class="fw-normal text-center" width="10%">Tanggal</th>
                                                            <th class="fw-normal text-nowrap" width="10%">Akun</th>
                                                            <th class="fw-normal text-center" width="10%">
                                                                Hutang Gaji (D)</th>
                                                            <th class="fw-normal text-center" width="10%">KAS (K)</th>
                                                            <th class="fw-normal text-nowrap" width="10%">
                                                                Keterangan
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $n = 1; ?>
                                                        <?php foreach ($ress as $row): ?>
                                                        <tr>
                                                            <td class="fw-normal text-center"><?php echo $n; ?></td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo $row['jurnal_trx'] ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo $row['jurnal_reff'] ?>
                                                            </td>
                                                            <td class="fw-normal text-center">
                                                                <?php echo format_tanggal($row['jurnal_tgl']) ?>
                                                            </td>
                                                            <td class="fw-normal text-wrap">
                                                                <?php echo $row['akun_nama'] ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo format_rupiah($row['jurnal_jml']) ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo format_rupiah($row['jurnal_jml']) ?>
                                                            </td>
                                                            <td class="fw-normal text-wrap">
                                                                <?php echo $row['jurnal_ket'] ?>
                                                            </td>
                                                        </tr>
                                                        <?php $n++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php else: ?>
                                                <h6 class="fw-bold text-primary">Semua Jurnal Gaji</h6>
                                                <div class="my-1"></div>
                                                <table class="table table-striped-columns table-bordered"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="fw-normal text-center" width="1%">No</th>
                                                            <th class="fw-normal text-center" width="10%">No. Trx</th>
                                                            <th class="fw-normal text-center" width="10%">No. Reff</th>
                                                            <th class="fw-normal text-center" width="10%">Tanggal</th>
                                                            <th class="fw-normal text-nowrap" width="10%">Akun</th>
                                                            <th class="fw-normal text-center" width="10%">
                                                                Hutang Gaji (D)</th>
                                                            <th class="fw-normal text-center" width="10%">KAS (K)</th>
                                                            <th class="fw-normal text-nowrap" width="10%">Keterangan
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php $SQL = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode = akun.akun_kode AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl DESC"; ?>
                                                        <?php $ress = $koneksi->query($SQL); ?>
                                                        <?php foreach ($ress as $data): ?>
                                                        <tr>
                                                            <td class="fw-normal text-center"><?php echo $i; ?></td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo $data['jurnal_trx'] ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo $data['jurnal_reff'] ?>
                                                            </td>
                                                            <td class="fw-normal text-center">
                                                                <?php echo format_tanggal($data['jurnal_tgl']) ?>
                                                            </td>
                                                            <td class="fw-normal text-wrap">
                                                                <?php echo $data['akun_nama'] ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo format_rupiah($data['jurnal_jml']) ?>
                                                            </td>
                                                            <td class="fw-normal text-start">
                                                                <?php echo format_rupiah($data['jurnal_jml']) ?>
                                                            </td>
                                                            <td class="fw-normal text-wrap">
                                                                <?php echo $data['jurnal_ket'] ?>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>