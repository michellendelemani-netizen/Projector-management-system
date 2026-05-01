<?php
include 'connection.php';
$sql = "SELECT * FROM projectors";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="css/inventory.css">
</head>

<body>
   <?php include("manager-navigation.php"); ?>
    <hr>
    <table border="1">
        <th>projector id</th>
        <th>model</th>
        <th>life_span</th>
        <th>manufactured_date</th>
        <th>bought_date</th>
        <th>status</th>
        <th>expected_end_of_life</th>
        <th>action</th>
        <?php
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>{$row['projector_id']}</td>
                    <td>{$row['model']}</td>
                    <td>{$row['life_span']}</td>
                    <td>{$row['manufactured_date']}</td>
                    <td>{$row['bought_date']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['expected_end_of_life']}</td>
                    <td>
                    <button>suspend</button>
                    <button>remove</button>
                    </td>
                </tr>";
            }
        }else{
            echo "<tr><td colspan='7'>No projectors found</td></tr>";
        }
        
        ?>
    </table>
    <div>
        <a href="add_projector.html"><button>add</button></a>
    </div>

</body>

</html>