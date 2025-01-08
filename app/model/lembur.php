<?php

namespace model;

use DateTime;

class Lembur
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function lembur()
    {
        $sql = "SELECT lembur.*, karyawan.* FROM lembur, karyawan 
		WHERE karyawan.karyawan_id = lembur.karyawan_id AND karyawan.karyawan_status='Aktif' ORDER BY lembur.lembur_tgl DESC";
        return $this->db->query($sql);
    }

    public function lemburSimpan($kry, $tgl, $mulai, $selesai)
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $mulai = htmlspecialchars($_POST['mulai']);
        $selesai = htmlspecialchars($_POST['selesai']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        //menghitung interval waktu
        $time_in = new DateTime($mulai);
        $time_out = new DateTime($selesai);
        $interval = $time_in->diff($time_out);
        $hrs = $interval->format('%h');
        $mins = $interval->format('%i');
        $mins = $mins / 60;
        $int = $hrs + $mins;
        $intot = $int;

        if ($mulai > $selesai) {
            echo "<script>alert('Waktu Mulai tidak boleh lebih besar dari Waktu Selesai');</script>";
            header("location:../ui/header.php?aksi=tambah-lembur");
            exit(0);
        } else {
            $sql = "INSERT INTO lembur SET lembur_tgl = '$tgl', lembur_jam = '$intot', karyawan_id = '$kry', lembur_mulai ='$mulai', lembur_selesai ='$selesai', lembur_bl ='$bl', lembur_th = '$th'";
            $mysql = $this->db->query($sql);
            if ($mysql != "") {
                if ($mysql) {
                    echo "<script>alert('Tambah Data Berhasil!');</script>";
                    header("location:../ui/header.php?page=lembur");
                    exit(0);
                }
            } else {
                echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
                header("location:../ui/header.php?aksi=tambah-lembur");
                exit(0);
            }
        }
    }

    public function lemburEdit($id, $kry, $tgl, $mulai, $selesai)
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $mulai = htmlspecialchars($_POST['mulai']);
        $selesai = htmlspecialchars($_POST['selesai']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        $time_in = new DateTime($mulai);
        $time_out = new DateTime($selesai);
        $interval = $time_in->diff($time_out);
        $hrs = $interval->format('%h');
        $mins = $interval->format('%i');
        $mins = $mins / 60;
        $int = $hrs + $mins;
        $intot = $int;

        if ($mulai > $selesai) {
            echo "<script>alert('Waktu Mulai tidak boleh lebih besar dari Waktu Selesai');</script>";
            header("location:../ui/header.php?aksi=edit-lembur&lem=$id");
            exit(0);
        } else {
            $sql = "UPDATE lembur SET lembur_tgl = '$tgl', lembur_jam = '$intot', karyawan_id = '$kry', lembur_mulai ='$mulai', lembur_selesai ='$selesai', lembur_bl ='$bl', lembur_th = '$th' WHERE lembur_id = '$id'";
            $mysql = $this->db->query($sql);
            if ($mysql != "") {
                if ($mysql) {
                    echo "<script>alert('Data Berhasil Diubah!');</script>";
                    header("location:../ui/header.php?page=lembur");
                    exit(0);
                }
            } else {
                echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
                header("location:../ui/header.php?aksi=edit-lembur&lem=$id");
                exit(0);
            }
        }
    }

    public function  lemburHapus($id)
    {
        $id = htmlspecialchars($_GET['lem']);
        $sql = "DELETE FROM lembur WHERE lembur_id = '$id'";
        $mysql = $this->db->query($sql);
        if ($mysql) {
            echo "<script>alert('Data Berhasil Dihapus!');</script>";
            header("location:../ui/header.php?page=lembur");
            exit(0);
        } else {
            echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
            header("location:../ui/header.php?page=lembur");
            exit(0);
        }
    }
}