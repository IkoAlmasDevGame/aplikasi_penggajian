<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Lihat Data Absensi"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
        <?php
        if (isset($_GET['abs'])) {
            $abs = htmlspecialchars($_GET['abs']);
            $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
            $ressa = mysqli_query($koneksi, $sqla);
            $dataa = mysqli_fetch_array($ressa);
            $bln = $dataa['abs_bln'];
            $th = $dataa['abs_th'];
            $bl = $dataa['abs_bl'];
        }
        ?>
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
                        <a href="?page=absensi" aria-current="page"
                            class="text-decoration-none active"><?php echo "Data Absensi"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=lihat-absensi&abs=<?= $_GET['abs'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="card shadow mb-3">
                                <div class="card-header py-2">
                                    <h4 class="card-title display-4 fs-3"
                                        style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                        <?php echo $pagedesc ?>
                                    </h4>
                                </div>
                                <div class="card-footer my-1">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped-columns"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%"> No</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="8%">ID</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="10%">Nama</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%">Hadir</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%">Sakit</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%">Izin</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%">Alfa</th>
                                                            <th style="max-width: 100%;" class="text-center fw-normal"
                                                                width="5%">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $n = 1; ?>
                                                        <?php $SQL = "SELECT * FROM karyawan ORDER BY karyawan_nama ASC"; ?>
                                                        <?php $ress = $koneksi->query($SQL); ?>
                                                        <?php while ($row = $ress->fetch_array()) { ?>
                                                        <?php
                                                        $id = $row['karyawan_id'];
                                                        $sqlcek = "SELECT * FROM absensi JOIN karyawan ON absensi.karyawan_id = karyawan.karyawan_id JOIN abs ON absensi.abs_id = abs.abs_id
                                                         WHERE abs.abs_id='$abs' AND karyawan.karyawan_id='$id'";
                                                        $resscek = mysqli_query($koneksi, $sqlcek);
                                                        $rowscek = mysqli_num_rows($resscek);
                                                        $datacek = mysqli_fetch_array($resscek);
                                                        if ($rowscek > 0) {
                                                            $h = $datacek['absensi_h'];
                                                            $s = $datacek['absensi_s'];
                                                            $i = $datacek['absensi_i'];
                                                            $a = $datacek['absensi_a'];
                                                        } else {
                                                            $h = "Belum Input";
                                                            $s = "Belum Input";
                                                            $i = "Belum Input";
                                                            $a = "Belum Input";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $n; ?></td>
                                                            <td class="text-center">
                                                                <?php echo $row['karyawan_id'] ?>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <?php echo $row['karyawan_nama'] ?>
                                                            </td>
                                                            <td class="text-center"><?php echo $h ?></td>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center"><?php echo $i ?></td>
                                                            <td class="text-center"><?php echo $a ?></td>
                                                            <td class="text-center">
                                                                <a href="?aksi=input-absensi&kry=<?= $row['karyawan_id'] ?>&abs=<?= $abs ?>"
                                                                    aria-current="page">
                                                                    <button type="button"
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fas fa-edit fa-fw fa-1x"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $n++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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