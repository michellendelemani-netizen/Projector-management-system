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

    <div class="search-container">
    <form method="GET">
        <input type="text" name="query" placeholder="Search by projector id" value="<?php echo "$search"; ?>">
        <button type="submit">Search</button>
    </form>
</div>
<br>
<form method="POST" action="add_proj.php" class="form-inline">
    
    <input type="hidden" name="projector_id" id="projector_id">
     <label for="manufactured_date">Model: </label>
    <input type="text" name="model" placeholder="Model" id="model" required>
    <label for="status">status: </label>
    <input type="number" name="life_span" placeholder="Life Span" id="life_span" required>
    <label for="manufactured_date">manufactured_date: </label>
    <input type="date" name="manufactured_date" id="manufactured_date" required>
    <label for="bought_date">bought_date: </label>
    <input type="date" name="bought_date" id="bought_date" required>
    <input type="text" name="status" id="status" placeholder="status"  required>
    <label for="expected_end_of_life">expected end date: </label>
    <input type="date" name="expected_end_of_life" id="expected_end_life" required>
    <button type="submit" name="save">Add</button>
</form>
<br>
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
                    <button >edit</button>
                    <button >remove</button>
                    </td>
                </tr>";
            }
        }else{
            echo "<tr><td colspan='7'>No projectors found</td></tr>";
        }
    } else{
        //dynamically display projdectors
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
                    <button >edit</button>
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
    </body>
    

</html>