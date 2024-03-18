<?php

// connection
$host = 'localhost';
$username = 'belajarlara';
$password = 'dDHBc2e!z2msCs/2';
$database = 'crudtmpnativephp';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
