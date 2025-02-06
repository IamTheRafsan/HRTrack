<?php

include '../Control/databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'];
    $task_name = $_POST['task_name'];
    $assigned_employees = json_encode($_POST['assigned_employees']);
    $start_time = $_POST['start_time'];
    $deadline = $_POST['deadline'];
    $task_details = $_POST['task_details'];
    $progress = $_POST['progress'];

    if (empty($project_id) || empty($task_name) || empty($assigned_employees) || empty($start_time) || empty($deadline) || empty($task_details) || empty($progress)) {
        echo '<script>alert("Fields empty!");</script>';
    } else {

        $sql = "INSERT INTO tasks (project_id, task_name, assigned_employees, start_time, deadline, task_details, progress) 
                VALUES ('$project_id', '$task_name', '$assigned_employees', '$start_time', '$deadline', '$task_details', '$progress')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../View/viewTasks.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>