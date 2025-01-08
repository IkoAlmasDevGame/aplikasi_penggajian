<?php

namespace model;

class Abs
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function tambah_abs($bln, $thn)
    {
        $bln = htmlspecialchars($_POST['bln']);
        $thn = htmlspecialchars($_POST['thn']);

        if ($bln == "01") {
            $bl = "Januari";
        } else if ($bln == "02") {
            $bl = "Februari";
        } else if ($bln == "03") {
            $bl = "Maret";
        } else if ($bln == "04") {
            $bl = "April";
        } else if ($bln == "05") {
            $bl = "Mei";
        } else if ($bln == "06") {
            $bl = "Juni";
        } else if ($bln == "07") {
            $bl = "Juli";
        } else if ($bln == "08") {
            $bl = "Agustus";
        } else if ($bln == "09") {
            $bl = "September";
        } else if ($bln == "10") {
            $bl = "Oktober";
        } else if ($bln == "11") {
            $bl = "November";
        } else {
            $bl = "Desember";
        }

        $SQL = "SELECT * FROM abs WHERE abs_bl = '$bln' and abs_th = '$thn'";
        $mysql = $this->db->query($SQL);
        $row = mysqli_num_rows($mysql);
        if ($row > 0) {
            header("location:../ui/header.php?aksi=tambah-absensi");
            exit(0);
        } else {
            $insert = "INSERT INTO abs SET abs_bl = '$bln', abs_bln = '$bl', abs_th = '$thn'";
            $data = $this->db->query($insert);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=absensi");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=tambah-absensi");
                exit(0);
            }
        }
    }

    public function input_absensi($id, $abs, $rows, $h, $s, $i, $a)
    {
        # input and update ....
        $id = htmlspecialchars($_POST['id']);
        $abs = htmlspecialchars($_POST['abs']);
        $rows = htmlspecialchars($_POST['rows']);
        $h = htmlspecialchars($_POST['h']);
        $s = htmlspecialchars($_POST['s']);
        $i = htmlspecialchars($_POST['i']);
        $a = htmlspecialchars($_POST['a']);
        # cek data absensi pada karyawan
        if ($rows > 0) {
            $update = "UPDATE absensi SET absensi_h = '$h', absensi_s = '$s', absensi_i = '$i', absensi_a = '$a' WHERE karyawan_id = '$id' and abs_id = '$abs'";
            $data = $this->db->query($update);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?aksi=lihat-absensi&abs=$abs");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=input-absensi&kry=$id&abs=$abs");
                exit(0);
            }
        } else {
            $SQL = "INSERT INTO absensi SET abs_id = '$abs', karyawan_id = '$id', absensi_h = '$h', absensi_s = '$s', absensi_i = '$i', absensi_a = '$a'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?aksi=lihat-absensi&abs=$abs");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=input-absensi&kry=$id&abs=$abs");
                exit(0);
            }
        }
    }

    public function hapus_abs($abs)
    {
        $abs = htmlspecialchars($_GET['abs']);
        $sql = "DELETE FROM abs WHERE abs_id = '$abs'";
        $ress = $this->db->query($sql);
        $sql2 = "DELETE FROM absensi WHERE abs_id = '$abs'";
        $ress2 = $this->db->query($sql2);
        $this->db->query("DELETE FROM gaji_karyawan WHERE abs_id = '$abs'");
        if ($ress && $ress2) {
            header("location:../ui/header.php?page=absensi");
            exit(0);
        }
    }
}