<?php
include "connection.php";

$id = intval($_GET['id']);

$sql = "UPDATE projectors SET status='suspended' WHERE projector_id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: inventory.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>