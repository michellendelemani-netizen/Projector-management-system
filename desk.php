<?php
include("connection.php");

// AVAILABLE
$availableQuery = "SELECT COUNT(*) AS available FROM projectors WHERE status='available'";
$available = $conn->query($availableQuery)->fetch_assoc()['available'];

// BORROWED 
$borrowedQuery = "SELECT COUNT(*) AS borrowed FROM transactions WHERE status='pending'";
$borrowed = $conn->query($borrowedQuery)->fetch_assoc()['borrowed'];

// OVERDUE
$overdueQuery = "SELECT COUNT(*) AS overdue FROM transactions 
WHERE status='pending' AND expected_return_at < NOW()";
$overdue = $conn->query($overdueQuery)->fetch_assoc()['overdue'];

// RECENT ACTIVITY 
$activityQuery = "
SELECT t.status, p.model, t.borrowed_at, t.returned_at
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
ORDER BY t.borrowed_at DESC
LIMIT 5
";
$activityResult = $conn->query($activityQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Desk Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>

<?php include("desk-navigation.php"); ?>

<h1>Desk Dashboard</h1>

<div class="dashboard">

  <!-- Quick Actions -->
  <a href="lend.php" class="card action">➕ Issue Projector</a>
  <a href="return.php" class="card action">🔄 Return Projector</a>

  <!-- Status -->
  <div class="card">Available <br><b><?php echo $available; ?></b></div>
  <div class="card">Borrowed <br><b><?php echo $borrowed; ?></b></div>

  <!-- Urgent -->
  <div class="box alerts">
    <h3>⏰ Urgent</h3>
    <p><?php echo $overdue; ?> overdue projectors</p>
  </div>

  <!-- Recent Activity -->
  <div class="box">
    <h3>Recent Activity</h3>

    <?php
    if ($activityResult->num_rows > 0) {
        while($row = $activityResult->fetch_assoc()) {

            if ($row['status'] == 'pending') {
                echo "<p>Borrowed " . $row['model'] . "</p>";
            } else {
                echo "<p>Returned " . $row['model'] . "</p>";
            }

        }
    } else {
        echo "<p>No recent activity</p>";
    }
    ?>

  </div>

</div>

</body>
</html>