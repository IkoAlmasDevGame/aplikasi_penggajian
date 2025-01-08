<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Data Gaji Reject"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php error_reporting(0); ?>
        <?php
        if (isset($_GET['abs'])) {
            $abs = htmlspecialchars($_GET['abs']);
            $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
            $ressa = mysqli_query($koneksi, $sqla);
            $dataa = mysqli_fetch_array($ressa);
            $bln = $dataa['abs_bln'];
            $th = $dataa['abs_th'];
            $bl = $dataa['abs_bl'];
        }
        ?>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
        <style type="text/css">
        .fst-times {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 500;
        }

        .tables {
            width: 1285px;
        }

        @media (max-width:1285px) {
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
                        <a href="?page=gaji" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Gaji"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=gaji_rej&abs=<?= $_GET['abs'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="card shadow mb-3">
                                <div class="card-header py-2">
                                    <h4 class="card-title fst-times fs-4 display-4">
                                        <?php echo $pagedesc; ?>
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <div class="card-tools my-2">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <a href="?page=gaji"><i class="fa fa-arrow-circle-left"></i>
                                            </a> Data Gaji Rejected Periode
                                            <?php echo $bln; ?>-<?php echo $th; ?>
                                        </h6>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="table-responsive">
                                            <div class="tables">
                                                <table class="table table-striped-columns table-bordered"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal">No</th>
                                                            <th class="text-center fw-normal">ID Karyawan</th>
                                                            <th class="text-center fw-normal">Nama Karyawan</th>
                                                            <th class="text-center fw-normal">Gaji Pokok</th>
                                                            <th class="text-center fw-normal">Tunjangan</th>
                                                            <th class="text-center fw-normal">Lembur</th>
                                                            <th class="text-center fw-normal">Potongan</th>
                                                            <th class="text-center fw-normal">Gaji Bersih</th>
                                                            <th class="text-center fw-normal">Status</th>
                                                            <th class="text-center fw-normal">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php $ress = $paycash->reject($abs); ?>
                                                        <?php foreach ($ress as $data): ?>
                                                        <?php
                                                        $idkry = $data['karyawan_id'];
                                                        $gapok = $data['bagian_gaji'];
                                                        $galem = $data['bagian_lembur'];
                                                        $num = $data['gaj_no'];

                                                        $jamlembur = 0;
                                                        $tjg = 0;
                                                        $pot = 0;
                                                        $ttllembur = 0;;

                                                        //cari lembur
                                                        $sqllem = "SELECT * FROM lembur WHERE karyawan_id='$idkry' AND lembur_bl='$bl' AND lembur_th='$th'";
                                                        $resslem = mysqli_query($koneksi, $sqllem);
                                                        while ($datalem = mysqli_fetch_array($resslem)) {
                                                            $jamlembur += $datalem['lembur_jam'];
                                                        }
                                                        $ttllembur = $jamlembur * $galem;

                                                        //cari tunjangan
                                                        $sqltjg = "SELECT * FROM tunjangan WHERE karyawan_id='$idkry' AND tjg_bl='$bl' AND tjg_th='$th'";
                                                        $resstjg = mysqli_query($koneksi, $sqltjg);
                                                        while ($datatjg = mysqli_fetch_array($resstjg)) {
                                                            $tjg += $datatjg['tjg_jml'];
                                                        }

                                                        //cari potongan
                                                        $sqlpot = "SELECT * FROM potongan WHERE karyawan_id='$idkry' AND pot_bl='$bl' AND pot_th='$th'";
                                                        $resspot = mysqli_query($koneksi, $sqlpot);
                                                        while ($datapot = mysqli_fetch_array($resspot)) {
                                                            $pot += $datapot['pot_jml'];
                                                        }

                                                        $masukan = $gapok + $ttllembur + $tjg;
                                                        $keluaran = $pot;
                                                        $bersih = $masukan - $keluaran;

                                                        //cari pengajuan
                                                        $sqlc = "SELECT * FROM gaji_karyawan WHERE karyawan_id='$idkry' AND abs_id='$abs'";
                                                        $ressc = mysqli_query($koneksi, $sqlc);
                                                        $rowsc = mysqli_num_rows($ressc);
                                                        $datac = mysqli_fetch_array($ressc);
                                                        if ($rowsc > 0) {
                                                            $st = $datac['gaj_stt'];
                                                        } else {
                                                            $st = "Belum Diajukan";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $data['karyawan_id'] ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $data['karyawan_nama'] ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo format_rupiah($gapok) ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo format_rupiah($tjg) ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo format_rupiah($ttllembur) ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo format_rupiah($pot) ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo format_rupiah($bersih) ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $st ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <a aria-current="page"
                                                                    href="?aksi=gaji-input&kry=<?= $data['karyawan_id'] ?>&abs=<?= $abs ?>&no=<?= $num ?>">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-warning">
                                                                        <i class="fas fa-fw fa-1x fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
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
        <?php require_once("../ui/footer.php"); ?>