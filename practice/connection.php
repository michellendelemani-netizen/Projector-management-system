<?php
$conn = new mysqli( "localhost", "root", "", "projectordb");

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
?>