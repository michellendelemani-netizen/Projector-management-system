<?php
$conn = new mysqli("localhost", "root", "", "projectordb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $desk_id = $_POST['desk_id'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email != '' && $fullname != '') {

        $sql = "INSERT INTO users (desk_id, fullname, phone, email, password)
                VALUES ('$desk_id', '$fullname', '$phone', '$email', '$password')";

        if ($conn->query($sql)) {
            $message = "User added successfully!";
            $type = "success";
        } else {
            $message = "Error: " . $conn->error;
            $type = "error";
        }

    } else {
        $message = "Please fill all required fields!";
        $type = "error";
    }
}
?>

<!DOCTYPE html>
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
</html>