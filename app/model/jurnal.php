<?php

namespace model;

class journal
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function jurnal()
    {
        $SQL = "SELECT jurnal.*, akun.* FROM jurnal, akun WHERE jurnal.akun_kode=akun.akun_kode AND jurnal.akun_kode!='0' ORDER BY jurnal.jurnal_tgl DESC";
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

    public function tambah_jurnal($no, $akun, $tgl, $jml, $ket, $ref)
    {
        $no = htmlspecialchars($_POST['trx']);
        $akun = htmlspecialchars($_POST['akun']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $ref = htmlspecialchars($_POST['ref']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);
        # kodingan insert table
        $tabel = "jurnal";
        $insert = "INSERT INTO $tabel SET jurnal_trx = '$no', jurnal_reff = '$ref', jurnal_tgl = '$tgl', akun_kode = '$akun', jurnal_jml = '$jml', jurnal_ket = '$ket', jurnal_bl = '$bl', jurnal_th = '$th'";
        $data = $this->db->query($insert);
        if ($data != "") {
            if ($data) {
                header("location:../ui/header.php?page=jurnal");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=tambah-jurnal");
            exit(0);
        }
    }

    public function edit_jurnal($trx, $akun, $tgl, $jml, $ket, $ref)
    {
        $trx = htmlspecialchars($_POST['trx']);
        $akun = htmlspecialchars($_POST['akun']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $ref = htmlspecialchars($_POST['ref']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);
        # kodingan insert table
        $tabel = "jurnal";
        $update = "UPDATE $tabel SET jurnal_reff = '$ref', jurnal_tgl = '$tgl', akun_kode = '$akun', jurnal_jml = '$jml', jurnal_ket = '$ket', jurnal_bl = '$bl', jurnal_th = '$th' WHERE jurnal_trx = '$trx'";
        if ($this->db->query($update)) {
            header("location:../ui/header.php?page=jurnal");
            exit(0);
        } else {
            header("location:../ui/header.php?aksi=edit-jurnal&aksi=edit-jurnal&trx=$trx");
            exit(0);
        }
    }

    public function hapus_jurnal($trx)
    {
        $trx = htmlspecialchars($_GET['trx']);
        $tabel = "jurnal";
        $delete = "DELETE FROM $tabel WHERE jurnal_trx = '$trx'";
        if ($this->db->query($delete)) {
            header("location:../ui/header.php?page=jurnal");
            exit(0);
        } else {
            header("location:../ui/header.php?page=jurnal");
            exit(0);
        }
    }
}