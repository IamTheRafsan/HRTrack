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
        include 'EmployeeSidebar.php';
        ?>
    

        </div>
        <div class="manage">

        <?php
        include 'databaseConnection.php';

        $LoggedInEmployeeId = '1';

        $query = "SELECT p.*, e.name FROM payroll p JOIN employees e ON p.employee_id = e.id WHERE p.employee_id = $LoggedInEmployeeId";
        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = intval($_GET['month']);
            $year = intval($_GET['year']);

            $query .= " WHERE MONTH(payment_date) = $month AND YEAR(payment_date) = $year";
        }

        $result = $conn->query($query);

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

        if ($result->num_rows > 0) {
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
        } else {
            echo "<tr><td colspan='6'>No records found for the selected month and year.</td></tr>";
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
