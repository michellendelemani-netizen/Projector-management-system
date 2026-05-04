<?php
include("connection.php");

// AVAILABLE PROJETORS
$available = $conn->query("SELECT COUNT(*) AS total FROM projectors WHERE status='available'")
->fetch_assoc()['total'];

// FAULTY PROJETORS
$faulty = $conn->query("SELECT COUNT(*) AS total FROM projectors WHERE status='faulty'")
->fetch_assoc()['total'];

// BORROWED PROJECTORS
$borrowed = $conn->query("SELECT COUNT(*) AS total FROM transactions WHERE status='pending'")
->fetch_assoc()['total'];

// OVERDUE PROJECTORS
$overdue = $conn->query("
SELECT COUNT(*) AS total FROM transactions 
WHERE status='pending' AND expected_return_at < NOW()
")->fetch_assoc()['total'];

// RECENT ACTIVITY
$activityQuery = "
SELECT p.model, t.status, t.borrowed_at, t.returned_at
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
ORDER BY t.borrowed_at DESC
LIMIT 5
";
$activity = $conn->query($activityQuery);
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

  <!-- Actions -->
  <!-- <a href="Lend.php" class="card action">➕ Issue Projector</a>
  <a href="return.php" class="card action">🔄 Return Projector</a> -->

  <!-- Status -->
  <div class="card">Available <br><b><?php echo $available; ?></b></div>
  <div class="card">Borrowed <br><b><?php echo $borrowed; ?></b></div>
  <div class="card">Faulty <br><b><?php echo $faulty; ?></b></div>

  <!-- Urgent -->
  <div class="box alerts">
    <h3>⏰ Urgent</h3>
    <p><?php echo $overdue; ?> overdue projectors</p>
  </div>

  <!-- Activity -->
  <div class="box">
    <h3>Recent Activity</h3>

    <?php
    if ($activity->num_rows > 0) {
        while($row = $activity->fetch_assoc()) {
            if ($row['status'] == 'returned') {
                echo "<p>Returned " . $row['model'] . "</p>";
            } else {
                echo "<p>Borrowed " . $row['model'] . "</p>";
            }
        }
    } else {
        echo "<p>No activity</p>";
    }
    ?>

  </div>

</div>

</body>
</html>