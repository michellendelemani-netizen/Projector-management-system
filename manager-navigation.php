<?php
session_start();

        // Protect page (redirect if not logged in or role is does not fit)
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] != 'admin' 
            && $_SESSION['role'] != 'manager') {
            header("Location: login.php");
            exit();
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/navigation.css">

</head>

<body>


    <div class="all-wrapper">

        <div class="nav-title">
            <i class="fa-solid fa-video"></i>Projector Management System
        </div>
        <!-- top user section -->
        <div class="nav-wrapper">
            <!-- hamburger icon for smaller screens dropdown -->
            <div class="menu-toggle" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </div>

        <!-- tabs -->
        <div class="tabs" id="tabs">
            <a href="management.php" class="active"><i class="fa-solid fa-home"></i>Dashboard</a>
            <a href="Inventory.php"><i class="fa-solid fa-clipboard-list"></i>Inventory</a>
            <a href="user-management.php"><i class="fa-solid fa-users"></i>User Management</a>
            <a href="reports/report_landing_page.php"><i class="fa-solid fa-chart-line"></i>Reports</a>
        </div>

        

            <!-- top user section -->
            <div class="top-bar">
                <div class="user-info">
                    <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
                </div>
                <a href="logout.php" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <a href="edit_profile.php" class="profile-icon">
                    <i class="fa-solid fa-circle-user"></i>
                </a>
            </div>

        </div>
        <!-- smaller screens(mobile) menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="management.php"><i class="fa-solid fa-home"></i>Dashboard</a>
            <a href="Inventory.php"><i class="fa-solid fa-clipboard-list"></i>Inventory</a>
            <a href="user-management.php"><i class="fa-solid fa-users"></i>User Management</a>
            <a href="reports/reports_landing_page"><i class="fa-solid fa-chart-line"></i>Reports</a>
        </div>
    </div>

    <script src="scripts/navigation.js"></script>

</body>

</html>