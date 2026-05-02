<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports Dashboard</title>
    <link rel="stylesheet" href="report_landing_page.css">
</head>
<body>
<?php include("manager-navigation.php"); ?>

<h2>Reports Dashboard</h2>

<div class="container">

    <div class="card maintenance">
        <a href="maintenance_report.php">
            Maintenance Report
        </a>
    </div>

    <div class="card incident">
        <a href="incident_report.php">
            Missing / Damaged Report
        </a>
    </div>

    <div class="card usage">
        <a href="most_used_projectors.php">
            Most Used Projectors
        </a>
    </div>

</div>

</body>
</html>