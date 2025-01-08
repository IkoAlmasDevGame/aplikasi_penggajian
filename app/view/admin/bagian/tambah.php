<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Tambah Bagian"; ?>
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
                <?php echo $pagedesc; ?>
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page"
                        class="text-decoration-none text-primary">Beranda</a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=bagian" aria-current="page"
                        class="text-decoration-none active"><?php echo "Bagian"; ?></a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?aksi=tambah-bagian" aria-current="page"
                        class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="p-1 p-lg-1 m-1 m-lg-1">
                        <?php
                        error_reporting(0);
                        $struktur = $koneksi->query("SELECT * FROM bagian order by bagian_id desc limit 1");
                        $row = $struktur->fetch_array();
                        $no = $row['bagian_id'];
                        $urut = substr($no, 5, 3);
                        $tambah = (int) $urut + 1;
                        if (strlen($tambah) == 1) {
                            $format = "BGN" . "00" . $tambah;
                        } else if (strlen($tambah) == 2) {
                            $format = "BGN" . "0" . $tambah;
                        } else {
                            $format = "BGN" . $tambah;
                        }
                        ?>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="card shadow mb-4 col-sm-7 col-md-7">
                            <div class="card-header py-2">
                                <h4 class="card-title display-4 fs-3 text-center"
                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                    <?php echo $pagedesc; ?>
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <form action="?aksi=bagian-tambah" class="form-group" method="post">
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-end align-items-center flex-wrap">
                                            <div class="form-label col-sm-3 col-md-3 fs-5 text-secondary display-4">
                                                <label for="no_bagian" class="label label-default">Bagian
                                                    Kode</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-3 col-md-3">
                                                <input type="text" name="no" id="no_bagian" value="<?= $format; ?>"
                                                    readonly class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 text-secondary display-4">
                                                <label for="bagian_nama" class="label label-default">Nama
                                                    Bagian</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" name="nama" id="bagian_nama" value=""
                                                    placeholder="masukkan nama bagian ..." class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 text-secondary display-4">
                                                <label for="bagian_gaji" class="label label-default">Gaji
                                                    Pokok</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" inputmode="numeric" min="0" name="gaji"
                                                    id="bagian_gaji" value="" placeholder="masukkan gaji pokok ..."
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row justify-content-center align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4 fs-5 text-secondary display-4">
                                                <label for="bagian_lembur" class="label label-default">Rate Lembur
                                                    /Jam</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" inputmode="numeric" min="0" name="lembur"
                                                    id="bagian_lembur" value=""
                                                    placeholder="masukkan Rate Lembur ..." class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-fw fa-1x fa-save"></i>
                                                Simpan Data
                                            </button>
                                            <a href="?page=bagian" aria-current="page">
                                                <button type="button" class="btn btn-default">
                                                    <i class="fas fa-close fa-1x fa-fw"></i>
                                                    Kembali Halaman
                                                </button>
                                            </a>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fas fa-fw fa-1x fa-eraser"></i>
                                                Hapus Semua Data
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>