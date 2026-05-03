<?php
include("connection.php");

// TOTAL
$total = $conn->query("SELECT COUNT(*) AS total FROM projectors")->fetch_assoc()['total'];

// AVAILABLE
$available = $conn->query("SELECT COUNT(*) AS available FROM projectors WHERE status='available'")
->fetch_assoc()['available'];

// BORROWED (active)
$borrowed = $conn->query("SELECT COUNT(*) AS borrowed FROM transactions WHERE status='pending'")
->fetch_assoc()['borrowed'];

// DAMAGED (faulty projectors)
$damaged = $conn->query("SELECT COUNT(*) AS damaged FROM projectors WHERE status='faulty'")
->fetch_assoc()['damaged'];

// OVERDUE
$overdue = $conn->query("
SELECT COUNT(*) AS overdue FROM transactions 
WHERE status='pending' AND expected_return_at < NOW()
")->fetch_assoc()['overdue'];

// MOST USED (based on transactions)
$mostUsedQuery = "
SELECT p.model, COUNT(*) AS total_used
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
GROUP BY t.projector_id
ORDER BY total_used DESC
LIMIT 1
";
$mostUsedResult = $conn->query($mostUsedQuery);
$mostUsed = $mostUsedResult->fetch_assoc()['model'] ?? "N/A";

// LEAST USED
$leastUsedQuery = "
SELECT p.model, COUNT(*) AS total_used
FROM transactions t
JOIN projectors p ON t.projector_id = p.projector_id
GROUP BY t.projector_id
ORDER BY total_used ASC
LIMIT 1
";
$leastUsedResult = $conn->query($leastUsedQuery);
$leastUsed = $leastUsedResult->fetch_assoc()['model'] ?? "N/A";

// NEW PROJECTORS (last 30 days based on bought_date)
$newProjectors = $conn->query("
SELECT COUNT(*) AS new_count FROM projectors 
WHERE bought_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
")->fetch_assoc()['new_count'];
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
    <p><?php echo $overdue; ?> Projectors overdue</p>
    <p><?php echo $damaged; ?> Faulty projectors</p>
  </div>

  <!-- Insights -->
  <div class="box insights">
    <h3>📊 Insights</h3>
    <p>Most used: <?php echo $mostUsed; ?></p>
    <p>Least used: <?php echo $leastUsed; ?></p>
  </div>

  <!-- What's New -->
  <div class="box news">
    <h3>🆕 What's New</h3>
    <p><?php echo $newProjectors; ?> new projectors added</p>
  </div>

  <!-- Summary -->
  <div class="card">Total Projectors <br><b><?php echo $total; ?></b></div>
  <div class="card">Available <br><b><?php echo $available; ?></b></div>
  <div class="card">Borrowed <br><b><?php echo $borrowed; ?></b></div>
  <div class="card">Faulty <br><b><?php echo $damaged; ?></b></div>

</div>

</body>
</html>