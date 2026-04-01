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

<div class="container-fluid py-4">
    <div class="card mb-4 p-4">
        <h3 align="center">Grafik Perolehan Suara Ketua OSIS</h3>
        <h5 align="center"> SMK Informatika Pesat </h5>

        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
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
                label: '# of Votes',
                data: Jumlah,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>