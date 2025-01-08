<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Tambah Data Karyawan"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
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
                    <a href="?aksi=tambah-karyawan" aria-current="page"
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
                                        Tambah Data
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <form action="?aksi=karyawan-tambah" enctype="multipart/form-data" role="form"
                                        class="form-group" method="post">
                                        <input type="hidden" name="id_adm" value="<?= $_SESSION['adm'] ?>">
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                    <label for="id" class="label label-default">ID Karyawan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="karyawan_id" id="id"
                                                        onBlur="checkIdAvailability()" maxlength="20"
                                                        class="form-control" placeholder="ID Karyawan">
                                                    <span id="user-availability-status"
                                                        style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 text-light display-4 fs-5">
                                                    <label for="nama" class="label label-default">Nama
                                                        Karyawan</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <input type="text" name="karyawan_nama" id="nama"
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
                                                        <option value="" selected>== Pilih Jenis Kelamin ==</option>
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
                                                    <input type="number" min="0" maxlength="20" name="karyawan_telp"
                                                        class="form-control" id="telp" placeholder="Telepon">
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
                                                        class="form-control"></textarea>
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
                                                    <input type="text" name="karyawan_tptlhr" id="tpt"
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
                                                    <input type="date" name="karyawan_tgllhr" id="tgl"
                                                        placeholder="Tanggal Lahir"
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
                                                        <option value="">== Pilih Bagian ==</option>
                                                        <?php $mySql = "SELECT * FROM bagian ORDER BY bagian_nama ASC"; ?>
                                                        <?php $myQry = mysqli_query($koneksi, $mySql); ?>
                                                        <?php while ($myData = mysqli_fetch_array($myQry)) { ?>
                                                            <?php if ($myData['bagian_id'] == $dataMerek) { ?>
                                                                <?php $cek = "selected"; ?>
                                                            <?php } else { ?>
                                                            <?php } ?>
                                                            <?php $cek = ""; ?>
                                                            <option value="<?= $myData['bagian_id'] ?>" <?php $cek; ?>>
                                                                <?php echo $myData['bagian_nama'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                    <input type="date" name="karyawan_masuk" id="krj"
                                                        placeholder="Mulai Bekerja"
                                                        class="form-control date-formate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-start flex-wrap">
                                                <div class="form-label col-sm-4 col-md-4 fs-5 fw-semibold">
                                                    <label for="foto" class="label label-default text-light">Foto
                                                    </label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-icon img-thumbnail w-25">
                                                        <img src="https://th.bing.com/th/id/OIP.jxhJvX2q8gLQmiFuOWa1bAHaHa?w=161&h=180&c=7&r=0&o=5&pid=1.7"
                                                            id="preview" alt="" width="64"
                                                            class="img-rounded img-fluid">
                                                    </div>
                                                    <div class="form-control my-3">
                                                        <input type="file" name="karyawan_foto" accept="image/*"
                                                            class="form-control-file" onchange="previewImage(this)"
                                                            aria-required="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer my-2">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" aria-current="page">
                                                    <i class="fas fa-fw fa-1x fa-save"></i>
                                                    Simpan Data
                                                </button>
                                                <a href="?page=karyawan" aria-current="page">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php"); ?>