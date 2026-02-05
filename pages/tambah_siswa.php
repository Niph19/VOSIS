<?php
include("sidebar.php");
include("config.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Siswa</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-3" method="POST" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="data_nama" placeholder="Nama Lengkap">
                        </div>


                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" name="data_kelas">
                                <option>X1</option>
                                <option>X2</option>
                                <option>X3</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" name="data_jurusan" placeholder="Jurusan Anda" required>
                        </div>


                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="data_alamat" placeholder="Alamat Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="image_uploads">Upload Foto Siswa</label><br>
                            <input type="file" id="foto_siswa" required name="data_foto_siswa"
                                accept="image/png, image/jpeg, image/jpg" />
                        </div>

                        
                        <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa-solid fa-paper-plane"></i>Tambahkan data
                                    </button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        $Nama = $_POST['data_nama'];
                        $kelas = $_POST['data_kelas'];
                        $jurusan = $_POST['data_jurusan'];
                        $alamat = $_POST['data_alamat'];

                        // Folder Upload
                        $folder = "../assets/img/siswa/";
                        
                        // Ambil data file
                        $nama_File = $_FILES['data_foto_siswa']['name'];
                        $tmp_File = $_FILES['data_foto_siswa']['tmp_name'];
                        // $_FILES['foto]['name']  : variable bawaan php untuk menampung data file yang di upload
                        // [foto] : name pada form, [name] untuk mengambil nama asli file yang di upload oleh user
                        
                        // Membuat Nama unik
                        $nama_baru = time() . "_" . $nama_File;

                        // Pindahkan file ke folder tujuan
                        move_uploaded_file($tmp_File, $folder . $nama_baru);
                        $query = "INSERT INTO tbl_siswa(Nama, Kelas, Jurusan, Alamat, Foto) 
                        VALUES ('$Nama','$kelas','$jurusan', '$alamat', '$nama_baru')";

                        if (mysqli_query($koneksi, $query)) {
                            echo "<div class='alert alert-success text-center'>Data Berhasil Disimpan</div>";
                        } else {
                            echo "<div class='alert alert-danger text-center'>
                            Gagal : " . mysqli_error($koneksi) . "
                        </div>";
                        }
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