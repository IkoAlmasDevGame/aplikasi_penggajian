<?php

namespace model;

class percent
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function potongan()
    {
        $sql = "SELECT potongan.*, karyawan.* FROM potongan, karyawan 
        WHERE karyawan.karyawan_id = potongan.karyawan_id AND karyawan.karyawan_status='Aktif'
		ORDER BY potongan.pot_tgl DESC ";
        return $this->db->query($sql);
    }

    public function potongansimpan($kry, $tgl, $jml, $ket)
    {
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        $table = "potongan";
        $sql = "INSERT INTO $table SET karyawan_id = '$kry', pot_tgl = '$tgl', pot_jml ='$jml', pot_ket = '$ket', pot_bl = '$bl', pot_th = '$th'";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=potongan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=tambah-potongan");
            exit(0);
        }
    }
    public function potonganedit($id, $kry, $tgl, $jml, $ket)
    {
        $id = htmlspecialchars($_POST['id']);
        $kry = htmlspecialchars($_POST['kry']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jml = htmlspecialchars($_POST['jml']);
        $ket = htmlspecialchars($_POST['ket']);
        $bl = substr($tgl, 5, 2);
        $th = substr($tgl, 0, 4);

        $table = "potongan";
        $sql = "UPDATE $table SET karyawan_id = '$kry', pot_tgl = '$tgl', pot_jml ='$jml', pot_ket = '$ket', pot_bl = '$bl', pot_th = '$th' WHERE pot_id = $id";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=potongan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=edit-potongan&pot=$id");
            exit(0);
        }
    }

    public function potonganhapus($id)
    {
        $id = htmlspecialchars($_GET['pot']);
        $table = "potongan";
        $sql = "DELETE FROM $table WHERE pot_id = $id";
        $mysql = $this->db->query($sql);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=potongan");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=potongan");
            exit(0);
        }
    }
}
