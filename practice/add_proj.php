<?php
include "connection.php";

if (isset($_POST['save'])) {

    $model = $_POST['model'];
    $life_span = $_POST['life_span'];
    $manufactured_date = $_POST['manufactured_date'];
    $bought_date = $_POST['bought_date'];
    $status = $_POST['status'];
    $end = $_POST['expected_end_of_life'];
    // $condition = $_POST['condition'];

    $sql = "INSERT INTO projectors 
    (model, life_span, manufactured_date, bought_date, status, expected_end_of_life)
    VALUES 
    ('$model', '$life_span', '$manufactured_date', '$bought_date', '$status', '$end')";

    if ($conn->query($sql) === TRUE) {
        echo "Projector added successfully!";
        header("refresh:3;url=inventory.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>