<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

require_once("connection.php");

// Fetch data
$sql = "SELECT 
            m.maintenance_id,
            p.model,
            m.issue,
            m.action_taken,
            m.cost,
            m.reported_at,
            m.fixed_at,
            m.status
        FROM maintenance m
        JOIN projectors p 
            ON m.projector_id = p.projector_id
        ORDER BY m.reported_at DESC";

$result = mysqli_query($conn, $sql);

// Building HTML
$html = '
    <h2 style="text-align:center;">Maintenance Report</h2>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Projector</th>
        <th>Issue</th>
        <th>Action</th>
        <th>Cost</th>
        <th>Reported</th>
        <th>Fixed</th>
        <th>Status</th>
    </tr>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
        <td>'.$row['maintenance_id'].'</td>
        <td>'.$row['model'].'</td>
        <td>'.$row['issue'].'</td>
        <td>'.$row['action_taken'].'</td>
        <td>'.$row['cost'].'</td>
        <td>'.$row['reported_at'].'</td>
        <td>'.$row['fixed_at'].'</td>
        <td>'.$row['status'].'</td>
    </tr>';
}

//appending data to html
$html .= '</table>';

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("maintenance_report.pdf", ["Attachment" => false]);