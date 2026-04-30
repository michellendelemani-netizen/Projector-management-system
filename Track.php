<?php 
    require("connection.php");

    //filters logic(either get one or more at once)

    $where = [];

if (!empty($_GET['fromDate'])) {
    $from = $_GET['fromDate'];
    $where[] = "t.borrowed_at >= '$from'";
}

if (!empty($_GET['toDate'])) {
    $to = $_GET['toDate'];
    $where[] = "t.borrowed_at <= '$to'";
}

if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $where[] = "t.status = '$status'";
}

if (!empty($_GET['userType'])) {
    $type = $_GET['userType'];
    $where[] = "t.borrower_type = '$type'";
}

// Borrower ID (student OR lecturer)
if (!empty($_GET['borrowerID'])) {
    $id = $_GET['borrowerID'];
    $where[] = "(t.student_id = '$id' OR t.lecturer_id = '$id')";
}

// User ID (desk user)
if (!empty($_GET['userID'])) {
    $id = $_GET['userID'];
    $where[] = "t.user_id = '$id'";
}

// Projector ID
if (!empty($_GET['projectorID'])) {
    $id = $_GET['projectorID'];
    $where[] = "t.projector_id = '$id'";
}

$whereSQL = "";
if (count($where) > 0) {
    $whereSQL = "WHERE " . implode(" AND ", $where);
}

    $sql = "
SELECT 
    t.transaction_id,
    t.projector_id,
    t.user_id,
    t.borrower_type,
    t.borrowed_at,
    t.expected_return_at,
    t.returned_at,
    t.reason,
    t.status,

    s.student_id,
    s.first_name AS student_first,
    s.last_name AS student_last,
    s.phone_number AS student_phone,
    s.email AS student_email,

    l.lecturer_id,
    l.first_name AS lecturer_first,
    l.last_name AS lecturer_last,
    l.phone_number AS lecturer_phone,
    l.email AS lecturer_email

FROM transactions t
LEFT JOIN students s ON t.student_id = s.student_id
LEFT JOIN lecturers l ON t.lecturer_id = l.lecturer_id
$whereSQL
ORDER BY t.transaction_id DESC
";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="stylesheet" href="css/tracking.css">
</head>
<body>
    <div class="container">
        <?php include("desk-navigation.html"); ?>
        
        <div class="tracking-container">

            <!-- FILTERS -->
            <form method="GET" class="filters">

                <label>From:</label>
                <input type="date" name="fromDate">

                <label>To:</label>
                <input type="date" name="toDate">

                <select name="status">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="returned">Returned</option>
                    <option value="flagged">Flagged</option>
                </select>

                <select name="userType">
                    <option value="">All Users</option>
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>

                <input type="text" name="userID" placeholder="Search by desk userID">
                <input type="text" name="projectorID" placeholder="Search by projectorID">
                <input type="text" name="borrowerID" placeholder="Search by lecturerID/studentID">

                <button type="submit">
                    <i class="fa fa-filter"></i> Filter
                </button>

            </form>
            <!-- TABLE -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Projector ID</th>
                            <th>Desk User</th>
                            <th>Borrower</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Borrowed Date</th>
                            <th>Expected Return</th>
                            <th>Returned on</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- TABLE ROWS(data) -->
                    <tbody id="trackingTable">

                            <?php while ($row = $result->fetch_assoc()) { ?>

                            <?php
                                if ($row['borrower_type'] == 'student') {
                                    $name = $row['student_first'] . " " . $row['student_last'];
                                    $phone = $row['student_phone'];
                                    $email = $row['student_email'];
                                    $borrowerId = $row['student_id'];
                                } else {
                                    $name = $row['lecturer_first'] . " " . $row['lecturer_last'];
                                    $phone = $row['lecturer_phone'];
                                    $email = $row['lecturer_email'];
                                    $borrowerId = $row['lecturer_id'];
                                }
                            ?>

                            <tr>
                                <td><?= $row['transaction_id'] ?></td>
                                <td><?= $row['projector_id'] ?></td>
                                <td><?= $row['user_id'] ?></td>
                                <td><?= $borrowerId ?></td>
                                <td><?= $name ?></td>
                                <td><?= $phone ?></td>
                                <td><?= $email ?></td>
                                <td><?= $row['borrowed_at'] ?></td>
                                <td><?= $row['expected_return_at'] ?></td>
                                <td><?= $row['returned_at'] ?></td>
                                <td><?= $row['reason'] ?></td>

                                <td>
                                    <span class="status <?= $row['status'] ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>

                                <td>
                                    <button class="btn return-btn" onclick="markReturned(this)">
                                        Mark Returned
                                    </button>
                                </td>
                            </tr>

                            <?php } ?>

                    </tbody>
                </table>
        </div>

        </div>

    </div>
    <script src="scripts/tracking.js"></script>
</body>
</html>