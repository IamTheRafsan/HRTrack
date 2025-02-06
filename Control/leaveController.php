<?php
require_once '../Control/auth.php';
checkLogin();
include '../Control/databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$leave_id = intval($_POST['leave_id']);
$status = $_POST['status'];


if (!in_array($status, ['Approved', 'Rejected'])) {
    echo "Invalid status.";
    exit;
}


$sql = "UPDATE leave_requests SET status = '$status' WHERE leave_id = $leave_id";



if (mysqli_query($conn, $sql)) {
    header("Location: ../View/leave.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
}

?>