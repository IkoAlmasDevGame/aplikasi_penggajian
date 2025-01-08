<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Edit Data Karyawan"; ?>
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
                    <?php echo $pagedesc; ?>
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=karyawan" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Karyawan"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=edit-karyawan&kry=<?= $_GET['kry'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-8 col-md-8 bg-secondary">
                                    <div class="card-header border border-top border-dark py-2">
                                        <h4 class="card-title display-4 fs-3 text-center"
                                            style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                            Edit Data
                                        </h4>
                                    </div>
                                    <div class="card-body my-2">
                                        <?php if (isset($_GET['kry'])): ?>
                                        <?php $SQL = $koneksi->query("SELECT * FROM karyawan WHERE karyawan_id = '$_GET[kry]'"); ?>
                                        <?php foreach ($SQL as $data): ?>
                                        <form action="?aksi=karyawan-ubah" enctype="multipart/form-data" role="form"
                                            class="form-group" method="post">
                                            <input type="hidden" name="id_adm" value="<?= $_SESSION['admin'] ?>">
                                            <input type="hidden" name="idold" value="<?= $data['karyawan_id'] ?>">
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="nama" class="label label-default">Nama
                                                            Karyawan</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="text" name="karyawan_nama"
                                                            value="<?= $data['karyawan_nama'] ?>" id="nama"
                                                            maxlength="100" class="form-control"
                                                            placeholder="Nama Karyawan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="jk" class="label label-default">Jenis
                                                            Kelamin</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <select name="karyawan_jk" id="jk" class="form-select">
                                                            <option value="<?= $data['karyawan_jk'] ?>" selected>
                                                                <?= $data['karyawan_jk'] ?></option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="telp" class="label label-default">Telepon</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="number" min="0"
                                                            value="<?= $data['karyawan_telp']; ?>" maxlength="20"
                                                            name="karyawan_telp" class="form-control" id="telp"
                                                            placeholder="Telepon">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="alamat" class="label label-default">Alamat</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <textarea name="karyawan_alamat" maxlength="255"
                                                            placeholder="Alamat" id="alamat" rows="4"
                                                            class="form-control"><?= $data['karyawan_alamat']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="tpt" class="label label-default">Tempat
                                                            Lahir</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="text" name="karyawan_tptlhr"
                                                            value="<?= $data['karyawan_tptlhr']; ?>" id="tpt"
                                                            maxlength="100" placeholder="Tempat Lahir"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="tgl" class="label label-default">Tanggal
                                                            Lahir</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="date" value="<?= $data['karyawan_tgllhr']; ?>"
                                                            name="karyawan_tgllhr" id="tgl" placeholder="Tanggal Lahir"
                                                            class="form-control date-formate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="bagian" class="label label-default">Bagian</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <select name="bagian_id" id="bagian" class="form-select">
                                                            <?php
                                                                $mySql = "SELECT * FROM bagian ORDER BY bagian_nama ASC";
                                                                $myQry = mysqli_query($koneksi, $mySql);
                                                                while ($myData = mysqli_fetch_array($myQry)) {
                                                                    $dataMerek = $data['bagian_id'];
                                                                    if ($myData['bagian_id'] == $dataMerek) {
                                                                        $cek = " selected";
                                                                    } else {
                                                                        $cek = "";
                                                                    }
                                                                    echo "<option value='$myData[bagian_id]' $cek>$myData[bagian_nama] </option>";
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="krj" class="label label-default">Mulai
                                                            Bekerja</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="date" name="karyawan_masuk"
                                                            value="<?= $data['karyawan_masuk']; ?>" id="krj"
                                                            placeholder="Mulai Bekerja"
                                                            class="form-control date-formate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                        <label for="Status" class="label label-default">Status</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <select name="karyawan_status" id="Status" class="form-select">
                                                            <option value="<?php echo $data['karyawan_status']; ?>"
                                                                selected><?php echo $data['karyawan_status']; ?>
                                                            </option>
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Nonaktif">Nonaktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 fw-semibold">
                                                        <label for="foto" class="label label-default text-light">Foto
                                                            (Abaikan jika tidak diubah.)
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="form-icon img-thumbnail w-25">
                                                            <?php $dir = "../../../../../assets/default/user_logo.png" ?>
                                                            <?php if ($data['karyawan_foto'] != $dir) { ?>
                                                            <img id="preview"
                                                                src="../../../../../assets/karyawan/<?= $data['karyawan_foto'] ?>"
                                                                alt="" width="64" class="img-rounded img-fluid">
                                                            <?php } else { ?>
                                                            <img src="<?= $dir ?>" alt="user_logo.png" width="64"
                                                                class="img-rounded img-fluid">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="form-control my-3">
                                                            <input type="file" name="karyawan_foto" accept="image/*"
                                                                class="form-control-file" onchange="previewImage(this)"
                                                                aria-required="true">
                                                            <div class="my-1"></div>
                                                            <input type="checkbox" name="ubahfoto" id=""> Klik jika
                                                            ingin ubah foto
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer my-2">
                                                <div class="text-center">
                                                    <button type="submit" name="update" class="btn btn-primary"
                                                        aria-current="page">
                                                        <i class="fas fa-fw fa-1x fa-save"></i>
                                                        Update Data
                                                    </button>
                                                    <a href="?page=karyawan" aria-current="page">
                                                        <button type="button" class="btn btn-default btn-outline-dark">
                                                            <i class="fas fa-close fa-1x fa-fw"></i>
                                                            Kembali Halaman
                                                        </button>
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