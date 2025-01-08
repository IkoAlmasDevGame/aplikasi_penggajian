<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Lihat Data Karyawan"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'manager') { ?>
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
                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">Lihat Data Karyawan
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=karyawan" aria-current="page"
                            class="text-decoration-none active"><?php echo "Data Karyawan"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=lihat-karyawan&kry=<?= $_GET['kry'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card shadow col-sm-9 col-md-9 bg-body-secondary mb-4">
                                    <div class="card-header py-2">
                                        <h4 class="card-title display-4 fs-3"
                                            style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                            Lihat Data Karyawan
                                        </h4>
                                    </div>
                                    <div class="card-body my-2">
                                        <div class="container-fluid">
                                            <div class="table-responsive">
                                                <?php if (isset($_GET['kry'])): ?>
                                                <?php $SQL = "SELECT * FROM karyawan JOIN bagian ON karyawan.bagian_id = bagian.bagian_id WHERE karyawan.karyawan_id='$_GET[kry]'"; ?>
                                                <?php $mysql = $koneksi->query($SQL); ?>
                                                <?php foreach ($mysql as $result): ?>
                                                <div class="form-group">
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">ID
                                                                    Karyawan</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_id'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Nama
                                                                    Karyawan</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_nama'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Jenis
                                                                    Kelamin</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_jk'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for=""
                                                                    class="label label-default">Telepon</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_telp'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Alamat</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_alamat'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Tempat
                                                                    Lahir</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_tptlhr'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Tanggal
                                                                    Lahir</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo format_tanggal($result['karyawan_tgllhr']) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="id"
                                                                    class="label label-default">Bagian</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['bagian_nama'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Status</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <?php echo $result['karyawan_status'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline my-2">
                                                        <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                            <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                <label for="" class="label label-default">Foto</label>
                                                            </div>
                                                            <div class="col-sm-1 col-md-1">:</div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <div class="form-icon img-thumbnail w-25">
                                                                    <img src="../../../../assets/karyawan/<?= $result['karyawan_foto'] ?>"
                                                                        id="preview" alt="" width="100"
                                                                        class="img-rounded img-fluid">
                                                                </div>
                                                                <div class="my-3">
                                                                    <?= $result['karyawan_foto'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <?php echo "Nomor Transaksi Tidak Terbaca"; ?>
                                            <?php exit(0); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <a href="?page=karyawan" aria-current="page">
                                                <button type="button" class="btn btn-default">
                                                    <i class="fas fa-close fa-1x fa-fw"></i>
                                                    Kembali
                                                </button>
                                            </a>
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