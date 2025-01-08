<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Data Karyawan"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == "Manager") { ?>
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
                style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">Data Karyawan</h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page"
                        class="text-decoration-none text-primary">Beranda</a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=karyawan" aria-current="page"
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
                                    Data Karyawan
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <div class="text-start">
                                        <a href="?page=karyawan" aria-current="page">
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
                                <hr>
                                <div class="card-footer">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <div class="d-table w-100">
                                                <table class="table table-striped-columns table-bordered"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%; max-width: 5%;"
                                                                class="text-center fw-normal">No
                                                            </th>
                                                            <th style="width: 8%; max-width: 8%;"
                                                                class="text-center fw-normal">ID
                                                            </th>
                                                            <th style="max-width: 10%; width: 10%;"
                                                                class="text-center fw-normal">Nama
                                                            </th>
                                                            <th style="max-width: 8%; width: 8%;"
                                                                class="text-center fw-normal">Telepon
                                                            </th>
                                                            <th style="max-width: 10%; width: 10%;"
                                                                class="text-center fw-normal">Bagian
                                                            </th>
                                                            <th style="max-width: 10%; width: 10%;"
                                                                class="text-center fw-normal">Status
                                                            </th>
                                                            <th style="max-width: 10%; width: 10%;"
                                                                class="text-center fw-normal">Opsinal
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php $ress = $employe->karyawan(); ?>
                                                        <?php while ($data = mysqli_fetch_array($ress)) { ?>
                                                            <?php extract($data); ?>
                                                            <tr>
                                                                <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $karyawan_id; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $karyawan_nama; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $karyawan_telp; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $bagian_nama; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $karyawan_status; ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <a href="?aksi=lihat-karyawan&kry=<?= $karyawan_id ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-info rounded-3">
                                                                            <i class="fas fa-info fa-1x fa-fw"></i>
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
    <?php require_once("../ui/footer.php"); ?>