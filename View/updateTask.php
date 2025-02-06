<?php
require_once '../Control/auth.php';
checkLogin();

include '../Control/databaseConnection.php';

$task_id = isset($_GET['task_id']) ? intval($_GET['task_id']) : 0;

if ($task_id === 0) {
    die("Invalid Task ID.");
}

$sql = "SELECT * FROM tasks WHERE task_id = $task_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    die("Task not found.");
}

$task = mysqli_fetch_array($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $deadline = $_POST['deadline'];
    $task_details = $_POST['task_details'];
    $progress = $_POST['progress'];

    $update_sql = "
        UPDATE tasks
        SET deadline = '$deadline', task_details = '$task_details', progress = '$progress'
        WHERE task_id = $task_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Task updated successfully!";
        header("Location: ../View/viewTasks.php");
        exit();
    } else {
        echo "Error updating task: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link rel='stylesheet' href='style.css'></style>
</head>
<body>
    <div class="formContainer">
    <h1>Update Task</h1>

    <form method="POST">
        <label>Task Name: <?php echo htmlspecialchars($task['task_name']); ?></label>

        <label>Deadline:</label>
        <input type="datetime-local" name="deadline" value="<?php echo htmlspecialchars($task['deadline']); ?>" required><br>

        <label>Task Details:</label>
        <textarea name="task_details" required><?php echo htmlspecialchars($task['task_details']); ?></textarea><br>

        <div class="inputField">
            <label for="progress">Progress:</label>
            <select name="progress" required>
                <option value="Assigned" <?php echo $task['progress'] === 'Assigned' ? 'selected' : ''; ?>>Assigned</option>
                <option value="In Progress" <?php echo $task['progress'] === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                <option value="Completed" <?php echo $task['progress'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="Delivered" <?php echo $task['progress'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
            </select>
        </div>

        <button type="submit">Update Task</button>
    </form>
    </div>
</body>
</html>
