<?php
include("../header/sidebar.php");
include("../header/config.php");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Data Calon Ketua OSIS</h4>
                    <div class="card-button d-flex gap-2">
                        <a href="tambah_caketos.php" class="btn bg-primary color-white">Tambah Calon</a>
                        <form action="export_pdf_caketos.php" method="POST" target="_blank">
                            <button id="bg-secondary" type="submit" class="btn color-white">Export PDF</button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width: 5%;">
                                        Nomor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 "
                                        style="width: 10%; ">
                                        Foto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2 text-center"
                                        style="width: 15%; ">
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Visi</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Misi</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width: 15%; ">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM `tbl_caketos`");
                                foreach ($query as $data): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1 text-center">
                                                <div class="d-flex flex-column justify-content-center mx-auto">
                                                    <h6 class="mb-0 pe-0 text-sm "><?= $no++; ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center p-2">
                                            <img src="../../assets/img/caketos/<?= $data['Foto'] ?>"
                                                class="avatar avatar-md rounded-circle"
                                                style="width: 75px; height: 75px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-center"><?= $data['Nama'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0 text-wrap"><?= $data['Visi'] ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0 text-wrap"><?= $data['Misi'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="edit_data_caketos.php?id=<?= $data['id_calon']; ?>"
                                                class="btn bg-primary color-white align-middle">Edit</a>
                                            <a href="delete_caketos.php?id=<?= $data['id_calon']; ?>"
                                                id="bg-secondary" class="btn color-white align-middle">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer pt-3 pb-2">
    <div class="container-fluid">
        <div class="d-flex justify-content-center mx-auto">
                <div class="copyright text-sm text-center">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Hanif El Hakim. All rights reserved.
                </div>
        </div>
    </div>
</footer>
</main>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>