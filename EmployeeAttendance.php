<?php
include 'databaseConnection.php';

$LoggedInEmployeeId = '1';

$sql = "SELECT a.date, e.name, a.status
        FROM attendance a
        JOIN employees e ON a.employee_id = e.id
        WHERE a.employee_id = ?
        ORDER BY a.date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $LoggedInEmployeeId);
$stmt->execute();
$attendanceRecords = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left">
            
        </div>
        <div class="center">
            Hello, Mr. Rafsan
        </div>
        <div class="right">
            right sidebar
        </div>
    </div>
    <div class="page">
        <div class="dashboardContents">
            
        <?php
        include 'EmployeeSidebar.php';
        ?>

        </div>
        <div class="manage">

        <h1>Attendance Records</h1>
        <table border="1" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($attendanceRecords->num_rows > 0): ?>
                <?php while ($row = $attendanceRecords->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">No attendance records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>

        </div>
        <div class="rightSidebar">
            others
        </div>
    </div>
</body>
</html>

