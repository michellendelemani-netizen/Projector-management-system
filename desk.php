<!DOCTYPE html>
<html>
    <head>
  <title>Manager Dashboard</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>

    <body>
  <?php include("desk-navigation.php"); ?>
        <h1>Desk Dashboard</h1>

<div class="dashboard">

  <!-- Quick Actions -->
  <div class="card action">➕ Issue Projector</div>
  <div class="card action">🔄 Return Projector</div>

  <!-- Status -->
  <div class="card">Available <br><b>12</b></div>
  <div class="card">Borrowed <br><b>6</b></div>

  <!-- Urgent -->
  <div class="box alerts">
    <h3>⏰ Urgent</h3>
    <p>3 overdue projectors</p>
  </div>

  <!-- Recent Activity -->
  <div class="box">
    <h3>Recent Activity</h3>
    <p>John borrowed Epson X200</p>
    <p>Mary returned Samsung 99432</p>
  </div>

</div>
    </body>
</html>