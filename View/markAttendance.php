<?php
require_once '../Control/auth.php';
checkLogin();

include '../Control/databaseConnection.php';
$sql = "SELECT * FROM employees";
$employees = mysqli_query($conn, $sql);

if (!$employees) {
    die("Error fetching employees: " . mysqli_error($conn));
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
            <?php
            if (isset($_SESSION['userName'])) {
                echo "Hello, " . $_SESSION['userName'] . "!";
            } else {
                echo "Hello, Guest!";
            }            
            ?>
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
        <form method="POST" action="../Control/attendanceController.php">
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




        <h1>Attendance Records</h1>
            <table id="attendanceTable" border="1" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>


            <script src="../Control/getAttendance.js"></script>

    <script>
        window.onload = function() {
            fetchAttendance();
        };
    </script>




        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>

