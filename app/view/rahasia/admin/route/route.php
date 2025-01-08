<?php
require_once("../../../../config/config.php");
$setting = $koneksi->query("SELECT * FROM setting")->fetch_array();
# Cek Invalid Data Admin Table.
if (isset($_SESSION['status'])) {
    # Table database Karyawan
    if (isset($_SESSION['admin'])) {
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['no_telp'])) {
                if (isset($_SESSION['users_akses'])) {
                    if (isset($_SESSION['akses_jabatan'])) {
                        if (isset($_COOKIE['cookies'])) {
                            if (isset($_SERVER['HTTPS'])) {
                                if ($_SERVER['REDIRECT_STATUS']) {
                                    if (isset($_SESSION['nama'])) {
                                    }
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
# Files Model and Controller (MVC)
# Files Model
require_once("../../../../model/authentication.php");
$auth = new model\authentication($koneksi);
require_once("../../../../model/karyawan.php");
$employe = new model\karyawan($koneksi);
require_once("../../../../model/bagian.php");
$bagan = new model\bagian($koneksi);
require_once("../../../../model/gaji.php");
$paycash = new model\Gajian($koneksi);
require_once("../../../../model/absensi.php");
require_once("../../../../model/abs.php");
$abs = new model\Absensi($koneksi);
$absen = new model\Abs($koneksi);
require_once("../../../../model/gaji.php");
$gajian = new model\Gajian($koneksi);
require_once("../../../../model/akun.php");
$akun = new model\Account($koneksi);
require_once("../../../../model/jurnal.php");
$jornal = new model\journal($koneksi);
require_once("../../../../model/lembur.php");
$lembur = new model\Lembur($koneksi);
require_once("../../../../model/potongan.php");
$potongan = new model\percent($koneksi);
require_once("../../../../model/tunjangan.php");
$tjngn = new model\tunjangan($koneksi);
require_once("../../../../model/setting.php");
$setWebsite = new model\settings($koneksi);
require_once("../../../../model/admin.php");
$admins = new model\administration($koneksi);
# Files Controller
require_once("../../../../controller/controller.php");
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
$settings = new controller\perbarui_wesbite($koneksi);
$adm = new controller\perbarui_profile($koneksi);

# Files Page / Files Halaman
if (!isset($_GET['page'])):
else:
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'karyawan':
            require_once("../karyawan/karyawan.php");
            break;

        case 'bagian':
            require_once("../bagian/bagian.php");
            break;

            # Halaman Khusus Gaji
        case 'gaji':
            require_once("../gaji/gaji.php");
            break;

        case 'gaji_app':
            require_once("../gaji/gaji_app.php");
            break;

        case 'gaji_rej':
            require_once("../gaji/gaji_rej.php");
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

        case 'gaji_cetak':
            require_once("../gaji/gaji_cetak.php");
            break;
            # Halaman Khusus Gaji

            # Halaman Khusus Absensi
        case 'absensi':
            require_once("../absensi/absensi.php");
            break;
            # Halaman Khusus Absensi

            # Halaman Khusus Jurnal
        case 'jurnal':
            require_once("../jurnal/jurnal.php");
            break;
        case 'jurnal_cetak':
            require_once("../jurnal/cetak.php");
            break;
        case 'jurnal_gaji':
            require_once("../jurnal/jurnal_gaji.php");
            break;
            # Halaman Khusus Jurnal

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

            # Halaman Khusus Setting & Profile
        case 'settings':
            require_once("../setting/edit.php");
            break;
        case 'user-profile':
            require_once("../profile/edit.php");
            break;
            # Halaman Khusus Setting & Profile

            # Halaman Khusus Akun
        case 'akun':
            require_once("../akun/akun.php");
            break;
            # Halaman Khusus Akun

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

        default:
            require_once("../dashboard/index.php");
            break;
    }
endif;

# Files Action
if (!isset($_GET['aksi'])):
else:
    switch ($_GET['aksi']) {
            # Halaman Khusus Karyawan
        case 'tambah-karyawan':
            require_once("../karyawan/tambah.php");
            break;
        case 'lihat-karyawan':
            require_once("../karyawan/lihat.php");
            break;
        case 'edit-karyawan':
            require_once("../karyawan/ubah.php");
            break;
        case 'karyawan-tambah':
            $karyawan->tambah_karyawan2();
            break;
        case 'karyawan-ubah':
            $karyawan->ubah_karyawan2();
            break;
        case 'karyawan-hapus':
            $karyawan->hapus_karyawan();
            break;
        case 'karyawan-reset':
            $karyawan->password_reset();
            break;
            # Halaman Khusus Karyawan

            # Halaman Khusus Bagian
        case 'tambah-bagian':
            require_once("../bagian/tambah.php");
            break;
        case 'edit-bagian':
            require_once("../bagian/ubah.php");
            break;
        case 'bagian-tambah':
            $bagian->tambah_bagian();
            break;
        case 'bagian-ubah':
            $bagian->ubah_bagian();
            break;
        case 'bagian-hapus':
            $bagian->hapus_bagian();
            break;
            # Halaman Khusus Bagian

            # Halaman Khusus Gaji
        case 'gaji-input':
            require_once("../gaji/gaji_input.php");
            break;
        case 'gaji-tambah':
            require_once("../gaji/gaji_tambah.php");
            break;
        case 'gaji-lihat':
            require_once("../gaji/gaji_lihat.php");
            break;
        case 'input-gaji':
            $gaji->gaji_input();
            break;
            # Halaman Khusus Gaji

            # Halaman Khusus Akun
        case 'tambah-akun':
            require_once("../akun/tambah.php");
            break;
        case 'edit-akun':
            require_once("../akun/edit.php");
            break;
        case 'akun-tambah':
            $account->tambah_akun();
            break;
        case 'akun-edit':
            $account->ubah_akun();
            break;
        case 'akun-hapus':
            $account->hapus_akun();
            break;
            # Halaman Khusus Akun

            # Halaman Khusus Jurnal
        case 'tambah-jurnal':
            require_once("../jurnal/tambah.php");
            break;
        case 'edit-jurnal':
            require_once("../jurnal/edit.php");
            break;
        case 'jurnal-tambah':
            $jurnal->jurnal_tambah();
            break;
        case 'jurnal-edit':
            $jurnal->jurnal_edit();
            break;
        case 'jurnal-hapus':
            $jurnal->jurnal_hapus();
            break;
            # Halaman Khusus Jurnal

            # Halaman Khusus Absensi
        case 'tambah-absensi':
            require_once("../absensi/tambah.php");
            break;
        case 'input-absensi':
            require_once("../absensi/input.php");
            break;
        case 'lihat-absensi':
            require_once("../absensi/lihat.php");
            break;
        case 'absensi-TambahUpdate':
            $absensi->absensi_input();
            break;
        case 'absensi-tambah':
            $absensi->absen_tambah();
            break;
        case 'absensi-hapus':
            $absensi->absensi_hapus();
            break;
            # Halaman Khusus Absensi

            # Halaman Khusus Potongan
        case 'tambah-potongan':
            require_once("../potongan/tambah.php");
            break;
        case 'edit-potongan':
            require_once("../potongan/edit.php");
            break;
        case 'potongan-tambah':
            $percent->potongan_tambah();
            break;
        case 'potongan-edit':
            $percent->potongan_edit();
            break;
        case 'potongan-hapus':
            $percent->potongan_hapus();
            break;
            # Halaman Khusus Potongan

            # Halaman Khusus Tunjangan
        case 'tambah-tunjangan':
            require_once("../tunjangan/tambah.php");
            break;
        case 'edit-tunjangan':
            require_once("../tunjangan/edit.php");
            break;
        case 'tunjangan-tambah':
            $tunjangan->tunjangan_tambah();
            break;
        case 'tunjangan-edit':
            $tunjangan->tunjangan_edit();
            break;
        case 'tunjangan-hapus':
            $tunjangan->tunjangan_hapus();
            break;
            # Halaman Khusus Tunjangan

            # Halaman Khusus Setting Website & Profile
        case 'perbarui-web':
            $settings->perbarui();
            break;
        case 'perbarui-profile':
            $adm->edit_admin();
            break;
        case 'perbarui-password':
            $adm->password_change();
            break;
            # Halaman Khusus Setting Website & Profile

            # Halaman Khusus Lembur
        case 'tambah-lembur':
            require_once("../lembur/tambah.php");
            break;
        case 'edit-lembur':
            require_once("../lembur/edit.php");
            break;
        case 'lembur-tambah':
            $lemburan->lembur_tambah();
            break;
        case 'lembur-ubah':
            $lemburan->lembur_edit();
            break;
        case 'lembur-hapus':
            $lemburan->lembur_hapus();
            break;
            # Halaman Khusus Lembur

        default:
            require_once("../../../../controller/controller.php");
            break;
    }
endif;
