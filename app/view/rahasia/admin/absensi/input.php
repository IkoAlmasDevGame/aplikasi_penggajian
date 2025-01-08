<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Input Data Absensi"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['akses_jabatan'] == 'admin') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../../config/config.php"); ?>
        <?php require_once("../../../../library/rupiah.php"); ?>
        <?php require_once("../../../../library/tanggal.php"); ?>
        <?php
        if (isset($_GET['kry'])) {
            $kry = htmlspecialchars($_GET['kry']);
            $abs = htmlspecialchars($_GET['abs']);
            # karyawan
            $sqlk = "SELECT * FROM karyawan WHERE karyawan_id='$kry'";
            $ressk = $koneksi->query($sqlk);
            $datak = mysqli_fetch_array($ressk);

            # absensi
            $sqla = "SELECT * FROM abs WHERE abs_id='$abs'";
            $ressa = $koneksi->query($sqla);
            $dataa = mysqli_fetch_array($ressa);
            $bln = $dataa['abs_bln'];
            $th = $dataa['abs_th'];
            $bl = $dataa['abs_bl'];

            $sqlcek = "SELECT absensi.*,karyawan.*,abs.* FROM absensi,karyawan,abs WHERE absensi.karyawan_id = karyawan.karyawan_id AND absensi.abs_id = abs.abs_id
			AND abs.abs_id='$abs' AND karyawan.karyawan_id='$kry'";
            $resscek = $koneksi->query($sqlcek);
            $rowscek = mysqli_num_rows($resscek);
            $datacek = mysqli_fetch_array($resscek);
            if ($rowscek > 0) {
                $h = $datacek['absensi_h'];
                $s = $datacek['absensi_s'];
                $i = $datacek['absensi_i'];
                $a = $datacek['absensi_a'];
            } else {
                $h = "0";
                $s = "0";
                $i = "0";
                $a = "0";
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
                    <a href="?page=absensi" aria-current="page"
                        class="text-decoration-none text-primary"><?php echo "Data Absensi"; ?></a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?aksi=lihat-absensi&abs=<?= $_GET['abs'] ?>" aria-current="page"
                        class="text-decoration-none text-primary"><?php echo $pagedesc ?></a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?aksi=input-absensi&kry=<?= $_GET['kry'] ?>" aria-current="page"
                        class="text-decoration-none active"><?php echo $pagedesc ?></a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="p-1 p-lg-1 m-1 m-lg-1">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-9 col-md-9 mb-3">
                                <div class="card-header py-2">
                                    <h6 class="m-0 fw-bold text-primary">
                                        <a href="?aksi=lihat-absensi&abs=<?php echo $abs; ?>">
                                            <i class="fa fa-arrow-circle-left"></i>
                                        </a> Input Absensi
                                        <?php echo $bln; ?>-<?php echo $th; ?>
                                    </h6>
                                </div>
                                <div class="card-body my-2">
                                    <form action="?aksi=absensi-TambahUpdate" class="form-group" method="post"
                                        enctype="multipart/form-data">
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">ID Karyawan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="text" name="id" id="id" class="form-control"
                                                        placeholder="ID Karyawan"
                                                        value="<?php echo $datak['karyawan_id']; ?>" readonly>
                                                    <input type="hidden" name="abs" class="form-control"
                                                        value="<?php echo $abs; ?>" readonly>
                                                    <input type="hidden" name="rows" class="form-control"
                                                        value="<?php echo $rowscek; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">Nama</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="text" name="nama" class="form-control"
                                                        placeholder="Nama"
                                                        value="<?php echo $datak['karyawan_nama']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">Hadir</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="number" name="h" class="form-control"
                                                        placeholder="Nama" value="<?php echo $h; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">Sakit</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="number" name="s" class="form-control"
                                                        placeholder="Nama" value="<?php echo $s; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">Izin</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="number" name="i" class="form-control"
                                                        placeholder="Nama" value="<?php echo $i; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm-5 col-md-5 fs-4 display-4"
                                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                                    <label for="" class="label label-default">Alfa</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-5 col-md-5">
                                                    <input type="number" name="a" class="form-control"
                                                        placeholder="Nama" value="<?php echo $a; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer my-1">
                                            <div class="text-start">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-fw fa-1x fa-save"></i>
                                                    Update
                                                </button>
                                            </div>
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
    <?php require_once("../ui/footer.php") ?>