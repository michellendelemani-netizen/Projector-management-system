<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inputUser = mysqli_real_escape_string($conn, $_POST['user']);
    $inputPass = mysqli_real_escape_string($conn, $_POST['password']);

    // Match by email OR first_name
    $sql = "SELECT * FROM users 
        WHERE email = '$inputUser' OR first_name = '$inputUser'";

    $result = mysqli_query($conn, $sql);

    if ($user = mysqli_fetch_assoc($result)) {

        // Plain password check (only if passwords are not hashed)
       if ($user['password'] == $inputPass) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['middle_name'] = $user['middle_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['home'] = $user['home'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "admin" || $user['role'] == "manager") {
                header("Location: management.php");
            } else {
                header("Location: desk.php");
            }
            exit();
        }
    }

    $error = "incorrect username or password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Projector Management Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="user" placeholder="Email or Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>