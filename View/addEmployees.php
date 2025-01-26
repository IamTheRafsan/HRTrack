<?php
session_start();
include '../Control/databaseConnection.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    $hr = $_POST['hr'];
    $id = $_POST['id'];
    

    if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($designation) || empty($salary) || empty($hr) || empty($id)) {
        echo '<script>alert("All fields are required!");</script>';
    } else {
        $sql = "INSERT INTO employees (id, name, email, password, phone, designation, salary, hr) 
                VALUES ('$id', '$name', '$email' , '$password' , '$phone', '$designation', '$salary', '$hr')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Employee added successfully!");</script>';
            header("Location: employees.php");
            exit;
        } else {
            echo '<script>alert("Error adding employee: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../Model/style.css">
    <script src="../Control/employeeValidation.js"></script>
</head>
<body>
    <div class="formContainer">
        <form name="employeeForm" action="" method="POST" onsubmit="return validateEmployeeForm()">
            <h1>Add Employee</h1>

            <div class="inputField">
                <input type="text" placeholder="Name" name="name" required />
            </div>
            <div class="inputField">
                <input type="email" placeholder="Email" name="email" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="Password" name="password" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="Phone" name="phone" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="Designation" name="designation" required />
            </div>
            <div class="inputField">
                <input type="number" placeholder="Salary" name="salary" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="HR Name" name="hr" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="ID" name="id" required />
            </div>
            
            <div>
                <button type="submit">Add Employee</button>
            </div>
        </form>
    </div>
</body>
</html>
