<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Edit Data Potongan"; ?>
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
                        <a href="?page=potongan" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Potongan" ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=edit-potongan&pot=<?= $_GET['pot'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-7 col-md-7 shadow mb-3">
                                    <div class="card-header py-2">
                                        <h4 class="card-title display-4 fs-4"
                                            style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                            <?php echo $pagedesc ?>
                                    </div>
                                    <div class="card-body my-2">
                                        <?php if (isset($_GET['pot'])): ?>
                                        <?php $SQL = "SELECT potongan.*, karyawan.* FROM potongan, karyawan WHERE potongan.karyawan_id = karyawan.karyawan_id AND potongan.pot_id='$_GET[pot]'"; ?>
                                        <?php $ress = $koneksi->query($SQL); ?>
                                        <?php foreach ($ress as $data): ?>
                                        <form action="?aksi=potongan-edit" method="post" class="form-group">
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 display-4 fs-5">
                                                        <label for=""
                                                            class="label label-default fw-normal">Karyawan</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <select class="form-select" name="kry" required>
                                                            <?php
                                                                $mySql = "SELECT * FROM karyawan WHERE karyawan_status='Aktif' ORDER BY karyawan_id ASC";
                                                                $myQry = mysqli_query($koneksi, $mySql);
                                                                echo "<option value=''>====== Pilih Karyawan ======</option>";
                                                                while ($myData = mysqli_fetch_array($myQry)) {
                                                                    $dataKry = $data['karyawan_id'];
                                                                    if ($myData['karyawan_id'] == $dataKry) {
                                                                        $cek = " selected";
                                                                    } else {
                                                                        $cek = "";
                                                                    }
                                                                    echo "<option value='$myData[karyawan_id]' $cek>$myData[karyawan_id] - $myData[karyawan_nama] </option>";
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="id" class="form-control" placeholder="ID"
                                                        value="<?php echo $data['pot_id'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 display-4 fs-5">
                                                        <label for=""
                                                            class="label label-default fw-normal">Tanggal</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="date" name="tgl" value="<?= $data['pot_tgl'] ?>"
                                                            class="form-control date-formate" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 display-4 fs-5">
                                                        <label for=""
                                                            class="label label-default fw-normal">Jumlah</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="number" name="jml" value="<?= $data['pot_jml'] ?>"
                                                            min="0" class="form-control" placeholder="Jumlah">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 display-4 fs-5">
                                                        <label for=""
                                                            class="label label-default fw-normal">Keterangan</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <textarea name="ket" class="form-control"
                                                            placeholder="Keterangan"
                                                            rows="3"><?= $data['pot_ket'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer my-2">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary" aria-current="page">
                                                        <i class="fas fa-fw fa-1x fa-save"></i>
                                                        Update Data
                                                    </button>
                                                    <a href="?page=potongan" aria-current="page">
                                                        <button type="button" class="btn btn-default btn-outline-dark">
                                                            <i class="fas fa-close fa-1x fa-fw"></i>
                                                            Kembali Halaman
                                                        </button>
                                                    </a>
                                                    <button type="reset" class="btn btn-danger" aria-current="page">
                                                        <i class="fas fa-fw fa-1x fa-eraser"></i>
                                                        Hapus Data
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>