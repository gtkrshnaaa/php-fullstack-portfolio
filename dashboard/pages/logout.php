<?php
// pages/logout.php

session_start();
// Hapus semua data sesi
session_unset();
// Hancurkan sesi
session_destroy();
// Redirect ke halaman index.php setelah logout
header("Location: ../../index.php");
exit;
?>
