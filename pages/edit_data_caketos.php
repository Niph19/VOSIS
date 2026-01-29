<?php
include "config.php";

// Ambil id dari URL
// Jika di URL ada id, simpan ke var $id
// Jika tidak, isi $id dengan null, jadi $id = null
$id = $_GET["id"] ?? null;

// Ambil data id
if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_caketos WHERE id_calon = '$id'");
    $caketos = mysqli_fetch_assoc($query);
    // mysqli_fetch_assoc = mengambil 1 baris data hasil dari query
}

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Nama = $_POST['data_nama'];
    $Visi = $_POST['data_visi'];
    $Misi = $_POST['data_misi'];
    $Foto = $_POST['data_foto'];

    mysqli_query($koneksi, "UPDATE tbl_caketos set Nama='$Nama', Visi='$Visi', Nama='$Nama', Misi='$Misi', Foto='$Foto' WHERE id_calon='$id'");

    header("Location: caketos.php");
    exit;
}


include("sidebar.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Calon Ketua OSIS</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-3" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="data_nama" value="<?= $caketos['Nama']?>">
                        </div>
                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <input type="text" class="form-control" name="data_visi" value="<?= $caketos['Visi']?>">
                        </div>
                        <div class="form-group">
                            <label for="misi">Misi</label>
                            <input type="text" class="form-control" name="data_misi" value="<?= $caketos['Misi']?>">
                        </div>
                        <div class="form-group">
                            <label for="image_uploads">Upload Foto Calon</label><br>
                            <input type="file" id="foto_calon" name="data_foto"
                                accept="image/png, image/jpeg, image/jpg" value="<?= $caketos['Foto']?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-paper-plane"></i>Edit Data Calon
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                            Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>