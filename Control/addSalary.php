<?php
include '../Control/databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = intval($_POST['employee_id']);
    $basic_salary = floatval($_POST['basic_salary']);
    $allowances = floatval($_POST['allowances']);
    $deductions = floatval($_POST['deductions']);
    $payment_date = mysqli_real_escape_string($conn, $_POST['payment_date']);
    $total_salary = $basic_salary + $allowances - $deductions;
    echo '<script>alert("Fields empty!");</script>';

    $sql = "INSERT INTO payroll (employee_id, basic_salary, allowances, deductions, total_salary, payment_date)
            VALUES ($employee_id, $basic_salary, $allowances, $deductions, $total_salary, '$payment_date')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../View/salary.php");
        exit;
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
