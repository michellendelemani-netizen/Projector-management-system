<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
        // Protect page (redirect if not logged in)
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] != 'desk') {
        if (!isset($_SESSION['user_id']) && $_SESSION['role'] != 'desk') {
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
    <!-- wrapper for the humburger and profile -->
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
            <a href="desk.php" class="active"><i class="fa-solid fa-home"></i>Dashboard</a>
            <a href="Lend.php"><i class="fa-solid fa-hand-holding"></i>Lend</a>
            <a href="track.php"><i class="fa-solid fa-location-dot"></i>Track</a>
            <a href="return.php"><i class="fa fa-undo"></i>Return</a>
            <a href="notifications.php">
                <span class="tab-icon">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge">3</span>
                </span>
                Notifications
            </a>
        </div>

    <!-- top user section -->
    <div class="top-bar">
        <div class="user-info">
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
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
        <a href="desk.php"><i class="fa-solid fa-home"></i>Dashboard</a>
        <a href="Lend.php"><i class="fa-solid fa-hand-holding"></i>Lend</a>
        <a href="track.php"><i class="fa-solid fa-location-dot"></i>Track</a>
        <a href="notifications.php">
            <span class="tab-icon">
                <i class="fa-solid fa-bell"></i>
                <span class="badge">3</span>
            </span>
            Notifications
        </a>
    </div>

    </div>

    <script src="scripts/navigation.js"></script>

</body>
</html>