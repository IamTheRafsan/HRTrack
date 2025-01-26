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
        include 'EmployeeMenu.php';
        ?>
    

        </div>
        <div class="mainContent">

        <?php
        include '../Control/databaseConnection.php';

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
            <th>Employee ID</th>
            <th>Basic Salary</th>
            <th>Allowances</th>
            <th>Deductions</th>
            <th>Total Salary</th>
            <th>Payment Date</th>
        </tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_row()) {
                echo "<tr>
                    <td>{$row[1]}</td> 
                    <td>{$row[2]}</td> 
                    <td>{$row[3]}</td> 
                    <td>{$row[4]}</td> 
                    <td>{$row[5]}</td> 
                    <td>{$row[6]}</td>
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
        </div>
    </div>
</body>
</html>
