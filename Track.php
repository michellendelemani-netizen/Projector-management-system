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
            <div class="filters">

                <label for="">From: </label><input type="date" id="fromDate">
                <label for="">To: </label><input type="date" id="toDate">

                <select id="statusFilter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="returned">Returned</option>
                    <option value="flagged">Flagged</option>
                </select>

                <select id="userTypeFilter">
                    <option value="">All Users</option>
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>

                <input type="text" id="searchUser" placeholder="Search by ID">

                <button onclick="applyFilters()">Filter</button>

            </div>

            <!-- TABLE -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
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

                    <tbody id="trackingTable">

                        <!-- SAMPLE ROW -->
                        <tr>
                            <td>PJ001</td>
                            <td>D001</td>
                            <td>ST123</td>
                            <td>John Doe</td>
                            <td>0991234567</td>
                            <td>john@email.com</td>
                            <td>2026-04-29 10:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>Presentation</td>

                            <td>
                                <span class="status pending">Pending</span>
                            </td>

                            <td>
                                <button class="btn return-btn" onclick="markReturned(this)">
                                    Mark Returned
                                </button>
                            </td>
                        </tr>

                        <!-- SAMPLE ROW 2-->
                        <tr>
                            <td>PJ001</td>
                            <td>D001</td>
                            <td>ST123</td>
                            <td>John Doe</td>
                            <td>0991234567</td>
                            <td>john@email.com</td>
                            <td>2026-04-29 10:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>Presentation</td>

                            <td>
                                <span class="status returned">Returned</span>
                            </td>

                            <td>
                                <button class="btn return-btn" onclick="markReturned(this)">
                                    Mark Returned
                                </button>
                            </td>
                        </tr>

                            <!-- SAMPLE ROW 3 -->
                        <tr>
                            <td>PJ001</td>
                            <td>D001</td>
                            <td>ST123</td>
                            <td>John Doe</td>
                            <td>0991234567</td>
                            <td>john@email.com</td>
                            <td>2026-04-29 10:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>2026-04-29 14:00</td>
                            <td>Presentation</td>

                            <td>
                                <span class="status flagged">Flagged</span>
                            </td>

                            <td>
                                <button class="btn return-btn" onclick="markReturned(this)">
                                    Mark Returned
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>

        </div>

    </div>
    <script src="scripts/tracking.js"></script>
</body>
</html>