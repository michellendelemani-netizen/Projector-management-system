<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

require_once("connection.php");

$sql = "SELECT 
            i.incident_id,
            p.model,
            i.type,
            i.description,
            i.reported_at,
            i.status
        FROM incidents i
        JOIN projectors p 
            ON i.projector_id = p.projector_id
        ORDER BY i.reported_at DESC";

$result = mysqli_query($conn, $sql);

$html = '
    <h2 style="text-align:center;">Incident Report</h2>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Projector</th>
        <th>Type</th>
        <th>Description</th>
        <th>Reported At</th>
        <th>Status</th>
    </tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
        <td>'.$row['incident_id'].'</td>
        <td>'.$row['model'].'</td>
        <td>'.$row['type'].'</td>
        <td>'.$row['description'].'</td>
        <td>'.$row['reported_at'].'</td>
        <td>'.$row['status'].'</td>
    </tr>';
}

$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("incident_report.pdf", ["Attachment" => false]);