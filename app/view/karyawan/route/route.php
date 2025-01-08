<?php
require_once("../../../config/config.php");
$setting = $koneksi->query("SELECT * FROM setting")->fetch_array();
# Cek Invalid Data Admin Table.
if (isset($_SESSION['status'])) {
    # Table database Karyawan
    if (isset($_SESSION['karyawan'])) {
        if (isset($_SESSION['nama'])) {
            if (isset($_SESSION['no_telp'])) {
                if (isset($_SESSION['akses_jabatan'])) {
                    if (isset($_SESSION['user_stt'])) {
                        if (isset($_COOKIE['cookies'])) {
                            if (isset($_SERVER['HTTPS'])) {
                                if ($_SERVER['REDIRECT_STATUS']) {
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../../index.php'
    }, 3000);
    </script>";
    die;
    exit;
}

require_once("../../../model/authentication.php");
$auth = new model\authentication($koneksi);
require_once("../../../model/karyawan.php");
$employe = new model\karyawan($koneksi);
$employep = new model\KRY_Chagned($koneksi);
require_once("../../../model/bagian.php");
$bagan = new model\bagian($koneksi);
require_once("../../../model/gaji.php");
$paycash = new model\Gajian($koneksi);
require_once("../../../model/absensi.php");
require_once("../../../model/abs.php");
$abs = new model\Absensi($koneksi);
$absen = new model\Abs($koneksi);
require_once("../../../model/gaji.php");
$gajian = new model\Gajian($koneksi);
require_once("../../../model/akun.php");
$akun = new model\Account($koneksi);
require_once("../../../model/jurnal.php");
$jornal = new model\journal($koneksi);
require_once("../../../model/lembur.php");
$lembur = new model\Lembur($koneksi);
require_once("../../../model/potongan.php");
$potongan = new model\percent($koneksi);
require_once("../../../model/tunjangan.php");
$tjngn = new model\tunjangan($koneksi);
# Files Controller
require_once("../../../controller/controller.php");
$login = new controller\LoginAuth($koneksi);
$karyawan = new controller\employee($koneksi);
$bagian = new controller\section($koneksi);
$absensi = new controller\Absen($koneksi);
$gaji = new controller\gaji($koneksi);
$account = new controller\Akun($koneksi);
$jurnal = new controller\jurnal($koneksi);
$lemburan = new controller\Lemburan($koneksi);
$percent = new controller\potongan($koneksi);
$tunjangan = new controller\Tjngan($koneksi);
$change = new controller\changed_profile($koneksi);

#  Files Page / Files Halaman
if (!isset($_GET['page'])):
else:
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'absensi':
            require_once("../absensi/absensi.php");
            break;

        case 'user-profile':
            require_once("../profile/edit.php");
            break;

            # Halaman Khusus Gaji
        case 'gaji':
            require_once("../gaji/gaji.php");
            break;
        case 'gaji_app':
            require_once("../gaji/gaji_app.php");
            break;
        case 'gaji_wait':
            require_once("../gaji/gaji_wait.php");
            break;
        case 'gaji_rej':
            require_once("../gaji/gaji_rej.php");
            break;
        case 'gaji_all':
            require_once("../gaji/gaji_all.php");
            break;
        case 'gaji_lihat':
            require_once("../gaji/gaji_lihat.php");
            break;

        case 'gaji_slip':
            require_once("../gaji/gaji_slip.php");
            break;
        case 'gaji_rekap':
            require_once("../gaji/gaji_rekap.php");
            break;
        case 'gaji_bayar':
            require_once("../gaji/gaji_bayar.php");
            break;
        case 'gaji-cetak':
            require_once("../gaji/gaji_cetak.php");
            break;
            # Halaman Khusus Gaji

            # Halaman Khusus Lembur
        case 'lembur':
            require_once("../lembur/lembur.php");
            break;
            # Halaman Khusus Lembur

            # Halaman Khusus Potongan
        case 'potongan':
            require_once("../potongan/potongan.php");
            break;
            # Halaman Khusus Potongan

            # Halaman Khusus Tunjangan
        case 'tunjangan':
            require_once("../tunjangan/tunjangan.php");
            break;
            # Halaman Khusus Tunjangan

        case 'logout':
            if (isset($_SESSION['status'])) {
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            echo "<script>document.location.href = '../../index.php';</script>";
            exit(0);
            break;
    }
endif;

# Files Action
if (!isset($_GET['aksi'])):
else:
    switch ($_GET['aksi']):
            # Halaman Khusus Karyawan
        case 'lihat-karyawan':
            require_once("../karyawan/lihat.php");
            break;

            # Halaman Khusus Lihat
        case 'lihat-absensi':
            require_once("../absensi/lihat.php");
            break;
        case 'input-absensi':
            require_once("../absensi/input.php");
            break;

            # Halaman Khusus Profile
        case 'perbarui-profile':
            $change->change_profile();
            break;
        case 'perbarui-password':
            $change->change_password();
            break;


            # Halaman Khusus Gaji
        case 'gaji-input':
            require_once("../gaji/gaji_input.php");
            break;
        case 'update-gaji':
            $gaji->gaji_update();
            break;
    endswitch;
endif;
