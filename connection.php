<?php
$conn = new mysqli( "localhost", "root", "", "projector_system");

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
?>