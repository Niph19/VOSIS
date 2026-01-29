<?php
include("config.php");

// ambil id dari URL
$id = $_GET['id'] ?? null;

// Proses Delete
mysqli_query($koneksi, "DELETE FROM tbl_admin WHERE id_admin='$id'");

// Kembali ke Page Siswa
header("location: admin.php");
?>