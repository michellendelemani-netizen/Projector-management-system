<?php
require("connection.php");

$transaction = null;
$error = "";
$success = "";

// HANDLE RETURN SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transaction_id'])) {

    $id = $_POST['transaction_id'];
    $date = $_POST['returned_at'];
    $condition = $_POST['projector_condition'];

    // First get projector_id from transaction
    $getProjector = $conn->query("SELECT projector_id, borrowed_at FROM transactions WHERE transaction_id = '$id'");
    $row = $getProjector->fetch_assoc();
    $projector_id = $row['projector_id'];
    $borrowed_at = $row['borrowed_at'];


        // VALIDATE RETURN DATE
    if (strtotime($date) < strtotime($borrowed_at)) {
        $error = "Return date cannot be before borrowed date.";
    } else {

    // Update transaction
    $sql = "UPDATE transactions 
            SET status = 'returned',
                returned_at = '$date',
                projector_condition = '$condition'
            WHERE transaction_id = '$id'";

        if ($conn->query($sql)) {

                //Update
                if ($condition == "faulty") {
                    $conn->query("UPDATE projectors 
                                SET status = 'faulty', is_active = 0 
                                WHERE projector_id = '$projector_id'");
                } else {
                    $conn->query("UPDATE projectors 
                                SET status = 'available', is_active = 1 
                                WHERE projector_id = '$projector_id'");
                }

                $success = "Projector returned successfully!";

        } else {
        $error = "Error: " . $conn->error;
        }
    }
}

// SEARCH BY PROJECTOR ID
if (isset($_GET['projector_id']) && $_GET['projector_id'] != "") {

    $pid = $_GET['projector_id'];

    $sql = "
        SELECT t.*, 
               s.first_name AS student_first, s.last_name AS student_last,
               l.first_name AS lecturer_first, l.last_name AS lecturer_last
        FROM transactions t
        LEFT JOIN students s ON t.student_id = s.student_id
        LEFT JOIN lecturers l ON t.lecturer_id = l.lecturer_id
        WHERE t.projector_id = '$pid' AND t.status != 'returned'
        ORDER BY t.transaction_id DESC
        LIMIT 1
    ";

    $result = $conn->query($sql);
    $transaction = $result->fetch_assoc();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Return Projector</title>
<link rel="stylesheet" href="css/return.css">
</head>
<body>
    <?php include("desk-navigation.php");?>

        <div class="container">
                
            <h2>Return Projector</h2>

            <!-- SEARCH -->
            <form method="GET" class="search-box">
                <input type="text" name="projector_id" placeholder="Enter Projector ID" required>
                <button type="submit">Search</button>
            </form>

            <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
            <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

            <!-- CARD -->
            <?php if ($transaction) { ?>

            <div class="card">

            <form method="POST">

                <input type="hidden" name="transaction_id" value="<?= $transaction['transaction_id'] ?>">

                <div class="row">
                    <label>Projector ID:</label>
                    <div><?= $transaction['projector_id'] ?></div>
                </div>

                <div class="row">
                    <label>Borrowed By:</label>
                    <div>
                        <?= $transaction['student_first'] ?? $transaction['lecturer_first'] ?>
                        <?= $transaction['student_last'] ?? $transaction['lecturer_last'] ?>
                    </div>
                </div>

                <div class="row">
                    <label>Borrowed At:</label>
                    <div><?= $transaction['borrowed_at'] ?></div>
                </div>

                <div class="row">
                    <label>Expected Return:</label>
                    <div><?= $transaction['expected_return_at'] ?></div>
                </div>

                <div class="row">
                    <label>Return Date:</label>
                    <input type="datetime-local" name="returned_at" required>
                </div>

                <div class="row">
                    <label>Condition:</label>
                    <select name="projector_condition" required>
                        <option value="">Select</option>
                        <option value="good">Good</option>
                        <option value="faulty">Faulty</option>
                    </select>
                </div>

                <div class="btn-group">
                    <button class="submit" type="submit">Confirm Return</button>
                    <a href="return.php" class="cancel">Cancel</a>
                </div>
            </form>

            </div>

            <?php } else if (isset($_GET['projector_id'])) { ?>
                <p>No active borrowing found for this projector.</p>
            <?php } ?>

        </div>

</body>
</html>