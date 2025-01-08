<?php
date_default_timezone_set("Asia/Jakarta");
# code base url
function baseurl($link)
{
    $url = "http://localhost/aplikasi_penggajian/" . ltrim($link, "/");
    return $url;
}
# code Library Salam
function salam()
{
    $b = time();
    $hour = date("G", $b);

    if (
        $hour >= 0 && $hour <= 11
    ) {
        echo "Selamat Pagi";
    } elseif ($hour >= 11 && $hour <= 15) {
        echo "Selamat Siang ";
    } elseif ($hour >= 15 && $hour <= 18) {
        echo "Selamat Sore ";
    } elseif ($hour >= 18 && $hour < 24) {
        echo "Selamat Malam ";
    }
}
# database koneksi akses
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "db_penggajian";
$koneksi = mysqli_connect($hostname, $username, $password, $dbname) or mysqli_connect_error();
# Capthca
$min_number = 1;
$max_number = 15;
$angka1 = mt_rand($min_number, $max_number);
$angka2 = mt_rand($min_number, $max_number);
