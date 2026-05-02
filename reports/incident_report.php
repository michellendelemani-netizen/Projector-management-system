<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once("../connection.php");

    $sql = "SELECT 
                i.incident_id,
                p.model,
                i.type,
                i.description,
                i.reported_at,
                i.status,
                t.transaction_id
            FROM incidents i
            JOIN projectors p 
                ON i.projector_id = p.projector_id
            LEFT JOIN transactions t 
                ON i.transaction_id = t.transaction_id
            ORDER BY i.reported_at DESC";

    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Incident Report</title>
    <link rel="stylesheet" href="incident_report.css">
</head>
<body>

    <h2>Incident Report (Missing / Damaged)</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Projector</th>
            <th>Type</th>
            <th>Description</th>
            <th>Transaction</th>
            <th>Reported At</th>
            <th>Status</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['incident_id']; ?></td>
                <td><?php echo $row['model']; ?></td>

                <td class="<?php echo $row['type']; ?>">
                    <?php echo strtoupper($row['type']); ?>
                </td>

                <td><?php echo $row['description']; ?></td>

                <td>
                    <?php 
                    echo $row['transaction_id'] ? $row['transaction_id'] : 'N/A'; 
                    ?>
                </td>

                <td><?php echo $row['reported_at']; ?></td>

                <td class="<?php echo $row['status']; ?>">
                    <?php echo strtoupper($row['status']); ?>
                </td>
            </tr>
        <?php } ?>

    </table>
    <div class="pdf-btn-container">
        <form method="post" action="incident_pdf.php">
            <button type="submit" class="pdf-btn">Generate PDF</button>
        </form>
    </div>
</body>
</html>