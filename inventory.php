<?php
$conn = mysqli_connect("localhost","root","","inventory");

if(!$conn){
    die("Connection Failed");
}

/* DELETE */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM projectors WHERE projector_id='$id'");
    header("Location: upgrade_projectors.php");
}

/* BORROW */
if(isset($_GET['borrow'])){
    $id = $_GET['borrow'];
    mysqli_query($conn,"UPDATE projectors 
                        SET projectors_status='Borrowed' 
                        WHERE projector_id='$id'");
    header("Location: upgrade_projectors.php");
}

/* RETURN */
if(isset($_GET['return'])){
    $id = $_GET['return'];
    mysqli_query($conn,"UPDATE projectors 
                        SET projectors_status='Available' 
                        WHERE projector_id='$id'");
    header("Location: upgrade_projectors.php");
}

/* SEARCH */
$search = "";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql = "SELECT * FROM projectors 
            WHERE brand LIKE '%$search%'";
}else{
    $sql = "SELECT * FROM projectors";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Projector Inventory</title>
<style>
body{
    font-family:Arial;
    background:#f5f5f5;
}
.container{
    width:90%;
    margin:auto;
}
h2{
    text-align:center;
}
table{
    width:100%;
    border-collapse:collapse;
    background:white;
}
th,td{
    padding:12px;
    border:1px solid #ccc;
    text-align:center;
}
th{
    background:#333;
    color:white;
}
.available{
    color:green;
    font-weight:bold;
}
.borrowed{
    color:red;
    font-weight:bold;
}
button{
    padding:6px 10px;
    border:none;
    cursor:pointer;
}
.borrowbtn{background:orange;color:white;}
.returnbtn{background:green;color:white;}
.deletebtn{background:red;color:white;}
.searchbox{
    margin-bottom:15px;
    text-align:center;
}
input{
    padding:8px;
    width:250px;
}
</style>
</head>
<body>

<div class="container">
<h2>Projector Inventory</h2>

<div class="searchbox">
<form method="POST">
<input type="text" name="search" placeholder="Search brand...">
<button type="submit">Search</button>
</form>
</div>

<table>
<tr>
<th>ID</th>
<th>Brand</th>
<th>Status</th>
<th>Condition</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['projector_id']; ?></td>
<td><?php echo $row['Brand']; ?></td>

<td>
<?php
if($row['projectors_status']=="Available"){
    echo "<span class='available'>Available</span>";
}else{
    echo "<span class='borrowed'>Borrowed</span>";
}
?>
</td>

<td><?php echo $row['projectors_condition']; ?></td>

<td>

<?php if($row['projectors_status']=="Available"){ ?>
<a href="?borrow=<?php echo $row['projector_id']; ?>">
<button class="borrowbtn">Borrow</button>
</a>
<?php } else { ?>
<a href="?return=<?php echo $row['projector_id']; ?>">
<button class="returnbtn">Suspend</button>
</a>
<?php } ?>

<a href="?delete=<?php echo $row['projector_id']; ?>" 
onclick="return confirm('Delete this projector?')">
<button class="deletebtn">Delete</button>
</a>

</td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>