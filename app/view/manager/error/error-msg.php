<?php
$ettor_title = '';
$error_message = '';
if (isset($_GET['HttpStatus'])) {
    if ($_GET['HttpStatus'] == 200) {
        $ettor_title = '200 Document has been processed and sent to you';
        $error_message = 'Document has been processed and sent to you.';
        echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('$error_message'),
        document.location.href='../ui/header.php?page=beranda'
    }, 3000);
    </script>";
        die;
    }
}