<?php
include("sidebar.php");
include("config.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Calon Ketua OSIS</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-3" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="data_nama">
                        </div>
                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <input type="text" class="form-control" name="data_visi">
                        </div>
                        <div class="form-group">
                            <label for="misi">Misi</label>
                            <input type="text" class="form-control" name="data_misi">
                        </div>
                        <div class="form-group">
                            <label for="image_uploads">Upload Foto Calon</label><br>
                            <input type="file" id="foto_calon" name="data_foto" accept="image/png, image/jpeg, image/jpg"/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa-solid fa-paper-plane"></i>Tambahkan data Calon
                                    </button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $Nama = $_POST['data_nama'];
                        $Visi = $_POST['data_visi'];
                        $Misi = $_POST['data_misi'];

                        $query = "INSERT INTO tbl_caketos(Nama, Visi, Misi, Foto) 
                        VALUES ('$Nama','$Visi','$Misi', '$nama_baru')";

                        if (mysqli_query($koneksi, $query)) {
                            echo "<div class='alert alert-success text-center'>Data Berhasil Disimpan</div>";
                        } else {
                            echo "<div class='alert alert-danger text-center'>
                            Gagal : " . mysqli_error($koneksi) . "
                        </div>";
                        }
                        // Folder Upload
                        $folder = "../assets/img/caketos/";
                        
                        // Ambil data file
                        $nama_File = $_FILES['data_foto']['name'];
                        $tmp_File = $_FILES['data_foto']['tmp_name'];
                        // $_FILES['foto]['name']  : variable bawaan php untuk menampung data file yang di upload
                        // [foto] : name pada form, [name] untuk mengambil nama asli file yang di upload oleh user
                        
                        // Membuat Nama unik
                        $nama_baru = time() . "_" . $nama_File;
                        
                        // Pindahkan file ke folder tujuan
                        move_uploaded_file($tmp_File, $folder . $nama_baru);
                        
                        mysqli_query($koneksi,"INSERT INTO tbl_caketos(Nama, Visi, Misi, Foto) VALUES ('$Nama', '$Visi', '$Misi', '$nama_baru')");
                        }
                    ?>
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