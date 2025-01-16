<?php
include 'databaseConnection.php';

$projects_result = $conn->query("SELECT project_id, project_name FROM projects");
$employees_result = $conn->query("SELECT id, name FROM employees");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = intval($_POST['project_id']);
    $task_name = $conn->real_escape_string($_POST['task_name']);
    $assigned_employees = json_encode($_POST['assigned_employees']);
    $start_time = $conn->real_escape_string($_POST['start_time']);
    $deadline = $conn->real_escape_string($_POST['deadline']);
    $task_details = $conn->real_escape_string($_POST['task_details']);
    $progress = $conn->real_escape_string($_POST['progress']);

    $sql = "INSERT INTO tasks (project_id, task_name, assigned_employees, start_time, deadline, task_details, progress) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $project_id, $task_name, $assigned_employees, $start_time, $deadline, $task_details, $progress);

    if ($stmt->execute()) {
        echo "Task created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="formContainer">
    <form action="createTask.php" method="POST">
        <h1>Create Task</h1>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div class="inputField">
            <label for="project_id">Select Project:</label>
            <select name="project_id" required>
                <option value="">Select Project</option>
                <?php if ($projects_result->num_rows > 0): ?>
                    <?php while ($project = $projects_result->fetch_assoc()): ?>
                        <option value="<?php echo $project['project_id']; ?>">
                            <?php echo htmlspecialchars($project['project_name']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">No projects available</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="inputField">
            <input type="text" placeholder="Task Name" name="task_name" required />
        </div>

        <div class="inputField">
            <label for="assigned_employees">Assign Employees:</label>
            <select name="assigned_employees[]" multiple required>
                <?php if ($employees_result->num_rows > 0): ?>
                    <?php while ($employee = $employees_result->fetch_assoc()): ?>
                        <option value="<?php echo $employee['name']; ?>">
                            <?php echo htmlspecialchars($employee['name']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php else: ?>
                    <option value="">No employees available</option>
                <?php endif; ?>
            </select>
            <small>Hold Ctrl to select multiple employees</small>
        </div>

        <div class="inputField">
        <label for="assigned_employees">Start Date:</label>
            <input type="datetime-local" placeholder="Start Time" name="start_time" required />
        </div>

        <div class="inputField">
        <label for="assigned_employees">Deadline:</label>
            <input type="datetime-local" placeholder="Deadline" name="deadline" required />
        </div>

        <div class="inputField">
            <textarea name="task_details" rows="4" placeholder="Task details..." required></textarea>
        </div>

        <div class="inputField">
            <label for="progress">Progress:</label>
            <select name="progress" required>
                <option value="Assigned">Assigned</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Delivered">Delivered</option>
            </select>
        </div>

        <div>
            <button type="submit">Create Task</button>
        </div>
    </form>
</div>

</body>
</html>
