<?php
include '../Control/databaseConnection.php';
$sql = "SELECT * FROM employees";
$employees = mysqli_query($conn, $sql);

if (!$employees) {
    die("Error fetching employees: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Model/dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left">
            
        </div>
        <div class="center">
        </div>
        <div class="right">
        </div>
    </div>
    <div class="page">
        <div class="menu">
            
        <?php
        include 'menu.php';
        ?>
    

        </div>
        <div class="mainContent">

        <h1>Mark Attendance</h1>
        <form method="POST" action="">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($employee = mysqli_fetch_array($employees)) {
                        echo "<tr>";
                        echo "<td>" . $employee['id'] . "</td>";
                        echo "<td>" . $employee['name'] . "</td>";
                        echo "<td>";
                        echo "<select name=\"attendance[" . $employee['id'] . "]\" required>";
                        echo "<option value=\"Present\">Present</option>";
                        echo "<option value=\"Absent\">Absent</option>";
                        echo "<option value=\"Leave\">Leave</option>";
                        echo "</select>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <button type="submit">Submit Attendance</button>
        </form>

        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>

