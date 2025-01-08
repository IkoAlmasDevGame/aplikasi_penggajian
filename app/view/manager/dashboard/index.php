<?php require_once("../ui/header.php") ?>
<?php require_once("../ui/sidebar.php") ?>
<!-- Layout Beranda -->
<?php if ($setting['status_website'] == '1'): ?>
<?php else: ?>
    <style type="text/css">
        .card {
            width: 550px;
        }

        @media (max-width:720px) {
            .card {
                max-width: 100%;
            }
        }
    </style>
    <div class="mt-4 pt-5">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="card mb-3 shadow">
                <div class="card-header py-2">
                    <h4 class="card-title text-center">
                        MAINTANCE
                    </h4>
                </div>
                <div class="card-body text-center">
                    <h4 class="display-4 fs-4 m-5"
                        style="font-weight: 500; font-style: normal; font-family: 'Times New Roman';">
                        SERVER SEDANG MAINTANCE ...
                    </h4>
                    <div class="card-footer my-2">
                        <a href="?page=logout" onclick="return confirm('Apakah anda ingin logout ?')" aria-current="page">
                            <button type="button" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt fa-fw fa-2x"></i>
                                <span class="fw-semibold shadow fs-3">Log Out</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Layout Beranda -->
<?php require_once("../ui/footer.php") ?>