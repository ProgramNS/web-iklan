<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'iklan';

    $koneksi = new mysqli($host,$username,$password,$dbname);
    
    if($koneksi->connect_error){
        die("Koneksi Gagal : " . $koneksi->connect_error);
    }
    echo "Koneksi Berhasil";
?>