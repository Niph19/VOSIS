<?php
include '../header/config.php';
include '../header/sidebar.php';

$query = mysqli_query(
    $koneksi,
    "SELECT tbl_caketos.Nama, COUNT(tbl_voting.id_calon) AS Jumlah
FROM tbl_caketos INNER JOIN tbl_voting
on tbl_caketos.id_calon=tbl_voting.id_calon
group by tbl_voting.id_calon"
);

foreach ($query as $row) {
    $Nama[] = $row['Nama'];
    $Jumlah[] = $row['Jumlah'];
}
?>

<div class="container-fluid pt-4">
    <div class="card mb-4 p-4">
        <form action="export_pdf.php" method="POST" target="_blank">
            <input type="hidden" name="chart_image" id="chart_image">
            <button type="submit" onclick="exportPDF()" class="btn btn-primary">Export PDF</button>
        </form>
        <div id="areaPDF">
            <h3 align="center">Grafik Perolehan Suara Ketua OSIS</h3>
            <h5 align="center"> SMK Informatika Pesat </h5>

            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const Nama = <?= json_encode($Nama); ?>;
                const Jumlah = <?= json_encode($Jumlah); ?>;

                const ctx = document.getElementById('myChart');

                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Nama,
                        datasets: [{
                            label: 'Jumlah Suara',
                            data: Jumlah,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        backgroundColor: 'rgb(201, 160, 80, 0.3)',
                        borderColor: '#C9A050',
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                function exportPDF() {
                    document.getElementById('chart_image').value = myChart.toBase64Image();
                }
            </script>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4 p-4">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nomor</th>
                        <th
                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2 text-center">
                            Nama</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Jumlah Suara</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($query as $tabel):
                        ?>

                        <tr>
                            <td>
                                <div class="d-flex px-0 py-1 text-center">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 pe-0 ps-4 text-sm font-weight-bold"><?= $no++; ?></h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0 text-center"><?= $tabel['Nama'] ?></p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-sm font-weight-bold mb-0 text-wrap"><?= $tabel['Jumlah'] ?></p>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>