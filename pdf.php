<?php
session_start();
include 'db.php';


$result = $conn->query("SELECT * FROM users");

$pdf->AddPage();
$pdf->SetFont('times', 'I', 12);

$pdf->Cell(0, 10, 'User Table Report', 0, 1, 'C');

$html = '
<table border="1" cellpadding="8" cellspacing="0">
    <tr style="background-color:lightblue;">
        <th><b>ID</b></th>
        <th><b>Name</b></th>
        <th><b>Email</b></th>
        <th><b>Created At</b></th>
    </tr>
';

while ($row = $result->fetch_assoc()) {

    $html .= '
    <tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['created_at'] . '</td>
    </tr>
    ';
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('User_Report.pdf', 'D');
exit();
?>