<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    <?php include("manager-navigation.html"); ?>
    <!-- <hr> -->
     <br>

<div class="container">

    <h1>
        <i class="fa-solid fa-users"></i>
        PROJECTOR MANAGEMENT USER REGISTRATION
    </h1>

    <?php if (isset($_GET['success'])): ?>
    <div class="popup success">
        User added successfully and email sent!
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="popup error">
        Something went wrong!
    </div>
<?php endif; ?>

    <form action="user.php" method="POST">

        <div class="form-group">
            <label>Desk ID</label>
            <input type="text" name="desk_id" required>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Add User</button>

    </form>

</div>

</body>

