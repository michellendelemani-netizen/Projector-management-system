<?php
    require_once("connection.php");

    // Fetch maintenance records
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report</title>
    <link rel="stylesheet" href="maintenance_report.css">

</head>
<body>
    <h2>Maintenance Report</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Projector</th>
            <th>Issue</th>
            <th>Action Taken</th>
            <th>Cost</th>
            <th>Reported At</th>
            <th>Fixed At</th>
            <th>Status</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['maintenance_id']; ?></td>
                <td><?php echo $row['model']; ?></td>
                <td><?php echo $row['issue']; ?></td>
                <td><?php echo $row['action_taken']; ?></td>
                <td><?php echo $row['cost']; ?></td>
                <td><?php echo $row['reported_at']; ?></td>
                <td><?php echo $row['fixed_at']; ?></td>
                <td class="<?php echo $row['status']; ?>">
                    <?php echo strtoupper($row['status']); ?>
                </td>
            </tr>
        <?php } ?>

    </table>
    <div class="pdf-btn-container">
        <form method="post" action="maintenance_pdf.php">
            <button type="submit" class="pdf-btn">Generate PDF</button>
        </form>
    </div>
</body>
</html>