<?php
require_once('../../tcpdf/tcpdf.php');
include "../header/config.php";


// ambil gambar chart
$chartImage = $_POST['chart_image'] ?? '';


// query data untuk di tabel
$query = mysqli_query($koneksi, "SELECT tbl_caketos.Nama, COUNT(tbl_voting.id_calon) AS Jumlah
FROM tbl_caketos INNER JOIN tbl_voting
on tbl_caketos.id_calon=tbl_voting.id_calon
group by tbl_voting.id_calon");


// buat PDF
$pdf = new TCPDF();
$pdf->AddPage();


// tanggal
$tanggal = date('d-m-Y');


// ================= HEADER =================
$html = ' ';


// ================= GRAFIK =================
if (!empty($chartImage)) {
    $html .= '<div>
                    <img src= "' . $chartImage . '" width="500">
            </div> ';
}

// ================= TABEL =================
$html .= '
    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th>No</th>
                <th>Nama Calon</th>
                <th>Perolehan Suara</th>
            </tr>
        </thead>
        <tbody>
        ';
        
        $no = 1;
        foreach($query as $row) {
            $html .= '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['Nama'] . '</td>
                    <td>' . $row['Jumlah'] . '</td>
                </tr>
            ';
        }
$html .= '</tbody></table>';

// ================= FOOTER =================
$html .= '
<br><br>
<table width="100%">
    <tr>
        <td align="right">
            Dicetak pada: ' . $tanggal . '
        </td>
    </tr>
</table>
';


// render
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('laporan_voting.pdf', 'I');