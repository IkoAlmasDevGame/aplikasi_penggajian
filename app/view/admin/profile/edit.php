<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Data Profile Pribadi"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
        <style type="text/css">
        .fst-times {
            font-family: 'Times New Roman';
            font-weight: 500;
            font-style: normal;
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
            <div class="panel-heading py-4 container-fluid">
                <h4 class="panel-title display-4 fs-3 fst-times">
                    <?php echo $pagedesc ?></h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=user-profile&karyawan_id=<?= $_GET['karyawan_id'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="mb-3"></div>
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <?php if (isset($_GET['karyawan_id'])) : ?>
                                <?php $dataUser = $employe->edit($_GET['karyawan_id']); ?>
                                <?php foreach ($dataUser as $row) { ?>
                                <div class="card col-sm-7 col-md-7 mb-3">
                                    <div class="card-header py-2">
                                        <h4 class="card-title fs-4 display-4 fst-times">
                                            <?php echo "<div class='display-4 fs-4 text-center fst-times text-dark my-2'>Data Profile : $row[karyawan_nama]</div><br"; ?>
                                        </h4>
                                    </div>
                                    <div class="card-body my-2">
                                        <?php if (isset($_GET['data'])) { ?>
                                        <?php foreach ($dataUser as $data) { ?>
                                        <form action="?aksi=perbarui-profile" enctype="multipart/form-data"
                                            class="form-group" method="post">
                                            <input type="hidden" name="karyawan_id" value="<?= $data['karyawan_id'] ?>">
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                        <label for="" class="label label-default">Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="text" class="form-control" name="karyawan_nama"
                                                            value="<?= $data['karyawan_nama'] ?>" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                        <label for="" class="label label-default">Nomor Telepon</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="text" class="form-control" name="karyawan_telp"
                                                            value="<?= $data['karyawan_telp'] ?>" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 display-4 fs-5 fst-times">
                                                        <label for="" class="label label-default">Foto</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="form-icon img-thumbnail w-25">
                                                            <?php $file = __FILE__ . "user_logo.png"; ?>
                                                            <?php $dir = __DIR__ . "../../../../assets/default/" . $file; ?>
                                                            <?php if ($data['karyawan_foto'] != $dir) { ?>
                                                            <img id="preview"
                                                                src="../../../../assets/karyawan/<?= $data['karyawan_foto'] ?>"
                                                                alt="" width="64" class="img-rounded img-fluid">
                                                            <?php } else { ?>
                                                            <img src="<?php echo $dir ?>" alt="" width="64"
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
                                            <?php if (isset($_GET['data'])) { ?>
                                            <div class="card-footer">
                                                <div class="text-start">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-fw fa-save"></i>
                                                        Update Data
                                                    </button>
                                                    <a href="?page=user-profile&karyawan_id=<?= $data['karyawan_id'] ?>"
                                                        aria-current="page" class="btn btn-danger">
                                                        <i class="fas fa-fw fa-close"></i>
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </form>
                                        <?php } ?>
                                        <?php } elseif (isset($_GET['change'])) { ?>
                                        <?php foreach ($dataUser as $isi): ?>
                                        <form action="?aksi=perbarui-password" class="form-group" method="post">
                                            <input type="hidden" name="karyawan_id" value="<?= $isi['karyawan_id'] ?>">
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                        <label for="old_password" class="label label-default">Old
                                                            Password</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="password" placeholder="masukkan password lama ..."
                                                            class="form-control" name="old_password" value="" required
                                                            id="old_password" aria-required="TRUE">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                        <label for="new_password"
                                                            class="label label-default">Password</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="password" placeholder="masukkan password baru ..."
                                                            class="form-control" name="new_password" value="" required
                                                            id="new_password" aria-required="TRUE">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                        <label for="new_password_verify"
                                                            class="label label-default">Password
                                                            Verify</label>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">:</div>
                                                    <div class="col-sm-6 col-md-6">
                                                        <input type="password"
                                                            placeholder="ulangi password baru anda ..."
                                                            class="form-control" name="new_password_verify" value=""
                                                            required id="new_password_verify" aria-required="TRUE">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (isset($_GET['change'])): ?>
                                            <div class="card-footer">
                                                <div class="text-start">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-fw fa-save"></i>
                                                        Update Password
                                                    </button>
                                                    <a href="?page=user-profile&karyawan_id=<?= $isi['karyawan_id'] ?>"
                                                        aria-current="page" class="btn btn-danger">
                                                        <i class="fas fa-fw fa-close"></i>
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </form>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                <label for="" class="label label-default">User Name</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" class="form-control" name="username"
                                                    value="<?= $row['karyawan_id'] ?>" id="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                <label for="" class="label label-default">Nama Lengkap</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" class="form-control" name="nama_lengkap"
                                                    value="<?= $row['karyawan_nama'] ?>" id="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 display-4 fst-times">
                                                <label for="" class="label label-default">Nomor Telepon</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" class="form-control" name="email"
                                                    value="<?= $row['karyawan_telp'] ?>" id="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="text-start">
                                            <a href="?page=user-profile&karyawan_id=<?= $row['karyawan_id'] ?>&data=<?= $row['karyawan_id'] ?>"
                                                aria-current="page" class="btn btn-success">
                                                <i class="fas fa-fw fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="?page=user-profile&karyawan_id=<?= $row['karyawan_id'] ?>&change=<?= $row['karyawan_id'] ?>"
                                                aria-current="page" class="btn btn-danger">
                                                <i class="fas fa-fw fa-lock"></i>
                                                Change Password
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>