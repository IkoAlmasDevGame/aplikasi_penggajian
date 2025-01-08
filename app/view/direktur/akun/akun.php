<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Data Akun"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
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
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="card shadow mb-3">
                                <div class="card-header">
                                    <h4 class="card-title display-4 fs-3"
                                        style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">
                                        <?php echo $pagedesc ?>
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <div class="card-tools my-1">
                                        <div class="text-start">
                                            <a href="?page=akun" aria-current="page">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fas fa-refresh fa-fw fa-1x"></i>
                                                    Muat Ulang Halaman
                                                </button>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-end flex-wrap">
                                            <div class="col-sm-4 col-md-4 text-center">
                                                <div class="rounded-2 bg-info py-2 text-light fs-5 fw-bold">
                                                    <marquee behavior="scroll" scrollamount="15" direction="left">
                                                        <?php echo salam() . ", " . $_SESSION['nama'] ?>
                                                    </marquee>
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
                                                            <th class="text-start fw-normal" width="1%">No</th>
                                                            <th class="text-start fw-normal" width="10%">
                                                                Kode Akun
                                                            </th>
                                                            <th class="text-start fw-normal" width="10%">
                                                                Nama Akun
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $n = 1; ?>
                                                        <?php $ress = $akun->akun(); ?>
                                                        <?php foreach ($ress as $row): ?>
                                                        <tr>
                                                            <td class="text-center fw-normal"><?php echo $n; ?></td>
                                                            <td class="text-start fw-normal">
                                                                <?php echo $row['akun_kode']; ?>
                                                            </td>
                                                            <td class="text-nowrap fw-normal">
                                                                <?php echo $row['akun_nama']; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $n++; ?>
                                                        <?php endforeach; ?>
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