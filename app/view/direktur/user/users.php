<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $pagedesc = "Data Users"; ?>
        <title><?php echo $setting['nama_website'] . " - " . $pagedesc; ?></title>
        <?php if ($_SESSION['akses_jabatan'] == 'direktur') { ?>
        <?php require_once("../ui/header.php"); ?>
        <?php require_once("../../../config/config.php"); ?>
        <?php require_once("../../../library/tanggal.php"); ?>
        <?php } else { ?>
        <?php header("location:../ui/header.php?page=beranda"); ?>
        <?php exit(0); ?>
        <?php } ?>
        <style type="text/css">
        .fst-times {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 500;
            color: black;
        }

        .fst-timesnew {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 500;
            color: darkgray;
            text-shadow: 1px 1px 1px black;
            font-size: 18px;
            padding: 10px 0px 10px 0px;
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php"); ?>
        <div class="panel panel-default container-fluid bg-body-secondary rounded-2">
            <div class="panel-heading py-4 container-fluid">
                <h4 class="panel-title display-4 fs-3 fst-times">
                    <?php echo $pagedesc ?>
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=users-data" aria-current="page"
                            class="text-decoration-none active"><?php echo $pagedesc; ?></a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="p-1 p-lg-1 m-1 m-lg-1">
                            <div class="card shadow mb-3">
                                <div class="card-header py-2">
                                    <h4 class="display-4 fs-3 fst-timesnew">
                                        <?php echo $pagedesc; ?>
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <div class="card-tools my-2">
                                        <div class="text-start">
                                            <a href="?aksi=users-tambah" aria-current="page" class="btn btn-danger">
                                                <i class="fas fa-fw fa-1x fa-plus"></i>
                                                Tambah Data Users
                                            </a>
                                            <a href="?page=users-data" aria-current="page">
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
                                    <div class="card-footer my-1">
                                        <div class="container-fluid">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped-columns"
                                                    id="datatable2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center fw-normal" width="5%">No</th>
                                                            <th class="text-center fw-normal" width="8%">ID</th>
                                                            <th class="text-center fw-normal" width="10%">Nama</th>
                                                            <th class="text-center fw-normal" width="8%">Akses</th>
                                                            <th class="text-center fw-normal" width="8%">Status</th>
                                                            <th class="text-center fw-normal" width="10%">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $n = 1; ?>
                                                        <?php $ress = $users->users(); ?>
                                                        <?php foreach ($ress as $data): ?>
                                                        <?php extract($data); ?>
                                                        <tr>
                                                            <td class="text-center fw-normal"><?php echo $n; ?></td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $karyawan_id ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <a href="" aria-current="page"
                                                                    class="btn btn-link text-decoration-none"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#MyModal<?= $karyawan_id ?>">
                                                                    <?php echo $karyawan_nama ?>
                                                                </a>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $user_akses ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $user_stt ?>
                                                            </td>
                                                            <td class="text-center fw-normal">
                                                                <a href="?aksi=users-edit&usr=<?= $user_id ?>"
                                                                    aria-current="page">
                                                                    <button type="button"
                                                                        class="btn btn-warning btn-sm rounded-3">
                                                                        <i class="fas fa-edit fa-1x fa-fw"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="?aksi=hapus-users&id=<?= $user_id ?>"
                                                                    onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['karyawan_nama']; ?>?')"
                                                                    aria-current="page">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger rounded-3">
                                                                        <i class="fas fa-trash fa-1x fa-fw"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $n++; ?>
                                                        <div class="modal fade" tabindex="-1"
                                                            id="MyModal<?= $karyawan_id ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title fst-timesnew">
                                                                            <?php echo $karyawan_nama . " - " . $karyawan_id ?>
                                                                        </h4>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body my-2">
                                                                        <div class="form-group">
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">ID
                                                                                            Karyawan</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_id'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Nama
                                                                                            Karyawan</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_nama'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Jenis
                                                                                            Kelamin</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_jk'] ?>
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
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_telp'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Alamat</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_alamat'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Tempat
                                                                                            Lahir</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_tptlhr'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Tanggal
                                                                                            Lahir</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo format_tanggal($data['karyawan_tgllhr']) ?>
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
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['bagian_nama'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div class="row justify-content-center
                                                             align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Status</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <?php echo $data['karyawan_status'] ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-inline my-2">
                                                                                <div
                                                                                    class="row justify-content-center align-items-start flex-wrap">
                                                                                    <div class="form-label col-sm-4 col-md-4 
                                                                text-secondary display-4 fs-5">
                                                                                        <label for=""
                                                                                            class="label label-default">Foto</label>
                                                                                    </div>
                                                                                    <div class="col-sm-1 col-md-1">:
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-md-6">
                                                                                        <div
                                                                                            class="form-icon img-thumbnail w-25">
                                                                                            <img src="../../../../assets/karyawan/<?= $data['karyawan_foto'] ?>"
                                                                                                id="preview" alt=""
                                                                                                width="100"
                                                                                                class="img-rounded img-fluid">
                                                                                        </div>
                                                                                        <div class="my-3">
                                                                                            <?= $data['karyawan_foto'] ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer my-2">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
        <?php require_once("../ui/footer.php"); ?>