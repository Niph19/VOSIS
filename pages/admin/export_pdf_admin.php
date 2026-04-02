<?php
require_once('../../tcpdf/tcpdf.php');
include "../header/config.php";



// buat PDF
$pdf = new TCPDF();
$pdf->AddPage();


// tanggal
$tanggal = date('d-m-Y');


// ================= HEADER =================
$html = ' ';


// ================= TABEL Siswa =================
$html .= '
        <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th>Nomor</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
        ';


$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM `tbl_admin`");
foreach ($query as $data) {
    $html .= '
<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data['Username'] . '</td>
                    <td>' . $data['Password'] . '</td>
                    <td>' . $data['Nama'] . '</td>
                    <td>' . $data['Alamat'] . '</td>
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