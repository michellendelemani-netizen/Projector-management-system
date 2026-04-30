<?php
$conn = new mysqli("localhost", "root", "", "projectordb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $desk_id = $_POST['desk_id'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prevent empty inserts
    if ($email != '' && $fullname != '') {

        $sql = "INSERT INTO users (desk_id, fullname, phone, email, password)
                VALUES ('$desk_id', '$fullname', '$phone', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: user.php?success=1");
            exit();
        } else {
            header("Location: user.php?error=1");
            exit();
        }

    } else {
        header("Location: user.php?error=empty");
        exit();
    }
}

$conn->close();
?>