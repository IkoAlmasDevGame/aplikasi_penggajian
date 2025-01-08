<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pagedesc = "Bagian"; ?>
    <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
    <?php if ($_SESSION['user_akses'] == 'Admin HRD') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/rupiah.php"); ?>
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
                style="font-family: 'Times New Roman'; font-style: normal; font-weight: 500;">Data Bagian
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page"
                        class="text-decoration-none text-primary">Beranda</a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=bagian" aria-current="page"
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
                                    Data Bagian
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="text-start">
                                    <div class="card-tools">
                                        <a href="?aksi=tambah-bagian" aria-current="page">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fas fa-fw fa-1x fa-plus"></i>
                                                Tambah Bagian
                                            </button>
                                        </a>
                                        <a href="?page=bagian" aria-current="page">
                                            <button type="button" class="btn btn-info">
                                                <i class="fas fa-fw fa-1x fa-refresh"></i>
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
                                            <div class="d-table w-100">
                                                <table class="table table-striped-columns table-bordered"
                                                    id="datatable2">
                                                    <thead>
                                                        <th class="text-center fw-normal" width="1%"
                                                            style="max-width: 1%;">No
                                                        </th>
                                                        <th class="text-start fw-normal" width="1%"
                                                            style="max-width: 1%;">Kode
                                                        </th>
                                                        <th class="text-start fw-normal" width="10%"
                                                            style="max-width: 10%;">Nama
                                                        </th>
                                                        <th class="text-start fw-normal" width="10%"
                                                            style="max-width: 10%;">Gaji Pokok
                                                        </th>
                                                        <th class="text-start fw-normal" width="10%"
                                                            style="max-width: 10%;">
                                                            Rate Lembur /Jam
                                                        </th>
                                                        <th class="text-center fw-normal" width="5%"
                                                            style="max-width: 5%;">Opsinal
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1; ?>
                                                        <?php $data = $bagan->bagian(); ?>
                                                        <?php foreach ($data as $row): ?>
                                                            <?php extract($row); ?>
                                                            <tr>
                                                                <td class="text-center fw-normal">
                                                                    <?php echo $no; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $bagian_id; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo $bagian_nama; ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo format_rupiah($bagian_gaji); ?>
                                                                </td>
                                                                <td class="text-start fw-normal">
                                                                    <?php echo format_rupiah($bagian_lembur); ?>
                                                                </td>
                                                                <td class="text-center fw-normal">
                                                                    <a href="?aksi=bagian-hapus&bgn=<?= $bagian_id ?>"
                                                                        aria-current="page"
                                                                        onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $row['bagian_nama']; ?> ?');">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger">
                                                                            <i class="fas fa-fw fa-1x fa-trash"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="?aksi=edit-bagian&bgn=<?= $bagian_id ?>"
                                                                        aria-current="page">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-fw fa-1x fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php $no++; ?>
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
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>