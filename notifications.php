<?php
include 'connection.php';
?>

<?php
include 'desk-navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projector Notification</title>
     <link rel="stylesheet" href="tracking.css">
    
</head>
<body>
    <table>
      <tr>
        <th>projector_id</th>
        <th>model</th>
        <th>life_span</th>
        <th>manufactured_date</th>
        <th>bought_date</th>
        <th>status</th>
        <th>expected_end_of_life</th>
        <th>is_active</th>
      </tr>
 
 <?php
 
$conn = new mysqli("localhost", "root", "", "projectordb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT projector_id, model, life_span, manufactured_date, bought_date, status, expected_end_of_life, is_active FROM projectors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        echo "<tr><td>" . $row["projector_id"]. "</td><td>" . $row["model"]. "</td><td>" . $row["life_span"]. "</td><td>" . $row["manufactured_date"]. "</td><td>" . $row["bought_date"]. "</td><td>" . $row["status"]. "</td><td>" . $row["expected_end_of_life"]. "</td><td>" . $row["is_active"]. "</td></tr>";
    }
    echo "</table>"; 
} else {
    echo "0 results";
}

$conn->close();
?>

    </table>
</body>
</html>