<?php
function add_employee(){
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
}
?>