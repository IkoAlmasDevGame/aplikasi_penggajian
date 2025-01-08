<?php

namespace model;

class user
{
    protected $table = "user";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function users()
    {
        $SQL = "SELECT user.*, karyawan.*, bagian.* FROM user, karyawan, bagian WHERE user.karyawan_id = karyawan.karyawan_id and karyawan.bagian_id = bagian.bagian_id ORDER BY karyawan.karyawan_nama ASC";
        return $this->db->query($SQL);
    }

    public function users_data($usr)
    {
        $SQL = "SELECT user.*, karyawan.* FROM user, karyawan WHERE user.karyawan_id = karyawan.karyawan_id AND user.user_id = '$usr'";
        return $this->db->query($SQL);
    }

    public function tambah_users($kry, $jenis)
    {
        $kry = htmlspecialchars($_POST['kry']);
        $jenis = htmlspecialchars($_POST['jenis']);
        $stt = "Aktif";
        $insert = "INSERT INTO $this->table SET karyawan_id = '$kry', user_akses = '$jenis', user_stt = '$stt'";
        $data = $this->db->query($insert);
        if ($data != "") {
            if ($data) {
                header("location:../ui/header.php?page=users-data");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=users-tambah");
            exit(0);
        }
    }

    public function edit_users($jenis, $stt, $id)
    {
        $jenis = htmlspecialchars($_POST['jenis']);
        $stt = htmlspecialchars($_POST['stt']);
        $id = htmlspecialchars($_POST['id']);
        $update = "UPDATE $this->table SET user_akses = '$jenis', user_stt = '$stt' WHERE user_id = '$id'";
        $data = $this->db->query($update);
        if ($data != "") {
            if ($data) {
                header("location:../ui/header.php?page=users-data");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?aksi=users-edit&usr=$id");
            exit(0);
        }
    }

    public function hapus_users($id)
    {
        $id = htmlspecialchars($_GET['id']);
        $delete = "DELETE FROM $this->table WHERE user_id = '$id'";
        $data = $this->db->query($delete);
        if ($data != "") {
            if ($data) {
                header("location:../ui/header.php?page=users-data");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=users-data");
            exit(0);
        }
    }
}
