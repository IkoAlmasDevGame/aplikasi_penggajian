<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Data Gaji Input"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['akses_jabatan'] == 'manager') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../../config/config.php"); ?>
        <?php require_once("../../../../library/rupiah.php"); ?>
        <?php require_once("../../../../library/tanggal.php"); ?>
        <?php error_reporting(0); ?>
        <?php
        if (isset($_GET['kry'])) {
            $kry = $_GET['kry'];
            $abs = $_GET['abs'];
            $no = $_GET['no'];

            $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
            $ressa = mysqli_query($koneksi, $sqla);
            $dataa = mysqli_fetch_array($ressa);
            $bln = $dataa['abs_bln'];
            $th = $dataa['abs_th'];
            $bl = $dataa['abs_bl'];

            $sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian WHERE karyawan.bagian_id = bagian.bagian_id AND gaji_karyawan.karyawan_id = karyawan.karyawan_id 
				AND gaji_karyawan.gaj_no='$no'";
            $ress = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($ress)) {
                $gapok = $data['bagian_gaji'];
                $galem = $data['bagian_lembur'];
                $nama = $data['karyawan_nama'];
                $kry = $data['karyawan_id'];
                $pay = $data['gaj_pay'];
                $ket = $data['gaj_ket'];

                $jamlembur = 0;
                $tjg = 0;
                $pot = 0;
                $ttllembur = 0;;

                //cari lembur
                $sqllem = "SELECT * FROM lembur WHERE lembur_bl='$bl' AND lembur_th='$th' AND karyawan_id='$kry'";
                $resslem = mysqli_query($koneksi, $sqllem);
                while ($datalem = mysqli_fetch_array($resslem)) {
                    $jamlembur += $datalem['lembur_jam'];
                }
                $ttllembur = $jamlembur * $galem;

                //cari tunjangan
                $sqltjg = "SELECT * FROM tunjangan WHERE tjg_bl='$bl' AND tjg_th='$th' AND karyawan_id='$kry'";
                $resstjg = mysqli_query($koneksi, $sqltjg);
                while ($datatjg = mysqli_fetch_array($resstjg)) {
                    $tjg += $datatjg['tjg_jml'];
                }

                //cari potongan
                $sqlpot = "SELECT * FROM potongan WHERE pot_bl='$bl' AND pot_th='$th' AND karyawan_id='$kry'";
                $resspot = mysqli_query($koneksi, $sqlpot);
                while ($datapot = mysqli_fetch_array($resspot)) {
                    $pot += $datapot['pot_jml'];
                }
                $masukan = $gapok + $ttllembur + $tjg;
                $keluaran = $pot;
                $bersih = $masukan - $keluaran;
            }
        }

        ?>
    <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
    <?php } ?>
    <script type="text/javascript">
        function checkIdAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_idavailability.php",
                data: 'id=' + $("#id").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
    <style type="text/css">
        .fst-times {
            font-family: 'Times New Roman';
            font-weight: 500;
            font-style: normal;
            font-variant: normal;
        }
    </style>
</head>

<body>
    <?php require_once("../ui/sidebar.php"); ?>
    <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
        <div class="panel-heading py-4 container-fluid">
            <h4 class="panel-title display-4 fs-3 fst-times">
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
                    <a href="?aksi=gaji-input&kry=<?= $_GET['kry'] ?>&abs=<?= $_GET['abs'] ?>&no=<?= $_GET['no'] ?>"
                        aria-current="page" class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="p-1 p-lg-1 m-1 m-lg-1">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-8 col-md-8 shadow mb-3">
                                <div class="card-header py-2">
                                    <h4 class="card-title fs-4 display-4"
                                        style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                        <?php echo "Update " . $pagedesc . " Karyawan" ?>
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <form action="?aksi=update-gaji" method="post" enctype="multipart/form-data"
                                        class="form-group">
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">ID Karyawan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="id" id="id" class="form-control"
                                                        placeholder="ID Karyawan" value="<?php echo $kry; ?>"
                                                        readonly>
                                                    <input type="hidden" name="no" class="form-control"
                                                        value="<?php echo $no; ?>" readonly>
                                                    <input type="hidden" name="abs" class="form-control"
                                                        value="<?php echo $abs; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Nama Karyawan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="nama" class="form-control"
                                                        placeholder="Nama" value="<?php echo $nama; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Gaji Pokok</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="gapok1" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo format_rupiah($gapok); ?>" readonly>
                                                    <input type="hidden" name="gapok" class="form-control"
                                                        placeholder="Nama" value="<?php echo $gapok; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Tunjangan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="tjg1" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo format_rupiah($tjg); ?>" readonly>
                                                    <input type="hidden" name="tjg" class="form-control"
                                                        placeholder="Nama" value="<?php echo $tjg; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Lembur</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="lembur1" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo format_rupiah($ttllembur); ?>" readonly>
                                                    <input type="hidden" name="lembur" class="form-control"
                                                        placeholder="Nama" value="<?php echo $ttllembur; ?>"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Potongan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="pot1" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo format_rupiah($pot); ?>" readonly>
                                                    <input type="hidden" name="pot" class="form-control"
                                                        placeholder="Nama" value="<?php echo $pot; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Gaji Bersih</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="bersih1" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo format_rupiah($bersih); ?>" readonly>
                                                    <input type="hidden" name="bersih" class="form-control"
                                                        placeholder="Nama" value="<?php echo $bersih; ?>" readonly>
                                                    <input type="hidden" name="bln" class="form-control"
                                                        placeholder="Nama" value="<?php echo $bln; ?>" readonly>
                                                    <input type="hidden" name="th" class="form-control"
                                                        placeholder="Nama" value="<?php echo $th; ?>" readonly>
                                                    <input type="hidden" name="bl" class="form-control"
                                                        placeholder="Nama" value="<?php echo $bl; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Metode
                                                        Pembayaran</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <select class="form-control" name="via" required>
                                                        <option value="<?php echo $pay; ?>" selected>
                                                            <?php echo $pay; ?></option>";
                                                        <option value="Cash">Cash</option>";
                                                        <option value="Transfer">Transfer</option>";
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Keterangan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <textarea name="ket"
                                                        class="form-control"><?php echo $ket; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 display-4 fs-4 fst-times">
                                                    <label for="" class="label label-default">Approval</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <select class="form-control" name="app" required>
                                                        <option value="" selected>=== Pilih Approval ==</option>";
                                                        <option value="Approved">Approved</option>";
                                                        <option value="Rejected">Rejected</option>";
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save fa-1x fa-fw"></i>
                                                Update Data
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php"); ?>