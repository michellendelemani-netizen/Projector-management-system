<?php
//include "connection.php";

// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $projector_id = $_POST['projector_id'] ?? '';
    $user_type   = $_POST['user_type'] ?? '';
    $user_id     = $_POST['user_id'] ?? '';
    $full_name   = $_POST['full_name'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $reason      = $_POST['reason'] ?? '';
    $borrow_time = $_POST['borrow_time'] ?? '';
    $return_time = $_POST['return_time'] ?? '';

    // validation
    if (strtotime($return_time) <= strtotime($borrow_time)) {
        $error = "Return time must be after borrow time.";
    } else {

        $sql = "INSERT INTO borrowings 
        (projector_id, user_type, user_id, full_name, phone_number, reason, borrow_time, return_time)
        VALUES
        ('$projector_id', '$user_type', '$user_id', '$full_name', '$phone_number', '$reason', '$borrow_time', '$return_time')";

        if ($conn->query($sql) === TRUE) {
            $conn->query("UPDATE projectors SET status='borrowed' WHERE projector_id='$projector_id'");
            $success = "Projector borrowed successfully!";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lend Projector</title>
    <link rel="stylesheet" href="css/lend.css">
    <link rel="stylesheet" href="css/navigation.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php include("desk-navigation.html"); ?>

<div class="container">

    <?php if (!empty($success)) echo "<div class='success'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <h2 class="page_title">LENDING PROJECTORS</h2>

    <form action="lend.php" method="POST">

        <div class="row">
            <div class="form-group">
                <label>User type</label>
                <select name="user_type">
                    <option value="Lecturer">Lecturer</option>
                    <option value="Student">Student</option>
                </select>
            </div>

            <div class="form-group">
                <label>Lecturer / student ID</label>
                <input type="text" name="user_id" required>
            </div>
        </div>

        <label>Full name</label>
        <input type="text" name="full_name" required>

        <label>Phone Number</label>
        <input type="text" name="phone_number" required>

        <label>Projector</label>
        <select name="projector_id" required>
            <option value="">Select Projector</option>

            <?php
            $result = $conn->query("SELECT * FROM projectors WHERE status='available'");
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['projector_id']."'>
                        Projector ".$row['projector_id']."
                      </option>";
            }
            ?>
        </select>

        <label>Reason</label>
        <input type="text" name="reason" required>

        <div class="row">
            <div class="form-group">
                <label>Borrow Time</label>
                <input type="datetime-local" name="borrow_time">
            </div>

            <div class="form-group">
                <label>Return Time</label>
                <input type="datetime-local" name="return_time">
            </div>
        </div>

        <button type="submit" onclick="return confirm('Confirm borrowing this projector?');">
            lend Projector
        </button>

    </form>
</div>

</body>
</html>