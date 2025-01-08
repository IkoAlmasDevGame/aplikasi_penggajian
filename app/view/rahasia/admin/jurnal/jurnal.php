<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Data Jurnal"; ?>
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
    <style type="text/css">
        .tables {
            width: 980px;
        }

        @media (width: 980px) {
            .tables {
                max-width: 100%;
            }
        }
    </style>
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
                    <a href="?page=jurnal" aria-current="page"
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
                                <form action="?page=jurnal" method="post" class="form-group">
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
                                        <a href="?aksi=tambah-jurnal" aria-current="page">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fas fa-plus fa-fw fa-1x"></i>
                                                Tambah Data Jurnal
                                            </button>
                                        </a>
                                        <a href="?page=jurnal" aria-current="page">
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
                                            $sql = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode=akun.akun_kode 
                                                AND jurnal.jurnal_bl='$bln' AND jurnal.jurnal_th='$thn' AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl DESC";
                                            $ress = $koneksi->query($sql);
                                            ?>
                                            <h6 class="fw-bold text-primary">
                                                Data Jurnal Periode
                                                <?php echo $bl; ?>-<?php echo $thn; ?>
                                                <a href="?page=jurnal_cetak&bl=<?php echo $bln; ?>&th=<?php echo $thn; ?>"
                                                    target="_blank" class="btn btn-info btn-sm">Cetak</a>
                                                <div class="my-1"></div>
                                            </h6>
                                            <div class="tables">
                                                <table class="table table-striped-columns" id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal">No</th>
                                                            <th class="text-center fw-normal">No. Trx</th>
                                                            <th class="text-center fw-normal">No. Reff</th>
                                                            <th class="text-center fw-normal">Tanggal</th>
                                                            <th class="text-center fw-normal">Akun</th>
                                                            <th class="text-center fw-normal">
                                                                Beban Gaji (D)
                                                            </th>
                                                            <th class="text-center fw-normal">
                                                                Hutang Gaji (K)
                                                            </th>
                                                            <th class="text-center fw-normal">
                                                                Keterangan
                                                            </th>
                                                            <th class="text-center fw-normal">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($ress as $data): ?>
                                                            <tr>
                                                                <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['jurnal_trx']; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['jurnal_reff']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_tanggal($data['jurnal_tgl']); ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['akun_nama']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_rupiah($data['jurnal_jml']); ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_rupiah($data['jurnal_jml']); ?>
                                                                </td>
                                                                <td class="text-nowarp fw-normal">
                                                                    <?php echo $data['jurnal_ket']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <a href="?aksi=edit-jurnal&trx=<?= $data['jurnal_trx'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-edit fa-fw fa-1x"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="?aksi=jurnal-hapus&trx=<?= $data['jurnal_trx'] ?>"
                                                                        aria-current="page"
                                                                        onclick="return confirm('Apakah anda yakin akan menghapus jurnal <?php echo $data['jurnal_trx']; ?>?');">
                                                                        <button type="button" class="btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash fa-fw fa-1x"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <h6 class="fw-bold text-primary">
                                                    Semua Data Jurnal
                                                    <a href="?page=jurnal_cetak&bl=all&th=all" target="_blank"
                                                        class="btn btn-info btn-sm">Cetak</a>
                                                    <div class="my-1"></div>
                                                </h6>
                                                <table class="table table-striped-columns" id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal">No</th>
                                                            <th class="text-center fw-normal">No. Trx</th>
                                                            <th class="text-center fw-normal">No. Reff</th>
                                                            <th class="text-center fw-normal">Tanggal</th>
                                                            <th class="text-center fw-normal">Akun</th>
                                                            <th class="text-center fw-normal">
                                                                Beban Gaji (D)
                                                            </th>
                                                            <th class="text-center fw-normal">
                                                                Hutang Gaji (K)
                                                            </th>
                                                            <th class="text-center fw-normal">
                                                                Keterangan
                                                            </th>
                                                            <th class="text-center fw-normal">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php $ress = $jornal->jurnal(); ?>
                                                        <?php foreach ($ress as $data): ?>
                                                            <tr>
                                                                <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['jurnal_trx']; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['jurnal_reff']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_tanggal($data['jurnal_tgl']); ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $data['akun_nama']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_rupiah($data['jurnal_jml']); ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo format_rupiah($data['jurnal_jml']); ?>
                                                                </td>
                                                                <td class="text-nowrap fw-normal">
                                                                    <?php echo $data['jurnal_ket']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <a href="?aksi=edit-jurnal&trx=<?= $data['jurnal_trx'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-edit fa-fw fa-1x"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="?aksi=jurnal-hapus&trx=<?= $data['jurnal_trx'] ?>"
                                                                        aria-current="page"
                                                                        onclick="return confirm('Apakah anda yakin akan menghapus jurnal <?php echo $data['jurnal_trx']; ?>?');">
                                                                        <button type="button" class="btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash fa-fw fa-1x"></i>
                                                                        </button>
                                                                    </a>
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