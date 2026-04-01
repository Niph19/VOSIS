<?php
include("../header/config.php");

// Ambil id dari URL
// Jika di URL ada id, simpan ke var $id
// Jika tidak, isi $id dengan null, jadi $id = null
$id = $_GET["id"] ?? null;

// Ambil data id
if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_admin = '$id'");
    $admin = mysqli_fetch_assoc($query);
    // mysqli_fetch_assoc = mengambil 1 baris data hasil dari query
}

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Username = $_POST['data_username'];
    $Password = $_POST['data_password'];
    $Nama = $_POST['data_nama'];
    $Alamat = $_POST['data_alamat'];

    if ($_FILES['data_foto']['name'] != "") {

    $Foto = $_FILES["data_foto"]["name"];
    $tmp_Foto = $_FILES["data_foto"]["tmp_name"];

    $folder = "../../assets/img/admin/";

    move_uploaded_file($tmp_Foto, $folder . $Foto);

    // Update + Foto
    $sql = "UPDATE tbl_admin SET Username='$Username', Password='$Password', Nama='$Nama', Alamat='$Alamat', Foto='$Foto' WHERE id_admin='$id'";
    } else {

    // Update tanpa Foto
    $sql = "UPDATE tbl_admin SET Username='$Username', Password='$Password', Nama='$Nama', Alamat='$Alamat' WHERE id_admin='$id'";

    }

    mysqli_query($koneksi, $sql);   

    header("Location: admin.php");
    exit;
}


include("sidebar.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Admin</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-3" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="data_username" value="<?= $admin['Username']?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="data_password" value="<?= $admin['Password']?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="data_nama" value="<?= $admin['Nama']?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="data_alamat" value="<?= $admin['Alamat']?>">
                        </div>
                        <div class="form-group">
                            <img src="../../assets/img/admin/<?=$admin['Foto']?>" class="avatar avatar-md rounded-circle my-3" style="width: 75px; height: 75px; object-fit: cover;">
                            <label for="image_uploads">Upload Foto Admin</label><br>
                            <input type="file" id="foto_admin" name="data_foto"
                                accept="image/png, image/jpeg, image/jpg" value="<?= $admin['Foto']?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-paper-plane"></i>Edit Data
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