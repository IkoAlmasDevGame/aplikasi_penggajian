<?php

namespace model;

class Account
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function akun()
    {
        $SQL = "SELECT * FROM akun WHERE akun_kode!='0' ORDER BY akun_kode ASC";
        return $this->db->query($SQL);
    }

    public function akun_edit($akn)
    {
        $SQL = "SELECT * FROM akun WHERE akun_kode = '$akn' ORDER BY akun_kode ASC";
        return $this->db->query($SQL);
    }

    public function akun_tambah($akun_kode, $akun_nama)
    {
        if (empty($_POST['akun_kode']) || empty($_POST['akun_nama'])):
            header("location:../ui/header.php?aksi=tambah-akun");
            exit(0);
        else:
            $akun_kode = htmlspecialchars($_POST['akun_kode']);
            $akun_nama = htmlspecialchars($_POST['akun_nama']);
            # table
            $table = "akun";
            $SQL = "SELECT * FROM $table WHERE akun_nama = '$akun_nama' order by akun_nama desc";
            $mysql = $this->db->query($SQL);
            $cek = mysqli_num_rows($mysql);
            if ($cek > 0) {
                header("");
                exit(0);
            } else {
                $insert = "INSERT INTO $table SET akun_kode = '$akun_kode', akun_nama = '$akun_nama'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    if ($data) {
                        header("location:../ui/header.php?page=akun");
                        exit(0);
                    }
                } else {
                    header("location:../ui/header.php?aksi=tambah-akun");
                    exit(0);
                }
            }
        endif;
    }

    public function akun_ubah($akun_kode, $akun_nama)
    {
        $akun_kode = htmlspecialchars($_POST['akun_kode']);
        $akun_nama = htmlspecialchars($_POST['akun_nama']);
        # table
        $table = "akun";
        $update = "UPDATE $table SET akun_nama = '$akun_nama' WHERE akun_kode = '$akun_kode'";
        $data = $this->db->query($update);
        if ($data != "") {
            if ($data) {
                header("location:../ui/header.php?page=akun");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=edit-akun&akn=$akun_kode");
            exit(0);
        }
    }

    public function akun_hapus($id)
    {
        $id = htmlspecialchars($_GET['akn']);
        # table
        $table = "akun";
        $delete = "DELETE FROM $table WHERE akun_kode = '$id'";
        $mysql = $this->db->query($delete);
        if ($mysql) {
            header("location:../ui/header.php?page=akun");
            exit(0);
        } else {
            header("location:../ui/header.php?page=akun");
            exit(0);
        }
    }
}
