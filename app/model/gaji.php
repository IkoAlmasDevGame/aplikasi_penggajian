<?php

namespace model;

class Gajian
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function gaji()
    {
        $SQL = "SELECT * FROM abs ORDER BY abs_id DESC";
        return $this->db->query($SQL);
    }

    public function gaji_all($abs)
    {
        $SQL = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian WHERE karyawan.bagian_id = bagian.bagian_id AND gaji_karyawan.karyawan_id = karyawan.karyawan_id 
        AND gaji_karyawan.abs_id='$abs'";
        return $this->db->query($SQL);
    }

    public function gaji_wait($abs)
    {
        $SQL = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian WHERE karyawan.bagian_id = bagian.bagian_id AND gaji_karyawan.karyawan_id = karyawan.karyawan_id 
		AND gaji_karyawan.gaj_stt='Menunggu Approval' AND gaji_karyawan.abs_id='$abs'";
        return $this->db->query($SQL);
    }

    public function reject($abs)
    {
        $SQL = "SELECT gaji_karyawan.*, karyawan.*, bagian.* FROM gaji_karyawan, karyawan, bagian WHERE karyawan.bagian_id = bagian.bagian_id AND gaji_karyawan.karyawan_id = karyawan.karyawan_id 
		AND gaji_karyawan.gaj_stt='Rejected' AND gaji_karyawan.abs_id='$abs'";
        return $this->db->query($SQL);
    }

    public function buatKode($tabel, $inisial)
    {
        # buat kode ...
        $struktur = $this->db->query("SELECT * FROM $tabel LIMIT 1");
        $field = mysqli_fetch_field_direct($struktur, 0)->name;
        $panjang = mysqli_fetch_field_direct($struktur, 0)->length;
        $mysql = $this->db->query("SELECT MAX(" . $field . ") FROM " . $tabel);
        $row = mysqli_fetch_array($mysql);
        if ($row[0] == "") {
            $angka = 0;
        } else {
            $angka = substr($row[0], strlen($inisial));
        }
        $angka++;
        $angka = strval($angka);
        $tmp = "";
        for ($i = 25; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
            $tmp = $tmp . "0";
        }
        return $inisial . $tmp . $angka;
    }

    public function update_gaji($id, $no, $via, $gapok, $tjg, $lembur, $pot, $bersih, $ket, $app)
    {
        $id = $_POST['id'];
        $no = $_POST['no'];
        $abs = $_POST['abs'];
        $via = $_POST['via'];
        $gapok = $_POST['gapok'];
        $tjg = $_POST['tjg'];
        $lembur = $_POST['lembur'];
        $pot = $_POST['pot'];
        $bersih = $_POST['bersih'];
        $ket = $_POST['ket'];
        $app = $_POST['app'];
        $now = date('Y-m-d');
        $bln = $_POST['bln'];
        $th = $_POST['th'];
        $bl = $_POST['bl'];
        # Ketjur
        $ketjur = "Gaji Bulan " . $bln . "-" . $th;

        function buatKode($tabel, $inisial)
        {
            global $koneksi;
            # Buat Kode
            $struktur = $koneksi->query("SELECT * FROM $tabel LIMIT 1");
            $field = mysqli_fetch_field_direct($struktur, 0)->name;
            $panjang = mysqli_fetch_field_direct($struktur, 0)->length;
            $mysql = $koneksi->query("SELECT MAX(" . $field . ") FROM " . $tabel);
            $row = mysqli_fetch_array($mysql);
            if ($row[0] == "") {
                $angka = 0;
            } else {
                $angka = substr($row[0], strlen($inisial));
            }
            $angka++;
            $angka = strval($angka);
            $tmp = "";
            for ($i = 25; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
                $tmp = $tmp . "0";
            }
            return $inisial . $tmp . $angka;
        }

        $tabel = "jurnal";
        $inisial = "TRX";
        $noj = buatKode($tabel, $inisial);

        if ($app == "Approved") {
            $SQL = "UPDATE gaji_karyawan SET gaj_lembur = '$lembur', gaj_tjg = '$tjg', gaj_pot = '$pot', gaj_pok = '$gapok', gaj_stt = '$app', gaj_bersih = '$bersih', gaj_pay = '$via', gaj_tgl = '$now', gaj_ket = '$ket' WHERE gaj_no = '$no'";
            $data = $this->db->query($SQL);
            $SQLjur = "INSERT INTO $tabel SET jurnal_trx = '$noj', jurnal_reff ='$no', jurnal_tgl ='$now', akun_kode ='0', jurnal_jml ='$bersih',  jurnal_ket ='$ketjur', jurnal_bl ='$bl', jurnal_th = '$th'";
            $this->db->query($SQLjur);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=gaji_wait&abs=$abs");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=gaji-input&kry=$id&abs=$abs&no=$no");
                exit(0);
            }
        } else {
            $SqlK = "UPDATE gaji_karyawan SET gaj_stt = '$app', gaj_pay = '$via', gaj_ket = '$ket' wHERE gaj_no = '$no'";
            $dataK = $this->db->query($SqlK);
            if ($dataK != "") {
                if ($dataK) {
                    header("location:../ui/header.php?page=gaji_wait&abs=$abs");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=gaji-input&kry=$id&abs=$abs&no=$no");
                exit(0);
            }
        }
    }

    public function input_gaji($id, $abs, $via, $bl, $th, $ket)
    {
        $id = $_POST['id'];
        $abs = $_POST['abs'];
        $via = $_POST['via'];
        $bl = $_POST['bl'];
        $th = $_POST['th'];
        $ket = $_POST['ket'];
        $num = $id . '-' . $bl . $th;
        $stt = "Menunggu Approval";
        $nol = 0;
        $dnol = "0000-00-00";

        # cek accepted waiting approve
        $SQL = "SELECT * FROM gaji_karyawan WHERE gaj_no = '$num'";
        $mysql = $this->db->query($SQL);
        $cek = mysqli_num_rows($mysql);
        if ($cek > 0) {
            $SQL = "UPDATE gaji_karyawan SET gaj_stt = '$stt', gaj_pay = '$via', gaj_ket = '$ket' WHERE gaj_no = '$num'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?aksi=gaji-lihat&abs=$abs");
                    exit(0);
                }
            } else {
                header("../ui/header.php?aksi=gaji-input&kry=$id&abs=$abs");
                exit(0);
            }
        } else {
            $SQL = "INSERT INTO gaji_karyawan SET gaj_no = '$num', karyawan_id = '$id', abs_id = '$abs', gaj_lembur = '$nol', gaj_tjg = '$nol', gaj_pot = '$nol', gaj_stt = '$stt',
             gaj_pok = '$nol', gaj_bersih = '$nol', gaj_pay = '$via', gaj_tgl = '$dnol', gaj_ket = '$ket'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?aksi=gaji-lihat&abs=$abs");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=gaji-input&kry=$id&abs=$abs");
                exit(0);
            }
        }
    }
}
