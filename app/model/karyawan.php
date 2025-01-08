<?php

namespace model;

class karyawan
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function karyawan()
    {
        $SQL = "SELECT * FROM karyawan JOIN bagian ON karyawan.bagian_id = bagian.bagian_id ORDER BY karyawan.karyawan_nama ASC";
        return $this->db->query($SQL);
    }

    public function edit($karyawan_id)
    {
        $SQL = "SELECT * FROM karyawan JOIN bagian ON karyawan.bagian_id = bagian.bagian_id WHERE karyawan_id = '$karyawan_id'";
        return $this->db->query($SQL);
    }

    public function tambahkaryawan($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai)
    {
        if (
            empty($_POST['karyawan_id']) || empty($_POST['karyawan_nama']) || empty($_POST['karyawan_jk']) || empty($_POST['karyawan_telp']) || empty($_POST['karyawan_alamat']) ||
            empty($_POST['karyawan_tptlhr']) || empty($_POST['karyawan_tgllhr']) || empty($_POST['bagian_id']) || empty($_POST['karyawan_masuk'])
        ):
            header("location:../ui/header.php?aksi=tambah-karyawan");
            exit(0);
        else:
            $id_adm = htmlspecialchars($_POST['id_adm']);
            $id = htmlspecialchars($_POST['karyawan_id']);
            $nama = htmlspecialchars($_POST['karyawan_nama']);
            $jk = htmlspecialchars($_POST['karyawan_jk']);
            $telp = htmlspecialchars($_POST['karyawan_telp']);
            $alamat = htmlspecialchars($_POST['karyawan_alamat']);
            $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
            $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
            $bgn = htmlspecialchars($_POST['bagian_id']);
            $mulai = htmlspecialchars($_POST['karyawan_masuk']);

            # Status & Waktu
            $stt = "Aktif";
            $skrg = date('Y-m-d');

            # Foto Timeline
            $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
            $photo_src = htmlentities($_FILES["karyawan_foto"]["name"]) ? htmlspecialchars($_FILES["karyawan_foto"]["name"]) : $_FILES["karyawan_foto"]["name"];
            $x_foto = explode('.', $photo_src);
            $ekstensi_photo_src = strtolower(end($x_foto));
            $ukuran_photo_src = $_FILES['karyawan_foto']['size'];
            $file_tmp_photo_src = $_FILES['karyawan_foto']['tmp_name'];

            if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
                if ($ukuran_photo_src < 10440070) {
                    move_uploaded_file($file_tmp_photo_src, "../../../../assets/karyawan/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit;
                }
            } else {
                echo "Tidak Dapat Ter - Upload Gambar";
                die;
            }

            # password karyawan
            $pass = md5($_POST['karyawan_id'], false);
            # database cek table
            $table = "karyawan";
            $SQL = "SELECT * FROM $table WHERE karyawan_id = '$id'";
            $mysql = $this->db->query($SQL);
            $rows = mysqli_num_rows($mysql);

            if ($rows) {
                header("location:../ui/header.php?aksi=tambah-karyawan");
                exit(0);
            } else {
                $insert = "INSERT INTO $table SET karyawan_id='$id', karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt', karyawan_create='$skrg', 
                karyawan_pass='$pass', id_adm='$id_adm'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    if ($data) {
                        header("location:../ui/header.php?page=karyawan");
                        exit(0);
                    }
                } else {
                    header("location:../ui/header.php?aksi=tambah-karyawan");
                    exit(0);
                }
            }
        endif;
    }

    public function tambahkaryawan2($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai)
    {
        if (
            empty($_POST['karyawan_id']) || empty($_POST['karyawan_nama']) || empty($_POST['karyawan_jk']) || empty($_POST['karyawan_telp']) || empty($_POST['karyawan_alamat']) ||
            empty($_POST['karyawan_tptlhr']) || empty($_POST['karyawan_tgllhr']) || empty($_POST['bagian_id']) || empty($_POST['karyawan_masuk'])
        ):
            header("location:../ui/header.php?aksi=tambah-karyawan");
            exit(0);
        else:
            $id_adm = htmlspecialchars($_POST['id_adm']);
            $id = htmlspecialchars($_POST['karyawan_id']);
            $nama = htmlspecialchars($_POST['karyawan_nama']);
            $jk = htmlspecialchars($_POST['karyawan_jk']);
            $telp = htmlspecialchars($_POST['karyawan_telp']);
            $alamat = htmlspecialchars($_POST['karyawan_alamat']);
            $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
            $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
            $bgn = htmlspecialchars($_POST['bagian_id']);
            $mulai = htmlspecialchars($_POST['karyawan_masuk']);

            # Status & Waktu
            $stt = "Aktif";
            $skrg = date('Y-m-d');

            # Foto Timeline
            $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
            $photo_src = htmlentities($_FILES["karyawan_foto"]["name"]) ? htmlspecialchars($_FILES["karyawan_foto"]["name"]) : $_FILES["karyawan_foto"]["name"];
            $x_foto = explode('.', $photo_src);
            $ekstensi_photo_src = strtolower(end($x_foto));
            $ukuran_photo_src = $_FILES['karyawan_foto']['size'];
            $file_tmp_photo_src = $_FILES['karyawan_foto']['tmp_name'];

            if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
                if ($ukuran_photo_src < 10440070) {
                    move_uploaded_file($file_tmp_photo_src, "../../../../../assets/karyawan/" . $photo_src);
                } else {
                    echo "Tidak Dapat Ter - Upload Size Gambar";
                    exit;
                }
            } else {
                echo "Tidak Dapat Ter - Upload Gambar";
                die;
            }

            # password karyawan
            $pass = md5($_POST['karyawan_id'], false);
            # database cek table
            $table = "karyawan";
            $SQL = "SELECT * FROM $table WHERE karyawan_id = '$id'";
            $mysql = $this->db->query($SQL);
            $rows = mysqli_num_rows($mysql);

            if ($rows) {
                header("location:../ui/header.php?aksi=tambah-karyawan");
                exit(0);
            } else {
                $insert = "INSERT INTO $table SET karyawan_id='$id', karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt', karyawan_create='$skrg', 
                karyawan_pass='$pass', id_adm='$id_adm'";
                $data = $this->db->query($insert);
                if ($data != "") {
                    if ($data) {
                        header("location:../ui/header.php?page=karyawan");
                        exit(0);
                    }
                } else {
                    header("location:../ui/header.php?aksi=tambah-karyawan");
                    exit(0);
                }
            }
        endif;
    }

    public function ubahkaryawan($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai, $stt, $idold)
    {
        $idold = htmlspecialchars($_POST['idold']);
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $jk = htmlspecialchars($_POST['karyawan_jk']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        $alamat = htmlspecialchars($_POST['karyawan_alamat']);
        $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
        $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
        $bgn = htmlspecialchars($_POST['bagian_id']);
        $mulai = htmlspecialchars($_POST['karyawan_masuk']);
        $stt = htmlspecialchars($_POST['karyawan_status']);

        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["karyawan_foto"]["name"]) ? htmlspecialchars($_FILES["karyawan_foto"]["name"]) : $_FILES["karyawan_foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['karyawan_foto']['size'];
        $file_tmp_photo_src = $_FILES['karyawan_foto']['tmp_name'];

        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/karyawan/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;
            }
        } else {
            echo "Tidak Dapat Ter - Upload Gambar";
            die;
        }

        $table = "karyawan";
        $mysql = $this->db->query("SELECT * FROM karyawan WHERE karyawan_id = '$idold'");
        $row = mysqli_fetch_array($mysql);

        if (empty($id) != $idold) {
            if (isset($_POST['ubahfoto'])) {
                if ($row['karyawan_foto'] == "") {
                    $update = "UPDATE $table SET karyawan_id='$id', karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                    karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
                    $data = $this->db->query($update);
                    if ($data != "") {
                        if ($data) {
                            header("location:../ui/header.php?page=karyawan");
                            exit(0);
                        }
                    } else {
                        header("location:../ui/header.php?aksi=edit-karyawan&kry=$idold");
                        exit(0);
                    }
                } else if ($row['karyawan_foto'] != "") {
                    if ($photo_src != "") {
                        $update = "UPDATE $table SET karyawan_id='$id', karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                        karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
                        $data = $this->db->query($update);
                        unlink("../../../../../assets/karyawan/$row[karyawan_foto]");
                        if ($data != "") {
                            if ($data) {
                                header("location:../ui/header.php?page=karyawan");
                                exit(0);
                            }
                        } else {
                            header("location:../ui/header.php?aksi=edit-karyawan&kry=$idold");
                            exit(0);
                        }
                    }
                }
            }
        } else {
            $update = "UPDATE $table SET karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', karyawan_tgllhr='$tgl',
            karyawan_tptlhr='$tpt', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
            $data = $this->db->query($update);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=karyawan");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=edit-karyawan&kry=$idold");
                exit(0);
            }
        }
    }

    public function ubahkaryawan2($id, $nama, $jk, $telp, $alamat, $tpt, $tgl, $bgn, $mulai, $stt)
    {
        $idold = htmlspecialchars($_POST['idold']);
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $jk = htmlspecialchars($_POST['karyawan_jk']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        $alamat = htmlspecialchars($_POST['karyawan_alamat']);
        $tpt = htmlspecialchars($_POST['karyawan_tptlhr']);
        $tgl = htmlspecialchars($_POST['karyawan_tgllhr']);
        $bgn = htmlspecialchars($_POST['bagian_id']);
        $mulai = htmlspecialchars($_POST['karyawan_masuk']);
        $stt = htmlspecialchars($_POST['karyawan_status']);

        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["karyawan_foto"]["name"]) ? htmlspecialchars($_FILES["karyawan_foto"]["name"]) : $_FILES["karyawan_foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['karyawan_foto']['size'];
        $file_tmp_photo_src = $_FILES['karyawan_foto']['tmp_name'];

        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../../assets/karyawan/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;
            }
        } else {
            echo "Tidak Dapat Ter - Upload Gambar";
            die;
        }

        $table = "karyawan";
        $mysql = $this->db->query("SELECT * FROM karyawan WHERE karyawan_id = '$idold'");
        $row = mysqli_fetch_array($mysql);

        if ($row['karyawan_id'] > 0) {
            if (isset($_POST['ubahfoto'])) {
                if ($row['karyawan_foto'] == "") {
                    $updated = "UPDATE $table SET karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                            karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
                    $data = $this->db->query($updated);
                    if ($data != "") {
                        if ($data) {
                            header("location:../ui/header.php?page=karyawan");
                            exit(0);
                        }
                    } else {
                        header("location:../ui/header.php?aksi=edit-karyawan&kry=$id");
                        exit(0);
                    }
                } else if ($row['karyawan_foto'] != "") {
                    if ($photo_src != "") {
                        $updated = "UPDATE $table SET karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', 
                                karyawan_tgllhr='$tgl', karyawan_tptlhr='$tpt', karyawan_foto='$photo_src', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
                        $data = $this->db->query($updated);
                        unlink("../../../../../assets/karyawan/" . $row['karyawan_foto']);
                        if ($data != "") {
                            if ($data) {
                                header("location:../ui/header.php?page=karyawan");
                                exit(0);
                            }
                        } else {
                            header("location:../ui/header.php?aksi=edit-karyawan&kry=$id");
                            exit(0);
                        }
                    }
                }
            }
        } else {
            $updated = "UPDATE $table SET karyawan_nama='$nama', karyawan_jk='$jk', karyawan_alamat='$alamat', karyawan_telp='$telp', karyawan_tgllhr='$tgl',
                     karyawan_tptlhr='$tpt', karyawan_masuk='$mulai', bagian_id='$bgn', karyawan_status='$stt' WHERE karyawan_id = '$idold'";
            $data = $this->db->query($updated);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=karyawan");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?aksi=edit-karyawan&kry=$id");
                exit(0);
            }
        }
    }

    public function hapuskaryawan($karyawan_id)
    {
        $karyawan_id = htmlspecialchars($_GET['kry']);
        $table = "karyawan";
        $select = $this->db->query("SELECT * FROM $table WHERE karyawan_id = '$karyawan_id'");
        $this->db->query("SELECT * FROM user WHERE karyawan_id = '$karyawan_id'");
        $array = mysqli_fetch_array($select);
        $foto = $array["karyawan_foto"];

        if ($array["karyawan_foto"] == "") {
            $delete = "DELETE FROM $table WHERE karyawan_id = '$karyawan_id'";
            $data = $this->db->query($delete);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=karyawan");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=karyawan");
                exit(0);
            }
        } else {
            unlink("../../../../../assets/karyawan/$foto");
            $data = $this->db->query("DELETE FROM $table WHERE karyawan_id = '$karyawan_id'");
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=karyawan");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=karyawan");
                exit(0);
            }
        }
    }

    public function reset_password($pass, $id)
    {
        $id = $_GET['kry'];
        # database reset password
        $pass = md5($id, false);
        $data = $this->db->query("UPDATE karyawan SET karyawan_pass = '$pass' WHERE karyawan_id = '$id'");
        if ($data) {
            header("location:../ui/header.php?page=karyawan");
            exit(0);
        }
    }
}

