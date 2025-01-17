<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management</title>

    <link rel='stylesheet' href="style.css"/>
</head>
<body>
    
    <form class="formContainer" action="addSalary.php" method="POST">
        <h1>Payroll Management</h1>

        <div class="inputField">
            <label for="employee_id">Select Employee:</label>
            <select name="employee_id" required>
                <?php
                include 'databaseConnection.php';
                $result = $conn->query("SELECT id, name FROM employees");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="inputField">
            <label for="basic_salary">Basic Salary:</label>
            <input type="number" name="basic_salary" step="0.01" required>
        </div>
        <div class="inputField">
            <label for="allowances">Allowances:</label>
            <input type="number" name="allowances" step="0.01">
        </div>
        <div class="inputField">
            <label for="deductions">Deductions:</label>
            <input type="number" name="deductions" step="0.01">
        </div>
        <div class="inputField">
            <label for="payment_date">Payment Date:</label>
            <input type="date" name="payment_date" required>
        </div>
        <button type="submit">Add Payroll</button>
    </form>
</body>
</html>
