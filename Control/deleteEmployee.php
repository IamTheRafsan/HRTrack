<?php
include '../Control/databaseConnection.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employees WHERE id = $id";
    
    

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
