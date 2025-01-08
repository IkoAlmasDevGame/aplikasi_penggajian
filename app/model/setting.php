<?php

namespace model;

class settings
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setting($website, $nama, $status, $id)
    {
        $id = htmlspecialchars($_POST['id_setting']);
        $website = htmlspecialchars($_POST['nama_website']);
        $nama = htmlspecialchars($_POST['nama_pemilik']);
        $status = htmlspecialchars($_POST['status_website']);
        $SQL = "UPDATE setting SET nama_pemilik='$nama', nama_website='$website', status_website='$status' WHERE id_setting = '$id'";
        $mysql = $this->db->query($SQL);
        if ($mysql != "") {
            if ($mysql) {
                header("location:../ui/header.php?page=settings&id_setting=$id");
                exit(0);
            }
        } else {
            header("location:../ui/header.php?page=beranda");
            exit(0);
        }
    }
}