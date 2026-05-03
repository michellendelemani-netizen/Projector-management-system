<?php
session_start();
include "connection.php";

// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $projector_id = $_POST['projector_id'];
    $user_type    = $_POST['user_type']; 
    $borrower_id  = $_POST['user_id'];
    $reason       = $_POST['reason'];
    $borrow_time  = $_POST['borrow_time'];
    $return_time  = $_POST['return_time'];
    $user_id      = $_SESSION['user_id'];
     // logged in desk user

    // VALIDATE TIME
    if (strtotime($return_time) <= strtotime($borrow_time)) {
        $error = "Return time must be after borrow time.";
    } else {

        // VALIDATE BORROWER EXISTS
        if ($user_type == "Student") {

            $check = $conn->query("SELECT * FROM students WHERE student_id = '$borrower_id'");

            if ($check->num_rows == 0) {
                $error = "Student ID does not exist!";
            } else {
                $student_id = ($user_type == "Student") ? "'$borrower_id'" : "NULL";
                $lecturer_id = ($user_type == "Lecturer") ? "'$borrower_id'" : "NULL";
                $borrower_type = "student";
            }

        } else {

            $check = $conn->query("SELECT * FROM lecturers WHERE lecturer_id = '$borrower_id'");

            if ($check->num_rows == 0) {
                $error = "Lecturer ID does not exist!";
            } else {
                $student_id = ($user_type == "Student") ? "'$borrower_id'" : "NULL";
                $lecturer_id = ($user_type == "Lecturer") ? "'$borrower_id'" : "NULL";
                $borrower_type = "lecturer";
            }
        }

        if (empty($error)) {

            $sql = "INSERT INTO transactions 
            (user_id, projector_id, student_id, lecturer_id, borrower_type, borrowed_at, expected_return_at, reason, status)
            VALUES 
            ('$user_id', '$projector_id', $student_id, $lecturer_id, '$borrower_type', '$borrow_time', '$return_time', '$reason', 'pending')";

            if ($conn->query($sql) === TRUE) {

                // UPDATE PROJECTOR STATUS
                $conn->query("UPDATE projectors SET status='borrowed' WHERE projector_id='$projector_id'");

                $success = "Projector borrowed successfully!";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lend Projector</title>
    <link rel="stylesheet" href="css/lend.css">
    <link rel="stylesheet" href="css/navigation.css">
</head>
<body>

<?php include("desk-navigation.php"); ?>

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
                <label>Lecturer / Student ID</label>
                <input type="text" name="user_id" required>
            </div>
        </div>

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
                <input type="datetime-local" name="borrow_time" required>
            </div>

            <div class="form-group">
                <label>Return Time</label>
                <input type="datetime-local" name="return_time" required>
            </div>
        </div>

        <button type="submit" onclick="return confirm('Confirm borrowing this projector?');">
            Lend Projector
        </button>

    </form>
</div>

</body>
</html>