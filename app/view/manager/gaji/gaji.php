<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Data Gaji"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == "Manager") { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
    <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
    <?php } ?>
    <style type="text/css">
        #datatable2 {
            min-width: 900px;
        }

        @media (min-width: 900px) {
            #datatable2 {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php require_once("../ui/sidebar.php"); ?>
    <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
        <div class="panel-heading py-4 container-fluid">
            <h4 class="panel-title display-4 fs-3"
                style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">Data Gaji
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page"
                        class="text-decoration-none text-primary">Beranda</a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=gaji" aria-current="page"
                        class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="p-1 p-lg-1 m-1 m-lg-1">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title display-4 fs-3"
                                    style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                    Data Gaji
                                </h4>
                                <div class="card-body my-2">
                                    <div class="card-tools">
                                        <div class="text-start">
                                            <!--<a href="" class="btn btn-success">Ajukan</a>-->
                                            <div class="d-flex justify-content-end align-items-end flex-wrap">
                                                <div class="col-sm-4 col-md-4 text-center">
                                                    <div class="rounded-2 bg-info py-2 text-light fs-5 fw-bold">
                                                        <marquee behavior="scroll" scrollamount="15"
                                                            direction="left">
                                                            <?php echo salam() . ", " . $_SESSION['nama'] ?>
                                                        </marquee>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="table-responsive">
                                            <div class="container-fluid">
                                                <table class="table table-bordered table-striped-columns"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal">No</th>
                                                            <th class="text-center fw-normal">Periode</th>
                                                            <th class="text-center fw-normal">Total Karyawan</th>
                                                            <th class="text-center fw-normal">Menunggu Approval</th>
                                                            <th class="text-center fw-normal">Rejected</th>
                                                            <th class="text-center fw-normal">Approved</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php $ress = $paycash->gaji(); ?>
                                                        <?php foreach ($ress as $data) { ?>
                                                            <?php
                                                            $ab = $data['abs_id'];
                                                            # hitung karyawan
                                                            $sqlkry = "SELECT * FROM karyawan WHERE karyawan_status='Aktif'";
                                                            $resskry = mysqli_query($koneksi, $sqlkry);
                                                            $rowskry = mysqli_num_rows($resskry);
                                                            # cek gaji
                                                            $sqlcek = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab'";
                                                            $resscek = mysqli_query($koneksi, $sqlcek);
                                                            $rowscek = mysqli_num_rows($resscek);
                                                            if ($rowscek > 0) {
                                                                # cek pengajuan
                                                                $sqlapp = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Menunggu Approval'";
                                                                $ressapp = mysqli_query($koneksi, $sqlapp);
                                                                $rowsapp = mysqli_num_rows($ressapp);

                                                                # cek rejected
                                                                $sqlrej = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Rejected'";
                                                                $ressrej = mysqli_query($koneksi, $sqlrej);
                                                                $rowsrej = mysqli_num_rows($ressrej);

                                                                # cek accepted
                                                                $sqlacc = "SELECT * FROM gaji_karyawan WHERE abs_id='$ab' AND gaj_stt='Approved'";
                                                                $ressacc = mysqli_query($koneksi, $sqlacc);
                                                                $rowsacc = mysqli_num_rows($ressacc);
                                                            } else {
                                                                $rowsapp = "0";
                                                                $rowsrej = "0";
                                                                $rowsacc = "0";
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $data['abs_bln'] . " - " . $data['abs_th']; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $rowskry; ?>
                                                                    <br>
                                                                    <a href="?page=gaji_all&abs=<?= $data['abs_id'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm col-sm-6 col-md-6">
                                                                            Lihat
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $rowsapp; ?>
                                                                    <br>
                                                                    <a href="?page=gaji_wait&abs=<?= $data['abs_id'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm col-sm-6 col-md-6">
                                                                            Lihat
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $rowsrej; ?>
                                                                    <br>
                                                                    <a href="?page=gaji_rej&abs=<?= $data['abs_id'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm col-sm-6 col-md-6">
                                                                            Lihat
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $rowsacc; ?>
                                                                    <br>
                                                                    <a href="?page=gaji_app&abs=<?= $data['abs_id'] ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm col-sm-6 col-md-6">
                                                                            Lihat
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
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
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>