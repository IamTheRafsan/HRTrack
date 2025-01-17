<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left">
            
        </div>
        <div class="center">
            Hello, Mr. Rafsan
        </div>
        <div class="right">
            right sidebar
        </div>
    </div>
    <div class="page">
        <div class="dashboardContents">
            
        <?php
        include 'sidebar.php';
        ?>
    

        </div>
        <div class="manage">

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="payroll.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Pay Salary</a>
        </div>

        <?php
            include 'databaseConnection.php';

            $result = $conn->query("SELECT p.*, e.name FROM payroll p JOIN employees e ON p.employee_id = e.id");

            echo "<h1>Payroll Dashboard</h1>";
            echo "<table border='1'>
            <tr>
                <th>Employee Name</th>
                <th>Basic Salary</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Total Salary</th>
                <th>Payment Date</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['basic_salary']}</td>
                    <td>{$row['allowances']}</td>
                    <td>{$row['deductions']}</td>
                    <td>{$row['total_salary']}</td>
                    <td>{$row['payment_date']}</td>
                </tr>";
            }

            echo "</table>";
            $conn->close();
            ?>
            
        </div>
        <div class="rightSidebar">
            others
        </div>
    </div>
</body>
</html>
