<?php

namespace model;

class bagian
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function bagian()
    {
        $SQL = "SELECT * FROM bagian ORDER BY bagian_nama ASC";
        return $this->db->query($SQL);
    }

    public function tambahbagian($nama, $gaji, $lembur)
    {
        if (empty($_POST["nama"]) || empty($_POST["gaji"]) || empty($_POST["lembur"])):
            header("location:../ui/header.php?aksi=tambah-bagian");
            exit(0);
        else:
            $no = htmlspecialchars($_POST['no']) ? htmlentities($_POST['no']) : trim(strip_tags($_POST['no']));
            $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : trim(strip_tags($_POST['nama']));
            $gaji = (int)htmlspecialchars($_POST['gaji']);
            $lembur = (int)htmlspecialchars($_POST['lembur']);
            # database code insert
            $table = "bagian";
            $insert = "INSERT INTO $table SET bagian_id = '$no', bagian_nama = '$nama', bagian_gaji = '$gaji', bagian_lembur = '$lembur'";
            $mysql = $this->db->query($insert);
            if ($mysql != "") {
                if ($mysql) {
                    header("location:../ui/header.php?page=bagian");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=tambah-bagian");
                exit(0);
            }
        endif;
    }

    public function ubahbagian($nama, $gaji, $lembur, $no)
    {
        $no = htmlspecialchars($_POST['no']) ? htmlentities($_POST['no']) : trim(strip_tags($_POST['no']));
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : trim(strip_tags($_POST['nama']));
        $gaji = (int)htmlspecialchars($_POST['gaji']);
        $lembur = (int)htmlspecialchars($_POST['lembur']);
        # database code update
        $table = "bagian";
        $update = "UPDATE $table SET bagian_nama = '$nama', bagian_gaji = '$gaji', bagian_lembur = '$lembur' WHERE bagian_id = '$no'";
        $mysql = $this->db->query($update);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=bagian");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=edit-bagian&bgn=$no");
            exit(0);
        }
    }

    public function hapusbagian($no)
    {
        $no = htmlspecialchars($_GET['bgn']);
        $delete = "DELETE FROM bagian WHERE bagian_id = '$no'";
        $mysql = $this->db->query($delete);
        if ($mysql) {
            header("location:../ui/header.php?page=bagian");
            exit(0);
        }
    }
}
