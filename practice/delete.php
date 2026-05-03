<?php
include "connection.php";

$id = intval($_GET['id']);

// 1. Get the row first
$get = "SELECT * FROM projectors WHERE projector_id=$id";
$result = $conn->query($get);

if (!$result) {
    die("Fetch error: " . $conn->error);
}

$row = $result->fetch_assoc();

if ($row) {

    // 2. Insert into deleted table
    $insert = "INSERT INTO deleted_projectors 
    (projector_id, model, life_span, manufactured_date, bought_date, status, expected_end_of_life, projector_condition)
    VALUES (
        '{$row['projector_id']}',
        '{$row['model']}',
        '{$row['life_span']}',
        '{$row['manufactured_date']}',
        '{$row['bought_date']}',
        '{$row['status']}',
        '{$row['expected_end_of_life']}',
        '{$row['projector_condition']}'
    )";

    if (!$conn->query($insert)) {
        die("Insert error: " . $conn->error);
    }

    // 3. Delete from main table
    $delete = "DELETE FROM projectors WHERE projector_id=$id";

    if (!$conn->query($delete)) {
        die("Delete error: " . $conn->error);
    }

    header("Location: inventory.php");
    exit();
}
?>