class KRY_Chagned
{
    protected $table = "karyawan";
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

    public function profile($nama, $telp, $id)
    {
        $id = htmlspecialchars($_POST['karyawan_id']);
        $nama = htmlspecialchars($_POST['karyawan_nama']);
        $telp = htmlspecialchars($_POST['karyawan_telp']);
        # Foto adm change
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif');
        $photo_src = htmlentities($_FILES["karyawan_foto"]["name"]) ? htmlspecialchars($_FILES["karyawan_foto"]["name"]) : $_FILES["karyawan_foto"]["name"];
        $x_foto = explode('.', $photo_src);
        $ekstensi_photo_src = strtolower(end($x_foto));
        $ukuran_photo_src = $_FILES['karyawan_foto']['size'];
        $file_tmp_photo_src = $_FILES['karyawan_foto']['tmp_name'];
        # setting foto adm
        if (in_array($ekstensi_photo_src, $ekstensi_diperbolehkan_foto) === true) {
            if ($ukuran_photo_src < 10440070) {
                move_uploaded_file($file_tmp_photo_src, "../../../../assets/karyawan/" . $photo_src);
            } else {
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;
            }
        } else {
            echo "Tidak Dapat Ter - Upload Gambar";
            die;
        }
        # cek foto
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE karyawan_id = '$id'");
        $row = mysqli_fetch_array($mysql);
        # code foto used
        if (isset($_POST['ubahfoto'])) {
            if ($row['karyawan_foto'] == "") {
                $update = "UPDATE $this->table SET karyawan_nama = '$nama', karyawan_telp = '$telp', karyawan_foto = '$photo_src' WHERE karyawan_id = '$id'";
                $data = $this->db->query($update);
                if ($data != "") {
                    if ($data) {
                        header("location:../ui/header.php?page=user-profile&karyawan_id=$id");
                        exit(0);
                    }
                } else {
                    header("location:../ui/header.php?page=user-profile&karyawan_id=$id&data=$id");
                    exit(0);
                }
            } else if ($row['karyawan_foto'] != "") {
                if ($photo_src != "") {
                    $update = "UPDATE $this->table SET karyawan_nama = '$nama', karyawan_telp = '$telp', karyawan_foto = '$photo_src' WHERE karyawan_id = '$id'";
                    $data = $this->db->query($update);
                    unlink("../../../../assets/karyawan/$row[karyawan_foto]");
                    if ($data != "") {
                        if ($data) {
                            header("location:../ui/header.php?page=user-profile&karyawan_id=$id");
                            exit(0);
                        }
                    } else {
                        header("location:../ui/header.php?page=user-profile&karyawan_id=$id&data=$id");
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
        $id = htmlspecialchars($_POST['karyawan_id']);
        # database password
        $mysql = $this->db->query("SELECT * FROM $this->table WHERE karyawan_id = '$id'");
        $row = mysqli_fetch_array($mysql);
        # cek update password
        if (password_verify($old_password, PASSWORD_DEFAULT) == md5($row['karyawan_pass'], false)) {
            header("location:../ui/header.php?page=user-profile&karyawan_id=$id&change=$id");
            exit(0);
        }
        # change password yang terbaru ...
        if ($new_password == $new_password_verify) {
            $SQL = "UPDATE $this->table SET karyawan_pass = '$new_password' WHERE karyawan_id = '$id'";
            $data = $this->db->query($SQL);
            if ($data != "") {
                if ($data) {
                    header("location:../ui/header.php?page=user-profile&karyawan_id=$id");
                    exit(0);
                }
            } else {
                header("location:../ui/header.php?page=user-profile&karyawan_id=$id&change=$id");
                exit(0);
            }
        }
    }
}
