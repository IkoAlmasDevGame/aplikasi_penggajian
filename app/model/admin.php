<?php

namespace model;

class administration
{
    protected $table = "admin";
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function edit($id_adm)
    {
        $SQL = "SELECT * FROM $this->table WHERE id_adm = '$id_adm'";
        return $this->db->query($SQL);
    }

    public function profile($username, $nama, $email, $telp, $id)
    {
        $id = htmlspecialchars($_POST['id_adm']);
        $username = htmlspecialchars($_POST['username']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $email = htmlspecialchars($_POST['email']);
        $telp = htmlspecialchars($_POST['no_telp']);
        # Foto adm change
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["foto_adm"]["name"]) ? htmlspecialchars($_FILES["foto_adm"]["name"]) : $_FILES["foto_adm"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['foto_adm']['size'];
        $file_tmp_photo_src = $_FILES['foto_adm']['tmp_name'];
        # setting foto adm
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/admin/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;
            }
        } else {
            echo "Tidak Dapat Ter - Upload Gambar";
            die;
        }
        # cek foto
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE id_adm = '$id'");
        $row = mysqli_fetch_array($mysql);
        # code foto used
        if (isset($_POST['ubahfoto'])) {
            if ($row['foto_adm'] == "") {
                $update = "UPDATE $this->table SET username = '$username', nama_lengkap = '$nama', email = '$email', no_telp = '$telp', foto_adm = '$photo_src' WHERE id_adm = '$id'";
                $data = $this->db->query($update);
                if ($data != "") {
                    if ($data) {
                        header("location:../ui/header.php?page=user-profile&id_adm=$id");
                        exit(0);
                    }
                } else {
                    header("location:../ui/header.php?page=user-profile&id_adm=$id&data=$id");
                    exit(0);
                }
            } else if ($row['foto_adm'] != "") {
                if ($photo_src != "") {
                    $update = "UPDATE $this->table SET username = '$username', nama_lengkap = '$nama', email = '$email', no_telp = '$telp', foto_adm = '$photo_src' WHERE id_adm = '$id'";
                    $data = $this->db->query($update);
                    unlink("../../../../assets/admin/$row[foto_adm]");
                    if ($data != "") {
                        if ($data) {
                            header("location:../ui/header.php?page=user-profile&id_adm=$id");
                            exit(0);
                        }
                    } else {
                        header("location:../ui/header.php?page=user-profile&id_adm=$id&data=$id");
                        exit(0);
                    }
                }
            }
        }
    }

    public function changepassword($new_password, $id)
    {
        $new_password = md5(htmlspecialchars($_POST['new_password']), false);
        $old_password = md5(htmlspecialchars($_POST['old_password']), false);
        $new_password_verify = md5(htmlspecialchars($_POST['new_password_verify']), false);
        $id = htmlspecialchars($_POST['id_adm']);
        # database password
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE id_adm = '$id'");
        $row = mysqli_fetch_array($mysql);
        # cek update password
        if (password_verify($old_password, PASSWORD_DEFAULT) == md5($row['password'], false)) {
            header("location:../ui/header.php?page=user-profile&id_adm=$id&change=$id");
            exit(0);
        }
        # change password yang terbaru ...
        if ($new_password == $new_password_verify) {
            $SQL = "UPDATE $this->table SET password = '$new_password' WHERE id_adm = '$id'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=user-profile&id_adm=$id");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=user-profile&id_adm=$id&change=$id");
                exit(0);
            }
        }
    }
}
