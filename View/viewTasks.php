<?php
require_once '../Control/auth.php';
checkLogin();

include '../Control/databaseConnection.php';

$sql =  "SELECT task_id, project_id, task_name, assigned_employees, start_time, deadline, task_details, progress FROM tasks"; 
$result = mysqli_query($conn, $sql);

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
        <div class="right">
            
        </div>
    </div>
    <div class="page">
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
        <div class="mainContent">

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="createTask.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Add Tasks</a>
        </div>


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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($task = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $task['task_id']; ?></td>
                                <td><?php echo htmlspecialchars($task['task_name']); ?></td>
                                <td><?php echo htmlspecialchars($task['project_name'] ?? 'No Project'); ?></td>
                                <td><?php echo htmlspecialchars($task['assigned_employees']); ?></td>
                                <td><?php echo htmlspecialchars($task['start_time']); ?></td>
                                <td><?php echo htmlspecialchars($task['deadline']); ?></td>
                                <td><?php echo htmlspecialchars($task['task_details']); ?></td>
                                <td><?php echo htmlspecialchars($task['progress']); ?></td>
                                <td>
                                    <a href="../View/updateTask.php?task_id=<?php echo $task['task_id']; ?>" 
                                    style="padding: 5px 10px; background: blue; color: white; text-decoration: none; border-radius: 3px;">Update</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No tasks found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="rightSidebar"></div>
    </div>
</body>
</html>