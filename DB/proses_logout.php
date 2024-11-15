<?php

session_start(); // Mulai sesi
session_unset(); // Hapus semua data sesi
session_destroy(); // Hancurkan sesi
header("Location: ../index.php"); // Arahkan ke index.php setelah logout
exit();

?>