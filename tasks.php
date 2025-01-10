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

        <form action="" method="POST">
            <h1>Create Task</h1>
            
            <!-- Project Selection -->
            <div class="inputField">
                <label for="project_id">Select Project</label>
                <select name="project_id" required>
                    <option value="">Select Project</option>
                    <?php while($project = $projects_result->fetch_assoc()): ?>
                        <option value="<?php echo $project['project_id']; ?>">
                            <?php echo $project['project_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Task Name -->
            <div class="inputField">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" placeholder="Task Name" required />
            </div>

            <!-- Assign Employees -->
            <div class="inputField">
                <label for="assigned_employees">Assign Employees</label>
                <select name="assigned_employees[]" multiple required>
                    <?php while($employee = $employees_result->fetch_assoc()): ?>
                        <option value="<?php echo $employee['id']; ?>">
                            <?php echo $employee['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <small>Hold Ctrl to select multiple employees</small>
            </div>

            <!-- Start Time -->
            <div class="inputField">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" required />
            </div>

            <!-- Deadline -->
            <div class="inputField">
                <label for="deadline">Deadline</label>
                <input type="datetime-local" name="deadline" required />
            </div>

            <!-- Task Details -->
            <div class="inputField">
                <label for="task_details">Task Details</label>
                <textarea name="task_details" rows="4" placeholder="Task details..." required></textarea>
            </div>

            <!-- Progress -->
            <div class="inputField">
                <label for="progress">Progress (%)</label>
                <input type="number" name="progress" min="0" max="100" value="0" required />
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit">Create Task</button>
            </div>
        </form>

        

        </div>
        <div class="rightSidebar">
            others
        </div>
    </div>
</body>
</html>