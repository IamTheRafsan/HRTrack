<?php
include '../Control/databaseConnection.php';

$sql = "SELECT a.date, e.name, a.status
        FROM attendance a
        JOIN employees e ON a.employee_id = e.id
        ORDER BY a.date DESC";
$attendanceRecords = mysqli_query($conn, $sql);

$attendanceData = [];
if ($attendanceRecords->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($attendanceRecords)) {
        $attendanceData[] = $row;
    }
} else {
    $attendanceData = []; 
}

echo json_encode($attendanceData);
?>
