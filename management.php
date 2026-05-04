<?php
include("connection.php");

// TOTAL
$total = $conn->query("SELECT COUNT(*) AS total FROM projectors")->fetch_assoc()['total'];

// AVAILABLE
$available = $conn->query("SELECT COUNT(*) AS total FROM projectors WHERE status='available'")
->fetch_assoc()['total'];

// FAULTY
$faulty = $conn->query("SELECT COUNT(*) AS total FROM projectors WHERE status='faulty'")
->fetch_assoc()['total'];

// BORROWED
$borrowed = $conn->query("SELECT COUNT(*) AS total FROM transactions WHERE status='pending'")
->fetch_assoc()['total'];

// OVERDUE
$overdue = $conn->query("
SELECT COUNT(*) AS total FROM transactions 
WHERE status='pending' AND expected_return_at < NOW()
")->fetch_assoc()['total'];

// MOST USED
$mostUsedQuery = "
SELECT p.model, COUNT(*) AS total_used
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
GROUP BY t.projector_id
ORDER BY total_used DESC
LIMIT 1
";
$mostUsed = $conn->query($mostUsedQuery)->fetch_assoc()['model'] ?? "N/A";

// LEAST USED
$leastUsedQuery = "
SELECT p.model, COUNT(*) AS total_used
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
GROUP BY t.projector_id
ORDER BY total_used ASC
LIMIT 1
";
$leastUsed = $conn->query($leastUsedQuery)->fetch_assoc()['model'] ?? "N/A";

// NEW PROJECTORS
$new = $conn->query("
SELECT COUNT(*) AS total FROM projectors 
WHERE bought_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manager Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>

<?php include("manager-navigation.php"); ?>

<h1>Welcome Manager</h1>

<div class="dashboard">

  <!-- Alerts -->
  <div class="box alerts">
    <h3>⚠ Alerts</h3>
    <p><?php echo $overdue; ?> overdue projectors</p>
    <p><?php echo $faulty; ?> faulty projectors</p>
  </div>

  <!-- Insights -->
  <div class="box insights">
    <h3>📊 Insights</h3>
    <p>Most used: <?php echo $mostUsed; ?></p>
    <p>Least used: <?php echo $leastUsed; ?></p>
  </div>

  <!-- New -->
  <div class="box news">
    <h3>🆕 What's New</h3>
    <p><?php echo $new; ?> new projectors</p>
  </div>

  <!-- Summary -->
  <div class="card">Total <br><b><?php echo $total; ?></b></div>
  <div class="card">Available <br><b><?php echo $available; ?></b></div>
  <div class="card">Borrowed <br><b><?php echo $borrowed; ?></b></div>
  <div class="card">Faulty <br><b><?php echo $faulty; ?></b></div>

</div>

</body>
</html>