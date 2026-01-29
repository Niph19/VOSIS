<?php
include("config.php");

// ambil id dari URL
$id = $_GET['id'] ?? null;

// Proses Delete
mysqli_query($koneksi, "DELETE FROM tbl_caketos WHERE id_calon='$id'");

// Kembali ke Page Siswa
header("location: caketos.php");
?>