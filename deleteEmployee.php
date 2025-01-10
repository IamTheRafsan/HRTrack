<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "HR";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM employees WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: employees.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request. Employee ID is missing.";
}

$conn->close();
?>
