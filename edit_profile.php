<?php
include 'connection.php';
session_start();

// Protect page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = "";
$error = "";

// FETCH USER DATA
$sql = "SELECT first_name, middle_name, last_name, email, home, phone_number 
        FROM users 
        WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


$changePassword = isset($_POST['new_password']) && !empty($_POST['new_password']);

// HANDLE UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $home = mysqli_real_escape_string($conn, $_POST['home']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);

    $newPass = $_POST['new_password'];
    $confirmPass = $_POST['confirm_password'];
    $currentPass = $_POST['current_password'];

    $passwordQuery = "";

    // If user wants to change password
    if ($changePassword) {

        // Get current password from DB
        $checkSql = "SELECT password FROM users WHERE user_id='$user_id'";
        $checkResult = mysqli_query($conn, $checkSql);
        $checkUser = mysqli_fetch_assoc($checkResult);

        // Compare plain text (since not hashed)
        if ($currentPass !== $checkUser['password']) {
            $error = "Current password is incorrect!";
        } 
        elseif ($newPass !== $confirmPass) {
            $error = "New passwords do not match!";
        } 
        else {
            $passwordQuery = ", password='$newPass'";
        }
    }

    // Only update if no error
    if (empty($error)) {

        $update = "UPDATE users SET 
            first_name='$first',
            middle_name='$middle',
            last_name='$last',
            email='$email',
            home='$home',
            phone_number='$phone'
            $passwordQuery
            WHERE user_id='$user_id'";

        if (mysqli_query($conn, $update)) {

            $success = empty($newPass) 
                ? "Profile updated successfully!" 
                : "Profile and password updated successfully!";

            $_SESSION['first_name'] = $first;
            $_SESSION['last_name'] = $last;
            $_SESSION['email'] = $email;

            // Refresh data
            $user = [
                'first_name' => $first,
                'middle_name' => $middle,
                'last_name' => $last,
                'email' => $email,
                'home' => $home,
                'phone_number' => $phone
            ];

        } else {
            $error = "Error updating profile!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/edit_profile.css">
</head>
<body>

<div class="login-box">
    <h2>Edit Profile</h2>

    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST">

        first Name:<input type="text" name="first_name" value="<?= $user['first_name'] ?>" required>
        last Name: <input type="text" name="middle_name" value="<?= $user['middle_name'] ?>">
        Last name: <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required>

        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>

        Home: <input type="text" name="home" value="<?= $user['home'] ?>">
        Phone Number: <input type="text" name="phone_number" value="<?= $user['phone_number'] ?>">
        <hr>

        <label>
            <input type="checkbox" id="changePassToggle"> Change Password
        </label>

        <div id="passwordFields" style="display:none;">

            <label>Current Password:</label>
            <input type="password" name="current_password" placeholder="Enter current password">

            <label>New Password:</label>
            <input type="password" name="new_password" placeholder="Enter new password">

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" placeholder="Repeat new password">

        </div>
        <button type="submit">Update Profile</button><br>
        <button type="button" onclick="history.back()" class="back-btn">← Go Back</button>
    </form>

</div>

<script>
document.getElementById("changePassToggle").addEventListener("change", function() {
    document.getElementById("passwordFields").style.display = 
        this.checked ? "block" : "none";
});
</script>
</body>
</html>