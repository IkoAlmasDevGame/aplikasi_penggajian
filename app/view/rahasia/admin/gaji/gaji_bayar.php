<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($_SESSION['akses_jabatan'] == 'admin') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../../config/config.php"); ?>
        <?php require_once("../../../../library/rupiah.php"); ?>
        <?php require_once("../../../../library/tanggal.php"); ?>
        <?php
        $abs = $_GET['abs'];
        $sqla = "SELECT * FROM abs WHERE abs_id='$_GET[abs]'";
        $ressa = mysqli_query($koneksi, $sqla);
        $dataa = mysqli_fetch_array($ressa);
        $bln = $dataa['abs_bln'];
        $th = $dataa['abs_th'];
        $bl = $dataa['abs_bl'];

        $sql = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian 
			WHERE karyawan.bagian_id=bagian.bagian_id AND gaji_karyawan.karyawan_id=karyawan.karyawan_id 
			AND gaji_karyawan.abs_id='$abs' AND gaji_karyawan.gaj_stt='Approved'";
        $ress = mysqli_query($koneksi, $sql);

        $pagedesc = "Rekap Gaji Karyawan Periode " . $bln . "-" . $th;
        $pagetitle = str_replace(" ", "_", $pagedesc);
        ?>
        <title><?php echo $pagetitle; ?></title>
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
                    <?php echo $pagetitle ?>
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=gaji" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Gaji"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=gaji_app&abs=<?= $_GET['abs'] ?>" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo "Data Gaji Approve"; ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=gaji_bayar&abs=<?= $_GET['abs'] ?>" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagetitle; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>