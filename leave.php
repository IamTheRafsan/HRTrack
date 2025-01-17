<?php
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $leave_id = intval($_POST['leave_id']);
    $status = $_POST['status'];


    if (!in_array($status, ['Approved', 'Rejected'])) {
        echo "Invalid status.";
        exit;
    }


    $sql = "UPDATE leave_requests SET status = ? WHERE leave_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $leave_id);


    if ($stmt->execute()) {
        echo "Leave request status updated successfully!";

        header("Location: leave.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$query = "SELECT lr.leave_id, e.name AS employee_name, lr.subject, lr.reason, lr.leave_from, lr.leave_to, lr.status 
          FROM leave_requests lr 
          JOIN employees e ON lr.employee_id = e.id 
          ORDER BY lr.request_date DESC";

$result = $conn->query($query);
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
        include 'sidebar.php';
        ?>
    

        </div>
        <div class="manage">

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="payroll.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Pay Salary</a>
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
                <th>Action</th>
            </tr>
            
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['employee_name']}</td>";
                echo "<td>{$row['subject']}</td>";
                echo "<td>{$row['reason']}</td>";
                echo "<td>{$row['leave_from']}</td>";
                echo "<td>{$row['leave_to']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>
                        <form action='leave.php' method='POST'>
                            <input type='hidden' name='leave_id' value='{$row['leave_id']}'>
                            <select name='status' required>
                                <option value='Approved' " . ($row['status'] == 'Approved' ? 'selected' : '') . ">Approve</option>
                                <option value='Rejected' " . ($row['status'] == 'Rejected' ? 'selected' : '') . ">Reject</option>
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
            others
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="page">
        
    </div>
</body>
</html>

<?php

$conn->close();
?>
