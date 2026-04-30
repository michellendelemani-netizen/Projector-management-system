<?php
session_start();

$users = [
    [
        "username" => "manager1",
        "email" => "manager@gmail.com",
        "password" => "admin123",
        "role" => "admin"
    ],
    [
        "username" => "clerk1",
        "email" => "clerk@gmail.com",
        "password" => "clerk123",
        "role" => "clerk"
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUser = $_POST['user'];
    $inputPass = $_POST['password'];

    $found = false;

    foreach ($users as $user) {
        if (
            ($user['username'] == $inputUser || $user['email'] == $inputUser) &&
            $user['password'] == $inputPass
        ) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: clerk_dashboard.php");
            }
            exit();
        }
    }

    $error = "Invalid login details!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Projector Management Login</title>
     <link rel="stylesheet" href="css/login.css">
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