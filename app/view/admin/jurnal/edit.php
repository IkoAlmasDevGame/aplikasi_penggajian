<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Edit Data Jurnal"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
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
                    <a href="?page=jurnal" aria-current="page"
                        class="text-decoration-none text-primary"><?php echo "Data Jurnal"; ?></a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?aksi=edit-jurnal&trx=<?= $_GET['trx'] ?>" aria-current="page"
                        class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="p-1 p-lg-1 m-1 m-lg-1">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card col-sm-7 col-md-7 shadow">
                                <div class="card-header py-2">
                                    <h4 class="card-title display-4 fs-3"
                                        style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                        <?php echo $pagedesc ?>
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <?php if (isset($_GET['trx'])): ?>
                                        <?php $SQL = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.jurnal_trx='" . $_GET['trx'] . "'" ?>
                                        <?php $ress = $koneksi->query($SQL); ?>
                                        <?php foreach ($ress as $data): ?>
                                            <form action="?aksi=jurnal-edit" enctype="multipart/form-data" method="post"
                                                class="form-group">
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="TRX"
                                                                class="label label-default fs-5 display-4 text-dark">No
                                                                Transaksi</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="text" value="<?= $data['jurnal_trx'] ?>" name="trx"
                                                                id="TRX" class="form-control" maxlength="8" readonly
                                                                required placeholder="Nomor Transaksi ....">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="akun"
                                                                class="label label-default fs-5 display-4 text-dark">Akun</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <select class="form-select" name="akun" required>
                                                                <?php
                                                                $mySql = "SELECT * FROM akun ORDER BY akun_kode ASC";
                                                                $myQry = mysqli_query($koneksi, $mySql);
                                                                $dataKry = $data['akun_kode'];
                                                                echo "<option value=''>====== Pilih Akun ======</option>";
                                                                while ($myData = mysqli_fetch_array($myQry)) {
                                                                    if ($myData['akun_kode'] == $dataKry) {
                                                                        $cek = " selected";
                                                                    } else {
                                                                        $cek = "";
                                                                    }
                                                                    echo "<option value='$myData[akun_kode]' $cek>$myData[akun_kode] - $myData[akun_nama] - $myData[akun_jenis] </option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="nomor_ref"
                                                                class="label label-default fs-5 display-4 text-dark">Nomor
                                                                Referensi</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="text" name="ref"
                                                                value="<?= $data['jurnal_reff'] ?>" aria-required="TRUE"
                                                                class="form-control" placeholder="Nomor Referensi"
                                                                id="nomor_ref">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="tanggal"
                                                                class="label label-default fs-5 display-4 text-dark">Tanggal</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="date" name="tgl" class="form-control"
                                                                value="<?php echo $data['jurnal_tgl'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="jumlah"
                                                                class="label label-default fs-5 display-4 text-dark">Jumlah</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="number" name="jml" min="0" class="form-control"
                                                                placeholder="Jumlah" value="<?= ($data['jurnal_jml']) ?>"
                                                                id="jumlah">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center align-items-start flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="ket"
                                                                class="label label-default fs-5 display-4 text-dark">Keterangan</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <textarea name="ket" class="form-control"
                                                                placeholder="keterangan"
                                                                id="ket"><?php echo $data['jurnal_ket'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer my-2">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save fa-fw fa-1x"></i>
                                                            Update Data
                                                        </button>
                                                        <a href="?page=jurnal" aria-current="page"
                                                            class="btn btn-default btn-outline-dark">
                                                            Batal
                                                        </a>
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
    <?php require_once("../ui/footer.php"); ?>