<?php
include '../Control/databaseConnection.php';

$sql = "SELECT id, name, email, phone, designation, salary FROM employees";
$result = mysqli_query($conn, $sql);
$employees = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_row($result)) {
        $employees[] = $row; 
    }
}
?>
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
        include '../View/menu.php';
        ?>
    

        </div>
        <div class="mainContent">

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="addEmployees.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Add Employee</a>
        </div>


        <h2>Employee List</h2>
            <table class="table" border="1" style="width: 100%; text-align: left; ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($employees)) {
                        foreach ($employees as $employee) {
                            echo "<tr>";
                            echo "<td>{$employee[0]}</td>";
                            echo "<td>{$employee[1]}</td>";
                            echo "<td>{$employee[2]}</td>";
                            echo "<td>{$employee[3]}</td>";
                            echo "<td>{$employee[4]}</td>";
                            echo "<td>{$employee[5]}</td>";
                            echo "<td>
                                    <a href='editEmployee.php?id={$employee[0]}&name=" . urlencode($employee[1]) . "&email=" . urlencode($employee[2]) . "&phone=" . urlencode($employee[3]) . "&designation=" . urlencode($employee[4]) . "&salary=" . urlencode($employee[5]) . "' 
                                    style='padding: 5px; background: blue; color: white; text-decoration: none; border-radius: 5px;'>
                                    Edit
                                    </a>
                                    <a href='../Control/deleteEmployee.php?id={$employee[0]}'
                                    style='padding: 5px; background: red; color: white; text-decoration: none; border-radius: 5px;'
                                    onclick=\"return confirm('Are you sure you want to delete this employee?');\">
                                    Delete
                                    </a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>
                                <td colspan='7'>No employees found.</td>
                            </tr>";
                    }
                    ?>

                
                </tbody>
            </table>
            
        </div>
        <div class="rightSidebar">
        </div>
    </div>
</body>
</html>