<?php
include '../Control/databaseConnection.php';

$LoggedInEmployeeId = '1';

$query = "SELECT lr.leave_id, e.name AS employee_name, lr.subject, lr.reason, lr.leave_from, lr.leave_to, lr.status 
          FROM leave_requests lr 
          JOIN employees e ON lr.employee_id = e.id 
          WHERE lr.employee_id = $LoggedInEmployeeId
          ORDER BY lr.request_date DESC";

$result = $conn->query($query);
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

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="../View/applyLeave.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Apply For Leave</a>
        </div>

        <h1>Leave Requests</h1>
        
        <table border="1">
            <tr>
                <th>Employee Name</th>
                <th>Subject</th>
                <th>Reason</th>
                <th>Leave From</th>
                <th>Leave To</th>
                <th>Status</th>
            </tr>
            
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['employee_name'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    echo "<td>" . $row['reason'] . "</td>";
                    echo "<td>" . $row['leave_from'] . "</td>";
                    echo "<td>" . $row['leave_to'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            ?>

        </table>


            
        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>

`