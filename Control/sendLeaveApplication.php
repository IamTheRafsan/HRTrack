<?php
include '../Control/databaseConnection.php';

session_start();

$LoggedInEmployeeID = $_SESSION['userId'];
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = $_POST['subject'];
    $reason = $_POST['reason'];
    $leaveFrom = $_POST['leaveFrom'];
    $leaveTo = $_POST['leaveTo'];
    
    if (empty($subject) || empty($reason) || empty($leaveFrom) || empty($leaveTo)) {
        $error = "All fields are required.";
    } else {
        $sql = "INSERT INTO leave_requests (employee_id, subject, reason, leave_from, leave_to) 
                VALUES ($LoggedInEmployeeID, '$subject', '$reason', '$leaveFrom', '$leaveTo')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../View/EmployeeLeave.php");
            exit;
        } else {
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        }
    }
}