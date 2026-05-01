/*<?php
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

        if ($conn->query($sql) === TRUE) {
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