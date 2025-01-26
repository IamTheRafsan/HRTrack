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

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="payroll.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Pay Salary</a>
        </div>

            <form method="GET" action="" style="margin-bottom: 20px;">
                <label for="month">Month:</label>
                <select name="month" id="month" required>
                    <option value="">Select Month</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $monthName = date('F', mktime(0, 0, 0, $i, 1));
                        echo "<option value='$i'>$monthName</option>";
                    }
                    ?>
                </select>

                <label for="year">Year:</label>
                <select name="year" id="year" required>
                    <option value="">Select Year</option>
                    <?php
                    for ($year = 2020; $year <= date('Y'); $year++) {
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                </select>

                <button type="submit" style="padding: 5px 15px; background: blue; color: white; border: none; border-radius: 5px;">Filter</button>
            </form>

        <?php
        include '../Control/databaseConnection.php';

        $query = "SELECT p.*, e.name FROM payroll p JOIN employees e ON p.employee_id = e.id";

        if (isset($_GET['month']) && isset($_GET['year'])) {
            $month = intval($_GET['month']);
            $year = intval($_GET['year']);

            $query .= " WHERE MONTH(payment_date) = $month AND YEAR(payment_date) = $year";
        }

        $result = mysqli_query($conn, $query);

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
        </div>
    </div>
</body>
</html>
