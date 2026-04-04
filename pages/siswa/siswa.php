<?php
include("../header/sidebar.php");
include("../header/config.php");
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Data Siswa</h4>
                    <div class="card-button d-flex gap-2">
                        <a id="bg-primary" href="tambah_siswa.php" class="btn color-white">Tambah Data</a>
                        <form action="export_pdf_siswa.php" method="POST" target="_blank">
                            <button id="bg-secondary" type="submit" class="btn color-white">Export PDF</button>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="areaPDF">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="width: 5%;">
                                            Nomor</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 "
                                            style="width: 10%">
                                            Foto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2 text-center"
                                            style="width: 15%">
                                            Nama</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kelas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jurusan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Alamat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Username</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Password</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="width: 15%; ">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT *,
                                    SUBSTRING_INDEX(Nama, ' ', 1) AS nama_depan,
                                    IF(LOCATE(' ', Nama) > 0, SUBSTRING(Nama, LOCATE(' ', Nama) + 1), '') AS nama_belakang
                                    FROM tbl_siswa;");
                                    foreach ($query as $data): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center mx-auto">
                                                        <h6 class="mb-0 text-sm"><?= $no++; ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center p-2">
                                                <img src="../../assets/img/siswa/<?= $data['Foto'] ?>"
                                                    class="avatar avatar-md rounded-circle"
                                                    style="width: 75px; height: 75px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <p class="text-xs mb-0 text-center font-weight-bolder"><?= $data['Nama'] ?>
                                                </p>
                                                <p class="text-xs mb-0 text-center font-weight-light">
                                                    <?= $data['nama_depan'] ?>@gmail.com
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0"><?= $data['Kelas'] ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0"><?= $data['Jurusan'] ?></p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $data["Alamat"] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $data["Username"] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $data["Password"] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="edit_data_siswa.php?id=<?= $data['Nomor']; ?>"
                                                    class="btn bg-primary color-white align-middle">Edit</a>
                                                <a href="delete_siswa.php?id=<?= $data['Nomor']; ?>"
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