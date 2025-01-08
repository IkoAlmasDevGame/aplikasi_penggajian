<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Tambah Data Akun"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
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
                        <a href="?page=akun" aria-current="page"
                            class="text-decoration-none active"><?php echo "Data Akun"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambah-akun" aria-current="page"
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
                                        <form action="?aksi=akun-tambah" class="form-group" method="post">
                                            <div class="my-2"></div>
                                            <!-- === Kode Akun === -->
                                            <div class="form-inline row justify-content-center 
                                                    align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 display-4 text-dark">
                                                        Kode Akun
                                                    </label>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="akun_kode" maxlength="20"
                                                        aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan kode akun (akuntansi) ..." id="">
                                                </div>
                                            </div>
                                            <!-- === Kode Akun === -->
                                            <div class="my-2"></div>
                                            <!-- === Nama Akun === -->
                                            <div class="form-inline row justify-content-center 
                                                    align-items-center flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default fs-5 display-4 text-dark">
                                                        Nama Akun
                                                    </label>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="akun_nama" maxlength="100"
                                                        aria-required="TRUE" class="form-control"
                                                        placeholder="masukkan nama akun (akuntansi) ..." id="">
                                                </div>
                                            </div>
                                            <!-- === Nama Akun === -->
                                            <div class="my-1"></div>
                                            <div class="card-footer text-center">
                                                <button type="submit" class="btn btn-primary" aria-current="page">
                                                    <i class="fa fa-save fa-1x"></i>
                                                    <span>Simpan Data</span>
                                                </button>
                                                <a href="?page=akun" aria-current="page"
                                                    class="btn btn-default btn-outline-dark">
                                                    Batal
                                                </a>
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