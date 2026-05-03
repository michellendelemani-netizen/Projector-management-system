<?php
include 'connection.php';
$search= "";
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

    <form method="GET" >
        <input type="text" name="query" placeholder="Search..." value="<?php echo"$search" ; ?>">
        <button type="submit">Search</button>
        
        <style>
            button{
                background-color: #6200ee;
                color: white;
                padding: 10px;
                border-radius: 5px;   
            }
            input {
                padding:10px;
                width:250px;
                border:1px solid;
                border-radius:5px;
            }
            </style>

</form>
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
         
        if (isset($_GET['query'])){
             $search= $_GET['query'];
            $sql= "SELECT * FROM projectors WHERE model LIKE '%$search%'";
            $result= $conn->query($sql);
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
                    <button >suspend</button>
                    <button >remove</button>
                    </td>
                </tr>";
            }
        }else{
            echo "<tr><td colspan='7'>No projectors found</td></tr>";
        }
    }
        
        ?>
    </table>
    <div>
        <a href="add_projector.html"><button>add</button></a>
    </div>
    </body>
    

</html>