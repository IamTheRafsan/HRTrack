<?php
include 'databaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = intval($_POST['employee_id']);
    $basic_salary = floatval($_POST['basic_salary']);
    $allowances = floatval($_POST['allowances'] ?? 0);
    $deductions = floatval($_POST['deductions'] ?? 0);
    $payment_date = $conn->real_escape_string($_POST['payment_date']);
    $total_salary = $basic_salary + $allowances - $deductions;

    $sql = "INSERT INTO payroll (employee_id, basic_salary, allowances, deductions, total_salary, payment_date)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idddds", $employee_id, $basic_salary, $allowances, $deductions, $total_salary, $payment_date);

    if ($stmt->execute()) {
        header("Location: salary.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
