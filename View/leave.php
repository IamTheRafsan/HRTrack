<?php

require_once '../Control/auth.php';
checkLogin();


include '../Control/databaseConnection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$query = "SELECT lr.leave_id, e.name AS employee_name, lr.subject, lr.reason, lr.leave_from, lr.leave_to, lr.status 
          FROM leave_requests lr 
          JOIN employees e ON lr.employee_id = e.id 
          ORDER BY lr.request_date DESC";

$result = mysqli_query($conn, $query);
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
            <?php
            if (isset($_SESSION['userName'])) {
                echo "Hello, " . $_SESSION['userName'] . "!";
            } else {
                echo "Hello, Guest!";
            }            
            ?>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="page">
        <div class="menu">
            
        <?php
        include 'menu.php';
        ?>
    

        </div>
        <div class="mainContent">

        <h1>Leave Requests</h1>
        
        <table border="1">
            <tr>
                <th>Employee Name</th>
                <th>Subject</th>
                <th>Reason</th>
                <th>Leave From</th>
                <th>Leave To</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            
            <?php
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<td>{$row[1]}</td>"; 
                echo "<td>{$row[2]}</td>"; 
                echo "<td>{$row[3]}</td>"; 
                echo "<td>{$row[4]}</td>"; 
                echo "<td>{$row[5]}</td>"; 
                echo "<td>{$row[6]}</td>"; 
                echo "<td>
                        <form action='../Control/leaveController.php' method='POST'>
                            <input type='hidden' name='leave_id' value='{$row[0]}'>
                            <select name='status' required>
                                <option value='Approved' " . ($row[6] == 'Approved' ? 'selected' : '') . ">Approve</option>
                                <option value='Rejected' " . ($row[6] == 'Rejected' ? 'selected' : '') . ">Reject</option>
                            </select>
                            <button type='submit'>Update Status</button>
                        </form>
                      </td>";
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
?>
