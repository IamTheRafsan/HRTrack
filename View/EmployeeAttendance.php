<?php
include '../Control/databaseConnection.php';


$LoggedInEmployeeId = '1';

$sql = "SELECT a.date, e.name, a.status
        FROM attendance a
        JOIN employees e ON a.employee_id = e.id
        WHERE a.employee_id = $LoggedInEmployeeId
        ORDER BY a.date DESC";

$attendanceRecords = mysqli_query($conn, $sql);

if (!$attendanceRecords) {
    die("Error retrieving records: " . mysqli_error($conn));
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Model/dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left">
            
        </div>
        <div class="center">
        </div>
        <div class="right">
        </div>
    </div>
    <div class="page">
        <div class="menu">
            
        <?php
        include 'EmployeeMenu.php';
        ?>

        </div>
        <div class="mainContent">

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
        <?php 
            if ($attendanceRecords->num_rows > 0): 
                while ($row = $attendanceRecords->fetch_row()): 
            ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                    </tr>
            <?php 
                endwhile; 
            else: 
            ?>
                <tr>
                    <td colspan="3">No attendance records found.</td>
                </tr>
            <?php 
            endif; 
            ?>
        </tbody>
        </table>

        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>

