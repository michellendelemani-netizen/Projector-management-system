<?php
require("connection.php");

$message = "";
$type = "";
$edit_user = null;
//deleting a user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("UPDATE users SET is_active = 0 WHERE user_id = $id");

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
};

//editing a user
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_user = $conn->query("SELECT * FROM users WHERE user_id = $id")->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name   = $_POST['firstname'];
    $middle_name  = $_POST['middlename'] ?? '';
    $last_name    = $_POST['lastname'];
    $home         = $_POST['home'];
    $phone        = $_POST['phone'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];

    // check if updating
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $sql = "UPDATE users SET 
            first_name = '$first_name',
            middle_name = '$middle_name',
            last_name = '$last_name',
            home = '$home',
            phone_number = '$phone',
            email = '$email',
            password = '$password'
            WHERE user_id = $id";

        if ($conn->query($sql)) {
            $message = "User updated successfully!";
            $type = "success";
            
        } else {
            $message = "Error: " . $conn->error;
            $type = "error";
        }

    } else {

        $sql = "INSERT INTO users 
        (first_name, middle_name, last_name, home, phone_number, email, password, is_active)
        VALUES 
        ('$first_name', '$middle_name', '$last_name', '$home', '$phone', '$email', '$password', 1)";

        if ($conn->query($sql)) {
            $message = "User added successfully!";
            $type = "success";
        } else {
            $message = "Error: " . $conn->error;
            $type = "error";
        }
    }
    
}
?>

<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include("manager-navigation.php"); ?>

<div class="container">

    <h1>
        <i class="fa-solid fa-users"></i>
        USER REGISTRATION FORM
    </h1>
    <h5>Fill out this form to register a new at the desk 'authorized' user.</h5>

    <!-- POPUP MESSAGE -->
    <?php if ($message != ""): ?>
        <div class="popup <?php echo $type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-row">

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?php echo $edit_user['first_name'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Middle Name (Optional)</label>
                <input type="text" name="middlename" value="<?php echo $edit_user['middle_name'] ?? ''; ?>" >
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname"   value="<?php echo $edit_user['last_name'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Home</label>
                <input type="text" name="home" value="<?php echo $edit_user['home'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone"  value="<?php echo $edit_user['phone_number'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $edit_user['email'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $edit_user['password'] ?? ''; ?>" required>
            </div>

            <button type="submit">
                <?php echo isset($edit_user) ? "Update User" : "Add User"; ?>
            </button>

        </div>

</form>

<h2 style="margin-top:30px;">Registered Users</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Home</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM users WHERE is_active = 1 ORDER BY user_id DESC");

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['middle_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['home']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['email']}</td>
                    <td>
                    <a href='?edit={$row['user_id']}'>Edit</a> |
                    <a href='?delete={$row['user_id']}' onclick=\"return confirm('Delete this user?')\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No users found</td></tr>";
    }
    ?>
</table>
</div>

</body>
</html>