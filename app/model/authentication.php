<?php

namespace model;

class authentication
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function AuthLogin($userInput, $passInput)
    {
        if (empty($_POST['userInput']) || empty($_POST['password'])):
            header("location:error/error-msg.php?HttpStatus=401");
            exit(0);
        else:
            $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : trim(strip_tags($_POST['userInput']));
            $passInput = md5(htmlspecialchars($_POST['password']), false);
            $akses = htmlspecialchars($_POST['akses']);
            password_verify($passInput, PASSWORD_DEFAULT);
            $hasil = $_POST['angka1'] + $_POST['angka2'];
            # code table akses
            if ($akses == 'admin') {
                $table = "karyawan";
                $mysql = $this->db->query("SELECT * FROM $table JOIN user ON user.karyawan_id = karyawan.karyawan_id WHERE 
                karyawan.karyawan_id = '$userInput' and karyawan.karyawan_pass = '$passInput' and user.user_akses = 'Admin HRD' and user.user_stt = 'Aktif'");
                $cek2 = mysqli_num_rows($mysql);
                if ($cek2 > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($data = $mysql->fetch_assoc()) {
                        $_SESSION['adm'] = $data['karyawan_id'];
                        $_SESSION['nama'] = $data['karyawan_nama'];
                        $_SESSION['nomor_tlp'] = $data['karyawan_telp'];
                        $_SESSION['user_akses'] = "Admin HRD";
                        $_SESSION['user_stt'] = "Aktif";
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:admin/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $data, time() + (86400 * 30), "/");
                    array_push($response[$table], $data);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            } elseif ($akses == 'direktur') {
                $table = 'direktur';
                $SQL = "SELECT * FROM $table WHERE username = '$userInput' and password = '$passInput' || email = '$userInput' and password = '$passInput'";
                $mysql = $this->db->query($SQL);
                $cek = mysqli_num_rows($mysql);
                if ($cek > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($dataku = $mysql->fetch_assoc()) {
                        $_SESSION['direktur'] = $dataku['id_dir'];
                        $_SESSION['username'] = $dataku['username'];
                        $_SESSION['nama'] = $dataku['nama_lengkap'];
                        $_SESSION['email'] = $dataku['email'];
                        $_SESSION['no_telp'] = $dataku['no_telp'];
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:direktur/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $dataku, time() + (86400 * 30), "/");
                    array_push($response[$table], $dataku);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            } elseif ($akses == 'karyawan') {
                $table = 'karyawan';
                $SQL = "SELECT * FROM $table WHERE karyawan_id = '$userInput' and karyawan_pass = '$passInput' and karyawan_status = 'Aktif'";
                $mysql = $this->db->query($SQL);
                $cek = mysqli_num_rows($mysql);
                if ($cek > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($dataku = $mysql->fetch_assoc()) {
                        $_SESSION['karyawan'] = $dataku['karyawan_id'];
                        $_SESSION['nama'] = $dataku['karyawan_nama'];
                        $_SESSION['no_telp'] = $dataku['karyawan_telp'];
                        $_SESSION['user_stt'] = $dataku['karyawan_status'];
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:karyawan/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $dataku, time() + (86400 * 30), "/");
                    array_push($response[$table], $dataku);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            } elseif ($akses == 'manager') {
                $table = 'karyawan';
                $SQL = "SELECT * FROM $table JOIN user ON user.karyawan_id = karyawan.karyawan_id WHERE 
                karyawan.karyawan_id = '$userInput' and karyawan.karyawan_pass = '$passInput' and user.user_akses = 'Manager' and user.user_stt = 'Aktif'";
                $mysql = $this->db->query($SQL);
                $cek = mysqli_num_rows($mysql);
                if ($cek > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($data = $mysql->fetch_assoc()) {
                        $_SESSION['mng'] = $data['karyawan_id'];
                        $_SESSION['nama'] = $data['karyawan_nama'];
                        $_SESSION['nomor_tlp'] = $data['karyawan_telp'];
                        $_SESSION['user_akses'] = "Manager";
                        $_SESSION['user_stt'] = "Aktif";
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:manager/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $data, time() + (86400 * 30), "/");
                    array_push($response[$table], $data);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            }
        endif;
    }
}

class Authentication2
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function AuthLogin2($userInput, $passInput)
    {
        if (empty($_POST['userInput']) || empty($_POST['password'])):
            header("location:error/error-msg.php?HttpStatus=401");
            exit(0);
        else:
            $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : trim(strip_tags($_POST['userInput']));
            $passInput = md5(htmlspecialchars($_POST['password']), false);
            $akses = htmlspecialchars($_POST['akses']);
            password_verify($passInput, PASSWORD_DEFAULT);
            $hasil = $_POST['angka1'] + $_POST['angka2'];
            if ($akses == 'admin'):
                $table = 'admin';
                $SQL = "SELECT * FROM $table WHERE username = '$userInput' and password = '$passInput' || email = '$userInput' and password = '$passInput'";
                $mysql = $this->db->query($SQL);
                $cek = mysqli_num_rows($mysql);
                if ($cek > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($dataku = $mysql->fetch_assoc()) {
                        $_SESSION['admin'] = $dataku['id_adm'];
                        $_SESSION['username'] = $dataku['username'];
                        $_SESSION['nama'] = $dataku['nama_lengkap'];
                        $_SESSION['email'] = $dataku['email'];
                        $_SESSION['no_telp'] = $dataku['no_telp'];
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:admin/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $dataku, time() + (86400 * 30), "/");
                    array_push($response[$table], $dataku);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            elseif ($akses == 'manager'):
                $table = 'manager';
                $SQL = "SELECT * FROM $table WHERE username = '$userInput' and password = '$passInput' || email = '$userInput' and password = '$passInput'";
                $mysql = $this->db->query($SQL);
                $cek = mysqli_num_rows($mysql);
                if ($cek > 0) {
                    $response = array($userInput, $passInput);
                    $response[$table] = array($userInput, $passInput);
                    if ($dataku = $mysql->fetch_assoc()) {
                        $_SESSION['manager'] = $dataku['id_mng'];
                        $_SESSION['username'] = $dataku['username'];
                        $_SESSION['nama'] = $dataku['nama_lengkap'];
                        $_SESSION['email'] = $dataku['email'];
                        $_SESSION['no_telp'] = $dataku['no_telp'];
                        $_SESSION['akses_jabatan'] = $akses;
                        if ($hasil == $_POST['hasil']):
                            $_SESSION['status'] = true;
                            header("location:manager/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        else:
                            unset($_POST['hasil']);
                            header("location:index.php");
                            exit(0);
                        endif;
                    }
                    $_COOKIE['cookies'] = $userInput;
                    $_SERVER['HTTPS'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$table], $dataku, time() + (86400 * 30), "/");
                    array_push($response[$table], $dataku);
                    die;
                    exit(0);
                } else {
                    unset($_POST['hasil']);
                    $_SESSION['status'] = false;
                    $_SERVER['HTTPS'] = "off";
                    header("location:index.php");
                    exit(0);
                }
            endif;
        endif;
    }
}
