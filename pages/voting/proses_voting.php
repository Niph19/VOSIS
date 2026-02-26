<?php
include("../header/config.php");

// cek apakah tombol diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_calon = $_POST["id_calon"];

    $tanggal = date("Y-m-d H:i:s");

    // SIMPAN VOTING
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_voting(id_calon, tanggal, id_siswa) VALUES('$id_calon', '$tanggal', '0')");

    header("Location: ../../index.php");
    exit;
}
?>