<?php

namespace controller;

use model\Abs;
use model\Account;
use model\administration;
use model\authentication;
use model\bagian;
use model\Gajian;
use model\journal;
use model\karyawan;
use model\Lembur;
use model\manageration;
use model\percent;
use model\settings;
use model\tunjangan;
use model\user;
use model\Authentication2;
use model\KRY_Chagned;

class LoginAuth
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new authentication($konfig);
    }

    public function Login()
    {
        session_start();
        $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : trim(strip_tags($_POST['userInput']));
        $passInput = md5(htmlspecialchars($_POST['password']), false);
        $mysql = $this->konfig->AuthLogin($userInput, $passInput);
        if ($mysql === true) {
            return true;
        } else {
            return false;
        }
    }
}

class LoginAuth2
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new authentication2($konfig);
    }

    public function Login2()
    {
        session_start();
        $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : trim(strip_tags($_POST['userInput']));
        $passInput = md5(htmlspecialchars($_POST['password']), false);
        $mysql = $this->konfig->AuthLogin2($userInput, $passInput);
        if ($mysql === true) {
            return true;
        } else {
            return false;
        }
    }
}

class employee
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new karyawan($konfig);
    }

    public function tambah_karyawan()
    {
        $id = htmlspecialchars($_POST['id']);
        $nama = htmlspecialchars($_POST['nama']);
        $jk = htmlspecialchars($_POST['jk']);
        $telp = htmlspecialchars($_POST['telp']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $tpt = htmlspecialchars($_POST['tpt']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $bgn = htmlspecialchars($_POST['bgn']);
        $mulai = htmlspecialchars($_POST['krj']);
        $data = $this->konfig->tambahkaryawan($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_karyawan()
    {
        $idold = htmlspecialchars($_POST['idold']);
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $jk = htmlspecialchars($_POST['karyawan_jk']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        $alamat = htmlspecialchars($_POST['karyawan_alamat']);
        $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
        $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
        $bgn = htmlspecialchars($_POST['bagian_id']);
        $mulai = htmlspecialchars($_POST['karyawan_masuk']);
        $stt = htmlspecialchars($_POST['karyawan_status']);
        $data = $this->konfig->ubahkaryawan($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai, $stt, $idold);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function tambah_karyawan2()
    {
        $id = htmlspecialchars($_POST['id']);
        $nama = htmlspecialchars($_POST['nama']);
        $jk = htmlspecialchars($_POST['jk']);
        $telp = htmlspecialchars($_POST['telp']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $tpt = htmlspecialchars($_POST['tpt']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $bgn = htmlspecialchars($_POST['bgn']);
        $mulai = htmlspecialchars($_POST['krj']);
        $data = $this->konfig->tambahkaryawan($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_karyawan2()
    {
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $jk = htmlspecialchars($_POST['karyawan_jk']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        $alamat = htmlspecialchars($_POST['karyawan_alamat']);
        $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
        $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
        $bgn = htmlspecialchars($_POST['bagian_id']);
        $mulai = htmlspecialchars($_POST['karyawan_masuk']);
        $stt = htmlspecialchars($_POST['karyawan_status']);
        $data = $this->konfig->ubahkaryawan2($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai, $stt);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_karyawan()
    {
        $karyawan_id = htmlspecialchars($_GET['kry']);
        $data = $this->konfig->hapuskaryawan($karyawan_id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function password_reset()
    {
        $id = $_GET['kry'];
        # database reset password
        $pass = htmlspecialchars(md5($id));
        $data = $this->konfig->reset_password($pass, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class changed_profile
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new KRY_Chagned($konfig);
    }

    public function change_profile()
    {
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        $data = $this->konfig->profile($nama, $telp, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function change_password()
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $id = htmlspecialchars($_POST['karyawan_id']);
        $data = $this->konfig->changepassword($new_password, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class section
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new bagian($konfig);
    }

    public function tambah_bagian()
    {
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : trim(strip_tags($_POST['nama']));
        $gaji = (int)htmlspecialchars($_POST['gaji']);
        $lembur = (int)htmlspecialchars($_POST['lembur']);
        $mysql = $this->konfig->tambahbagian($nama, $gaji, $lembur);
        if ($mysql === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_bagian()
    {
        $no = htmlspecialchars($_POST['no']) ? htmlentities($_POST['no']) : trim(strip_tags($_POST['no']));
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : trim(strip_tags($_POST['nama']));
        $gaji = (int)htmlspecialchars($_POST['gaji']);
        $lembur = (int)htmlspecialchars($_POST['lembur']);
        $mysql = $this->konfig->ubahbagian($nama, $gaji, $lembur, $no);
        if ($mysql === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_bagian()
    {
        $no = htmlspecialchars($_GET['bgn']);
        $mysql = $this->konfig->hapusbagian($no);
        if ($mysql === true) {
            return true;
        } else {
            return false;
        }
    }
}

class Absen
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Abs($konfig);
    }

    public function absen_tambah()
    {
        $bln = htmlspecialchars($_POST['bln']);
        $thn = htmlspecialchars($_POST['thn']);
        $data = $this->konfig->tambah_abs($bln, $thn);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function absensi_input()
    {
        $id = htmlspecialchars($_POST['id']);
        $abs = htmlspecialchars($_POST['abs']);
        $rows = htmlspecialchars($_POST['rows']);
        $h = htmlspecialchars($_POST['h']);
        $s = htmlspecialchars($_POST['s']);
        $i = htmlspecialchars($_POST['i']);
        $a = htmlspecialchars($_POST['a']);
        $data = $this->konfig->input_absensi($id, $abs, $rows, $h, $s, $i, $a);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function absensi_hapus()
    {
        $abs = htmlspecialchars($_GET['abs']);
        $data = $this->konfig->hapus_abs($abs);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class gaji
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Gajian($konfig);
    }

    public function gaji_input()
    {
        $id = $_POST['id'];
        $abs = $_POST['abs'];
        $via = $_POST['via'];
        $bl = $_POST['bl'];
        $th = $_POST['th'];
        $ket = $_POST['ket'];
        $data = $this->konfig->input_gaji($id, $abs, $via, $bl, $th, $ket);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function gaji_update()
    {
        $id = $_POST['id'];
        $no = $_POST['no'];
        $via = $_POST['via'];
        $gapok = $_POST['gapok'];
        $tjg = $_POST['tjg'];
        $lembur = $_POST['lembur'];
        $pot = $_POST['pot'];
        $bersih = $_POST['bersih'];
        $ket = $_POST['ket'];
        $app = $_POST['app'];
        $data = $this->konfig->update_gaji($id, $no, $via, $gapok, $tjg, $lembur, $pot, $bersih, $ket, $app);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class Akun
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Account($konfig);
    }

    public function tambah_akun()
    {
        $akun_kode = htmlspecialchars($_POST['akun_kode']);
        $akun_nama = htmlspecialchars($_POST['akun_nama']);
        $data = $this->konfig->akun_tambah($akun_kode, $akun_nama);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_akun()
    {
        $akun_kode = htmlspecialchars($_POST['akun_kode']);
        $akun_nama = htmlspecialchars($_POST['akun_nama']);
        $data = $this->konfig->akun_ubah($akun_kode, $akun_nama);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_akun()
    {
        $id = htmlspecialchars($_GET['akn']);
        $data = $this->konfig->akun_hapus($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class jurnal
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new journal($konfig);
    }

    public function jurnal_tambah()
    {
        $no = htmlspecialchars($_POST['trx']);
        $akun = htmlspecialchars($_POST['akun']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $ref = htmlspecialchars($_POST['ref']);
        $data = $this->konfig->tambah_jurnal($no, $akun, $tgl, $jml, $ket, $ref);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function jurnal_edit()
    {
        $trx = htmlspecialchars($_POST['trx']);
        $akun = htmlspecialchars($_POST['akun']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $ref = htmlspecialchars($_POST['ref']);
        $data = $this->konfig->edit_jurnal($trx, $akun, $tgl, $jml, $ket, $ref);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function jurnal_hapus()
    {
        $trx = htmlspecialchars($_GET['trx']);
        $data = $this->konfig->hapus_jurnal($trx);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class Lemburan
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Lembur($konfig);
    }

    public function lembur_tambah()
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $mulai = htmlspecialchars($_POST['mulai']);
        $selesai = htmlspecialchars($_POST['selesai']);
        $data = $this->konfig->lemburSimpan($kry, $tgl, $mulai, $selesai);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function lembur_edit()
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $mulai = htmlspecialchars($_POST['mulai']);
        $selesai = htmlspecialchars($_POST['selesai']);
        $data = $this->konfig->lemburEdit($id, $kry, $tgl, $mulai, $selesai);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function lembur_hapus()
    {
        $id = htmlspecialchars($_GET['lem']);
        $data = $this->konfig->lemburHapus($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class potongan
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new percent($konfig);
    }

    public function potongan_tambah()
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $data = $this->konfig->potongansimpan($kry, $tgl, $jml, $ket);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function potongan_edit()
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $data = $this->konfig->potonganedit($id, $kry, $tgl, $jml, $ket);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function potongan_hapus()
    {
        $id = htmlspecialchars($_GET['pot']);
        $data = $this->konfig->potonganhapus($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class Tjngan
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new tunjangan($konfig);
    }

    public function tunjangan_tambah()
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $data = $this->konfig->tunjangansimpan($kry, $tgl, $jml, $ket);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function tunjangan_edit()
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $data = $this->konfig->tunjanganedit($id, $kry, $tgl, $jml, $ket);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function tunjangan_hapus()
    {
        $id = htmlspecialchars($_GET['tjg']);
        $data = $this->konfig->tunjanganhapus($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class perbarui_wesbite
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new settings($konfig);
    }

    public function perbarui()
    {
        $id = htmlspecialchars($_POST['id_setting']);
        $website = htmlspecialchars($_POST['nama_website']);
        $nama = htmlspecialchars($_POST['nama_pemilik']);
        $status = htmlspecialchars($_POST['status_website']);
        $data = $this->konfig->setting($website, $nama, $status, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class perbarui_profile
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new administration($konfig);
    }

    public function edit_admin()
    {
        $id = htmlspecialchars($_POST['id_adm']);
        $username = htmlspecialchars($_POST['username']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $email = htmlspecialchars($_POST['email']);
        $telp = htmlspecialchars($_POST['no_telp']);
        $data = $this->konfig->profile($username, $nama, $email, $telp, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function password_change()
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $id = htmlspecialchars($_POST['id_adm']);
        $data = $this->konfig->changepassword($new_password, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class perbarui_profile2
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new manageration($konfig);
    }

    public function edit_manager()
    {
        $id = htmlspecialchars($_POST['id_mng']);
        $username = htmlspecialchars($_POST['username']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $email = htmlspecialchars($_POST['email']);
        $telp = htmlspecialchars($_POST['no_telp']);
        $data = $this->konfig->profile($username, $nama, $email, $telp, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function password_change()
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $id = htmlspecialchars($_POST['id_mngs']);
        $data = $this->konfig->changepassword($new_password, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class users
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new user($konfig);
    }

    public function users_tambah()
    {
        $kry = htmlspecialchars($_POST['kry']);
        $jenis = htmlspecialchars($_POST['jenis']);
        $data = $this->konfig->tambah_users($kry, $jenis);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function users_edit()
    {
        $jenis = htmlspecialchars($_POST['jenis']);
        $stt = htmlspecialchars($_POST['stt']);
        $id = htmlspecialchars($_POST['id']);
        $data = $this->konfig->edit_users($jenis, $stt, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function users_hapus()
    {
        $id = htmlspecialchars($_GET['id']);
        $data = $this->konfig->hapus_users($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}
