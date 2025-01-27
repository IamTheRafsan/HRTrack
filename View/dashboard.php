<?php
require_once '../Control/auth.php';
checkLogin();

include '../Control/databaseConnection.php';
session_start();

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
        include '../View/menu.php';
        ?>
    

        </div>
        <div class="mainContent">
        <?php

            $sql = "SELECT id, name, email, phone, designation, salary FROM employees";
            $result = mysqli_query($conn, $sql);
            
            echo '<h2>Employee List</h2>';
            echo '<table class="table" border="1" style="width: 100%; text-align: left;">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Phone</th>';
            echo '<th>Designation</th>';
            echo '<th>Salary</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['designation'] . '</td>';
                    echo '<td>' . $row['salary'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="6">No employees found.</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        ?>
            
        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>