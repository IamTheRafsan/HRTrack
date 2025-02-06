<?php
require_once '../Control/auth.php';
checkLogin();
include '../Control/databaseConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    foreach ($_POST['attendance'] as $employee_id => $status) {
        $employee_id = intval($employee_id); 
        $status = mysqli_real_escape_string($conn, $status);

        $query = "INSERT INTO attendance (employee_id, date, status) VALUES ($employee_id, '$date', '$status')";

        if (!mysqli_query($conn, $query)) {
            echo "Error marking attendance for Employee ID $employee_id: " . mysqli_error($conn);
        }
    }

    echo '<script>alert("Attendence marted successfully!");</script>';
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
    
}

?>