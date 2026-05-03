<?php
require("connection.php");

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name   = $_POST['firstname'];
    $middle_name  = $_POST['middlename'] ?? '';
    $last_name    = $_POST['lastname'];
    $home         = $_POST['home'];
    $phone        = $_POST['phone'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];

    $sql = "INSERT INTO users 
            (first_name, middle_name, last_name, home, phone_number, email, password)
            VALUES 
            ('$first_name', '$middle_name', '$last_name', '$home', '$phone', '$email', '$password')";

    if ($conn->query($sql)) {
        $message = "User added successfully!";
        $type = "success";
    } else {
        $message = "Error: " . $conn->error;
        $type = "error";
    }
}
?>

<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include("manager-navigation.php"); ?>

<div class="container">

    <h1>
        <i class="fa-solid fa-users"></i>
        USER REGISTRATION FORM
    </h1>
    <h5>Fill out this form to register a new at the desk 'authorized' user.</h5>

    <!-- POPUP MESSAGE -->
    <?php if ($message != ""): ?>
        <div class="popup <?php echo $type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="firstname" required>
        </div>

        <div class="form-group">
            <label>Middle Name (Optional)</label>
            <input type="text" name="middlename">
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lastname" required>
        </div>

        <div class="form-group">
            <label>Home</label>
            <input type="text" name="home" required>
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
</html>