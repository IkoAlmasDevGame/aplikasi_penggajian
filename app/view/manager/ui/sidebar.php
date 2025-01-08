<?php
if ($_SESSION['akses_jabatan'] == '') {
    header("location:../../index.php");
    exit(0);
}
?>

<?php if ($_SESSION['akses_jabatan'] == 'manager'): ?>
<?php
    # error_reporting(0);
    require_once("../../../config/config.php");
    $data = $koneksi->query("SELECT * FROM karyawan JOIN user ON user.karyawan_id = karyawan.karyawan_id WHERE karyawan.karyawan_id = '$_SESSION[mng]' and user.user_akses = 'Manager' and user.user_stt = 'Aktif'");
    $baseFile = mysqli_fetch_array($data);
    $ds = $koneksi->query("SELECT * FROM setting");
    $setting = mysqli_fetch_array($ds);
    ?>
<?php if ($setting['status_website'] == '1'): ?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
            <?php echo "$setting[nama_website]"; ?>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <?php require_once("../../../library/library.php"); ?>
        &nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <?php $dir = __DIR__ . "../../../../assets/default/user_logo.png"; ?>
                    <?php if ($baseFile['karyawan_foto'] != $dir) { ?>
                    <img src="../../../../assets/karyawan/<?= $baseFile['karyawan_foto'] ?>"
                        class="img-responsive rounded-2" style="width: 25px; max-width: 100%;"
                        alt="<?= $baseFile['karyawan_foto'] ?>">
                    <?php } else { ?>
                    <img src="<?php echo $dir; ?>" class="img-responsive rounded-2"
                        style="width: 25px; max-width: 100%;" alt="user_logo.png">
                    <?php } ?>
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a>
                <!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h4 class="fs-6 fw-normal text-start text-dark">
                            <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                <div class="col-sm-4 col-md-4">
                                    <label for="">nama profile</label>
                                </div>
                                <div class="col-sm-1 col-md-1">:</div>
                                <div class="col-sm-6 col-md-6">
                                    <?php echo $baseFile['karyawan_nama']; ?>
                                </div>
                            </div>
                        </h4>
                        <hr class="dropdown-divider">
                        <h4 class="fs-6 fw-normal text-start text-dark">
                            <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                <div class="col-sm-4 col-md-4">
                                    <label for="">username</label>
                                </div>
                                <div class="col-sm-1 col-md-1">:</div>
                                <div class="col-sm-6 col-md-6">
                                    <?php echo $baseFile['karyawan_id']; ?>
                                </div>
                            </div>
                        </h4>
                        <hr class="dropdown-divider">
                        <h4 class="fs-6 fw-normal text-start text-dark">
                            <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                <div class="col-sm-4 col-md-4">
                                    <label for="">Jabatan</label>
                                </div>
                                <div class="col-sm-1 col-md-1">:</div>
                                <div class="col-sm-6 col-md-6">
                                    <?php echo $baseFile['user_akses'] ?>
                                </div>
                            </div>
                        </h4>
                        <hr class="dropdown-divider">
                        <h4 class="fs-6 fw-normal text-start text-dark">
                            <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                <div class="col-sm-4 col-md-4">
                                    <label for="">Status</label>
                                </div>
                                <div class="col-sm-1 col-md-1">:</div>
                                <div class="col-sm-6 col-md-6">
                                    <?php echo $baseFile['user_stt'] ?>
                                </div>
                            </div>
                        </h4>
                        <hr class="dropdown-divider my-2">
                        <div class="text-center">
                            <a href="?page=user-profile&karyawan_id=<?= $_SESSION['mng'] ?>"
                                class="btn btn-sm btn-success mx-2">
                                <i class="fas fa-fw fa-user fa-1x"></i>
                                Profile
                            </a>
                            <a href="?page=logout"
                                onclick="return confirm('Apakah anda ingin keluar dari website ini ?')"
                                aria-current="page" class="btn btn-sm btn-danger mx-1">
                                <i class="fas fa-fw fa-sign-out-alt fa-1x"></i>
                                Log Out
                            </a>
                        </div>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header>
<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" style="background: rgba(100, 107, 107, 1);" class="sidebar overflow-auto">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
                <i class="fas fa-tachometer-alt fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Dashboard</div>
            </a>
        </li>
        <hr class="border border-top border-light">
        <?php if ($_SESSION['user_akses'] == "Manager"): ?>
        <li class="nav-item">
            <a href="?page=karyawan" aria-current="page" class="nav-link collapsed">
                <i class="fas fa-user-friends fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Data Karyawan</div>
            </a>
        </li>
        <?php endif; ?>
        <hr class="border border-top border-light">
        <li class="nav-item">
            <a href="?page=gaji" class="nav-link collapsed" aria-current="page">
                <i class="fa-fw fa fa-money-bill-wave fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Gaji</div>
            </a>
        </li>
        <hr class="border border-top border-light">
        <li class="nav-item">
            <a href="?page=absensi" class="nav-link collapsed" aria-current="page">
                <i class="fa-fw fa fa-pen-alt fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Absensi</div>
            </a>
        </li>
        <hr class="border border-top border-light">
        <li class="nav-item">
            <a href="?page=lembur" class="nav-link collapsed" aria-current="page">
                <i class="fa-fw fa fa-clock fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Lembur</div>
            </a>
        </li>
        <hr class="border border-top border-light">
        <li class="nav-item">
            <a href="?page=potongan" class="nav-link collapsed" aria-current="page">
                <i class="fa-fw fa fa-percent fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Potongan</div>
            </a>
        </li>
        <hr class="border border-top border-light">
        <li class="nav-item">
            <a href="?page=tunjangan" class="nav-link collapsed" aria-current="page">
                <i class="fa-fw fa fa-money-bill-wave fa-1x"></i>
                <div class="fs-6 display-4 text-dark fw-normal">Tunjangan</div>
            </a>
        </li>
    </ul>
</aside>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php endif; ?>
    <?php else: ?>
    <?php
        echo "<script>
    document.location.href = '../../index.php';
    </script>";
        die;
        exit(0);
        ?>
    <?php endif; ?>