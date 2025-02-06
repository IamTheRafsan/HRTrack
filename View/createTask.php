<?php
require_once '../Control/auth.php';
checkLogin();
include '../Control/databaseConnection.php';

$projects_result = mysqli_query($conn, "SELECT project_id, project_name FROM projects");
$employees_result = mysqli_query($conn, "SELECT name FROM employees");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <br>
    <title style="padding: 10px;">Create Task</title>
    <link rel="stylesheet" href="../Model/style.css">
</head>
<body>
<div class="formContainer">
    <form action="../Control/taskController.php" method="POST">
        <h1>Create Task</h1>

        <div class="inputField">
            <label for="project_id">Select Project:</label>
            <select name="project_id" required>
                <option value="">Select Project</option>
                <?php
                if ($projects_result->num_rows > 0) {
                    while ($project = mysqli_fetch_array($projects_result)) {
                        echo '<option value="' . $project['project_id'] . '">' . htmlspecialchars($project['project_name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No projects available</option>';
                }
                ?>
            </select>
        </div>



        <div class="inputField">
            <input type="text" placeholder="Task Name" name="task_name" required />
        </div>

        <div class="inputField">
            <label for="assigned_employees">Assign Employees:</label>
            <select name="assigned_employees[]" multiple required>
                <?php
                if ($employees_result->num_rows > 0) {
                    while ($employee = mysqli_fetch_array($employees_result)) {
                        echo '<option value="' . $employee['name'] . '">' . htmlspecialchars($employee['name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No employees available</option>';
                }
                ?>
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
