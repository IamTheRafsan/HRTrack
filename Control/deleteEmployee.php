<?php
require_once '../Control/auth.php';
checkLogin();
include '../Control/databaseConnection.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    
    $sql = "DELETE FROM employees WHERE id = $id";
    echo "<script>alert('Deleting Employee ID: $id');</script>";
    
    
    if (mysqli_query($conn, $sql)==TRUE) {
        echo '<script>alert("Employee ID: ' . $id . '");</script>';
        header("Location: View/employees.php");
        exit;
    } else {
        
        echo "Error deleting record: ";
    }
} else {
    echo "Invalid request. Employee ID is missing.";
}
?>
