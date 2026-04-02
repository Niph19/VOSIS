<?php
include("../header/config.php");

// Ambil id dari URL
// Jika di URL ada id, simpan ke var $id
// Jika tidak, isi $id dengan null, jadi $id = null
$id = $_GET["id"] ?? null;

// Ambil data id
if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE Nomor = '$id'");
    $siswa = mysqli_fetch_assoc($query);
    // mysqli_fetch_assoc = mengambil 1 baris data hasil dari query
}

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Nama = $_POST['data_nama'];
    $kelas = $_POST['data_kelas'];
    $jurusan = $_POST['data_jurusan'];
    $alamat = $_POST['data_alamat'];

    if ($_FILES['data_siswa']['name'] != "") {

    $Foto = $_FILES["data_siswa"]["name"];
    $tmp_Foto = $_FILES["data_siswa"]["tmp_name"];

    $folder = "../../assets/img/siswa/";

    move_uploaded_file($tmp_Foto, $folder . $Foto);

    // Update + Foto
    $sql = "UPDATE tbl_siswa SET Nama='$Nama', Kelas='$kelas', Jurusan='$jurusan', Alamat='$alamat', Foto='$Foto' WHERE Nomor='$id'";
    } else {

    // Update tanpa Foto
    $sql = "UPDATE tbl_siswa SET Nama='$Nama', Kelas='$kelas', Jurusan='$jurusan', Alamat='$alamat' WHERE Nomor='$id'";
    }

    mysqli_query($koneksi, $sql);   

    header("Location: siswa.php");
    exit;
}


include("../header/sidebar.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Data Siswa</h6>
                </div>


                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-3" method="POST" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="data_nama" placeholder="Nama Lengkap" value="<?= $siswa['Nama']?>">
                        </div>


                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" name="data_kelas" value="<?= $siswa['Kelas']?>">
                                <option>X1</option>
                                <option>X2</option>
                                <option>X3</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" name="data_jurusan" placeholder="Jurusan Anda" value="<?= $siswa['Jurusan']?>">
                        </div>


                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="data_alamat" placeholder="Alamat Anda" value="<?= $siswa['Alamat']?>">
                        </div>

                        <div class="form-group">
                            <img src="../../assets/img/siswa/<?= $siswa['Foto']?>" class="avatar avatar-md rounded-circle my-3" style="width: 75px; height: 75px; object-fit: cover;">
                            <label for="image_uploads">Upload Foto siswa</label><br>
                            <input type="file" id="foto_siswa" name="data_siswa"
                                accept="image/png, image/jpeg, image/jpg" value="<?= $siswa['Foto']?>">
                        </div>


                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-paper-plane"></i>Tambahkan data
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