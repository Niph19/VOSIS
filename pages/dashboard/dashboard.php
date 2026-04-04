<?php
include("../header/sidebar.php");
include("../header/config.php");

$grafik = mysqli_query(
    $koneksi,
    "SELECT tbl_caketos.Nama, COUNT(tbl_voting.id_calon) AS Jumlah
FROM tbl_caketos INNER JOIN tbl_voting
on tbl_caketos.id_calon=tbl_voting.id_calon
group by tbl_voting.id_calon"
);

foreach ($grafik as $row) {
    $Nama[] = $row['Nama'];
    $Jumlah[] = $row['Jumlah'];
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6 col-12 pt-2">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card" style="height: 150px;">
                        <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                        <div id="card-body1" class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col text-start">
                                    <h4 id='color-white' class="mb-0 mt-1 text-wrap">
                                        <?php
                                        $pemenang = mysqli_query($koneksi, "SELECT tbl_caketos.Nama, COUNT(tbl_voting.id_calon) AS Jumlah FROM tbl_caketos INNER JOIN tbl_voting on tbl_caketos.id_calon=tbl_voting.id_calon group by tbl_voting.id_calon limit 1;");
                                        $sementara = mysqli_fetch_assoc($pemenang);
                                        echo $sementara["Nama"];
                                        ?>
                                    </h4>
                                    <h6 id="text-card" class="mb-0 mt-2">Pemenang Sementara</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card" style="height: 150px;">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col text-start">
                                    <div id='bg-white'
                                        class="icon icon-shape text-center card-border-radius icon-card me-3 mt-2">
                                        <i id="color-primary" class="fa-solid fa-user fa-2x pb-3"
                                            style="padding-right: 10px"></i>
                                    </div>
                                    <h2 id='color-white' class="font-weight-bolder mb-0 mt-3">
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(id_calon) AS jumlah_calon FROM tbl_caketos;");
                                        $calon = mysqli_fetch_assoc($query);

                                        echo $calon["jumlah_calon"];
                                        ?>
                                    </h2>
                                    <h6 id="text-card" class=" mt-3 mb-0">Jumlah Calon</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card" style="height: 150px;">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col text-start">
                                    <div id='bg-white'
                                        class="icon icon-shape text-center card-border-radius icon-card me-3 mt-2">
                                        <i id='color-primary' class="fa-regular fa-circle-check fa-2x pe-2 pb-4"></i>
                                    </div>
                                    <h2 id='color-white' class="font-weight-bolder mb-0 mt-3">
                                        <?php
                                        $total = mysqli_query($koneksi, "SELECT COUNT(*) as total_voting from tbl_voting;");
                                        $voting = mysqli_fetch_assoc($total);
                                        echo $voting["total_voting"];
                                        ?>
                                    </h2>
                                    <h6 id="text-card" class="text-white mt-3 mb-0">Jumlah Suara</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card" style="height: 150px;">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col text-start">
                                    <div id='bg-white'
                                        class="icon icon-shape text-center card-border-radius icon-card me-3 mt-2">
                                        <i id="color-primary" class="fa-solid fa-users fa-2x pb-3 pe-1"></i>
                                    </div>
                                    <h2 id='color-white' class="font-weight-bolder mb-0 mt-3">
                                        <?php
                                        $total = mysqli_query($koneksi, "SELECT COUNT(*) as total_siswa from tbl_siswa");
                                        $siswa = mysqli_fetch_assoc($total);
                                        echo $siswa["total_siswa"];
                                        ?>
                                    </h2>
                                    <h6 id="text-card" class="text-white mt-3 mb-0">Jumlah Siswa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
            <div class="card shadow h-100">
                <div class="card-header pb-0 p-3">
                    <h5 id="color-text" class="mb-0 text-center">Grafik Perolehan Suara Ketua OSIS</h5>
                </div>
                <div class="card-body pb-0 p-3">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const Nama = <?= json_encode($Nama) ?>;
                        const Jumlah = <?= json_encode($Jumlah) ?>;

                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: Nama,
                                datasets: [{
                                    label: 'Jumlah Suara',
                                    data: Jumlah,
                                    borderWidth: 1,
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                backgroundColor: 'rgb(201, 160, 80, 0.3)',
                                borderColor: '#C9A050',
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card-header pb-0">
                <h5 id="color-text">Calon Ketua OSIS</h5>
            </div>
            <div class="card-body px-0 pt-2">
                <div class="row g-0 gap-4">
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT *,
                        SUBSTRING_INDEX(Nama, ' ', 1) AS nama_depan,
                        IF(LOCATE(' ', Nama) > 0, SUBSTRING(Nama, LOCATE(' ', Nama) + 1), '') AS nama_belakang
                        FROM tbl_caketos;");
                    foreach ($query as $data): ?>
                        <div class="col px-0">
                            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <div class="card calon-card shadow-lg">
                                    <span class="badge position-absolute top-0 start-0 m-2 fs-3 px-3 py-2" id="badge-color">
                                        <?= sprintf("%01d", $no++) ?>
                                    </span>
                                    <img src="../../assets/img/caketos/<?= $data['Foto'] ?>" class="card-img-top shadow-lg"
                                        style="height: 250px; width: 250px; object-fit: cover;">
                                    <div class="card-body justify-content-start d-flex flex-column"
                                        style="height: 180px; width: 250px;">
                                        <h4 id="color-text" class="card-title mb-0 fs-4 fw-bolder"><?= $data['nama_depan'] ?></h4>
                                        <h4 id="color-text" class="card-title pb-1 fs-6 fw-normal"><?= $data['nama_belakang'] ?></h4>
                                        <div class="d-flex">
                                            <p id="color-secondary" class="data_kelas fw-bold mt-1 mb-0">KELAS</p>
                                            <p id="color-text" class="data_kelas fw-bold ms-auto fs-5 mb-0">
                                                <?= $data['Kelas']; ?>
                                                </p>
                                        </div>
                                        <div class="d-flex">
                                            <p id="color-secondary" class="data_suara fw-bold mb-0 mt-1">TOTAL SUARA</p>
                                            <p id="color-primary" class="data_suara fw-bold ms-auto mb-0 fs-5">
                                                <?php
                                                $id_calon = $data['id_calon'];
                                                $total = mysqli_query($koneksi, "SELECT COUNT(*) as total_voting from tbl_voting where id_calon='$id_calon';");
                                                $voting = mysqli_fetch_assoc($total); 
                                                echo $voting["total_voting"];
                                                ?>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>



        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5 id="color-text">Timeline Pemilihan Ketua OSIS</h5>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-bullhorn"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Pengumuman</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">23 Desember</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-person-booth"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Pemilihan Calon Ketua OSIS</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 Desember</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-microphone-lines"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Orasi</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 Desember</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-user-group"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Penetapan Calon Ketua OSIS</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">19 Desember</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-regular fa-comments"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Wawancara</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 Desember</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="fa-solid fa-user-plus"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="color-text text-sm font-weight-bold mb-0">Pendaftaran</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 Desember</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</main>
<!--   Core JS Files   -->
<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>
<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/chartjs.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>