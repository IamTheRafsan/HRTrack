<?php
require_once '../Control/auth.php';
checkLogin();

include '../Control/databaseConnection.php';

session_start();
$LoggedInEmployeeID = $_SESSION['userName'];

$sql =  "
SELECT task_id, project_id, task_name, assigned_employees, start_time, deadline, task_details, progress 
FROM tasks 
WHERE assigned_employees LIKE '%$LoggedInEmployeeID%'";

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
    <title>All Tasks</title>
    <link rel="stylesheet" href="../Model/dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left"></div>
        <div class="center">
            <?php
            if (isset($_SESSION['userName'])) {
                echo "Hello, " . $_SESSION['userName'] . "!";
            } else {
                echo "Hello, Guest!";
            }            
            ?>
        </div>
        <div class="right"></div>
    </div>
    <div class="page">
        <div class="menu">
            <?php include 'EmployeeMenu.php'; ?>
        </div>
        <div class="mainContent">


            <h1>All Tasks</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Project</th>
                        <th>Assigned Employees</th>
                        <th>Start Time</th>
                        <th>Deadline</th>
                        <th>Details</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0):
                        while ($task = $result->fetch_row()):
                    ?>
                            <tr>
                                <td><?php echo $task[0]; ?></td> 
                                <td><?php echo htmlspecialchars($task[1]); ?></td> 
                                <td><?php echo htmlspecialchars($task[2] ?? 'No Project'); ?></td> 
                                <td><?php echo htmlspecialchars($task[3]); ?></td> 
                                <td><?php echo htmlspecialchars($task[4]); ?></td> 
                                <td><?php echo htmlspecialchars($task[5]); ?></td>
                                <td><?php echo htmlspecialchars($task[6]); ?></td>
                                <td><?php echo htmlspecialchars($task[7]); ?></td> 
                            </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="8">No tasks found.</td>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
        <div class="rightSidebar"></div>
    </div>
</body>
</html>