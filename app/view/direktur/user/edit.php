<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Ubah Data Users"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
        <style type="text/css">
        .fst-times {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 500;
            color: white;
            font-size: 21px;
        }

        .fst-timesnew {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 500;
            color: darkgray;
            text-shadow: 0px 1px 0px black;
            font-size: 18px;
            padding: 10px 0px 10px 0px;
            text-align: center;
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
            <div class="panel-heading py-4 container-fluid">
                <h4 class="panel-title display-4 text-dark fs-3 fst-times">
                    <?php echo $pagedesc ?>
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=users-data" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Users"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=users-edit&usr=<?= $_GET['usr'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="col-sm-6 col-md-6">
                                    <div class="card shadow mb-3 bg-secondary">
                                        <div class="card-header py-2">
                                            <h4 class="display-4 fs-3 fst-timesnew">
                                                <?php echo $pagedesc; ?>
                                            </h4>
                                        </div>
                                        <div class="card-body my-2">
                                            <?php if (isset($_GET['usr'])): ?>
                                            <?php $usr = htmlspecialchars($_GET['usr']); ?>
                                            <?php $ress = $users->users_data($usr); ?>
                                            <?php foreach ($ress as $data): ?>
                                            <form action="?aksi=edit-users" class="form-group"
                                                enctype="multipart/form-data" method="post">
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center 
                                                        align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="" class="fst-times">Karyawan</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <input type="text" name="kry" class="form-control"
                                                                value="<?php echo $data['karyawan_id'] . ' - ' . $data['karyawan_nama']; ?>"
                                                                readonly>
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="<?php echo $data['user_id']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center 
                                                        align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="" class="fst-times">Hak Akses</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <select name="jenis" class="form-control" required>
                                                                <option value="<?php echo $data['user_akses']; ?>"
                                                                    selected><?php echo $data['user_akses']; ?></option>
                                                                <option value="Admin HRD">Admin HRD</option>
                                                                <option value="Manager">Manager</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline my-2">
                                                    <div class="row justify-content-center 
                                                        align-items-center flex-wrap">
                                                        <div class="form-label col-sm-4 col-md-4">
                                                            <label for="" class="fst-times">Status</label>
                                                        </div>
                                                        <div class="col-sm-1 col-md-1">:</div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <select name="stt" class="form-control" required>
                                                                <option value="<?php echo $data['user_stt']; ?>"
                                                                    selected><?php echo $data['user_stt']; ?>
                                                                </option>
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Nonaktif">Nonaktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer rounded-2 my-2">
                                                    <div class="text-start">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-fw fa-1x fa-save"></i>
                                                            Update
                                                        </button>
                                                        <a href="?page=users-data" aria-current="page">
                                                            <button type="button"
                                                                class="btn btn-default btn-outline-dark">
                                                                <i class="fas fa-fw fa-1x fa-close"></i>
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
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php"); ?>