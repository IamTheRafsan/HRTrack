<?php
require_once '../Control/auth.php';
checkLogin();

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
        <div class="left"></div>
        <div class="center">
            <?php
            if (isset($_SESSION['userName'])) {
                echo "Hello, " . $_SESSION['userName'] . "!";
            } else {
                echo "Hello, Guest!";
            }            
            ?>
        </div>
        <div class="right"></div>
    </div>
    <div class="page">
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
        <div class="mainContent">
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


            
        </div>
        <div class="rightSidebar"></div>
    </div>

    <script src="../Control/getAttendance.js"></script>

    <script>
        window.onload = function() {
            fetchAttendance();
        };
    </script>
</body>
</html>