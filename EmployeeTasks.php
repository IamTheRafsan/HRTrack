<?php
include 'databaseConnection.php';

$LoggedInEmployeeID = "Mamun Sarkar";

$LoggedInEmployeeID = $conn->real_escape_string($LoggedInEmployeeID);

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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left"></div>
        <div class="center">Task Dashboard</div>
        <div class="right">Right Sidebar</div>
    </div>
    <div class="page">
        <div class="dashboardContents">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="manage">


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
        <div class="rightSidebar">Others</div>
    </div>
</body>
</html>