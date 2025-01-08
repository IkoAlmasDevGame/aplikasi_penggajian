<?php

namespace model;

class tunjangan
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function tunjangan()
    {
        $sql = "SELECT tunjangan.*, karyawan.* FROM tunjangan, karyawan WHERE karyawan.karyawan_id = tunjangan.karyawan_id AND karyawan.karyawan_status='Aktif'
		ORDER BY tunjangan.tjg_tgl DESC";
        return $this->db->query($sql);
    }

    public function tunjangansimpan($kry, $tgl, $jml, $ket)
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        $table = "tunjangan";
        $sql = "INSERT INTO $table SET karyawan_id = '$kry', tjg_tgl = '$tgl', tjg_jml ='$jml', tjg_ket = '$ket', tjg_bl = '$bl', tjg_th = '$th'";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=tunjangan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=tambah-tunjangan");
            exit(0);
        }
    }
    public function tunjanganedit($id, $kry, $tgl, $jml, $ket)
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        $table = "tunjangan";
        $sql = "UPDATE $table SET karyawan_id = '$kry', tjg_tgl = '$tgl', tjg_jml ='$jml', tjg_ket = '$ket', tjg_bl = '$bl', tjg_th = '$th' WHERE tjg_id = $id";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=tunjangan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=edit-tunjangan&tjg=$id");
            exit(0);
        }
    }

    public function tunjanganhapus($id)
    {
        $id = htmlspecialchars($_GET['tjg']);
        $table = "tunjangan";
        $sql = "DELETE FROM $table WHERE tjg_id = $id";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=tunjangan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=tunjangan");
            exit(0);
        }
    }
}