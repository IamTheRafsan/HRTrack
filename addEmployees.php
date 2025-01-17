<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "HR";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $designation = $conn->real_escape_string($_POST['designation']);
    $salary = $conn->real_escape_string($_POST['salary']);
    $hr = $conn->real_escape_string($_POST['hr']);
    $id = $conn->real_escape_string($_POST['id']);

    $sql = "INSERT INTO employees (id, name, email, phone, designation, salary, hr) 
            VALUES ('$id','$name', '$email', '$phone', '$designation', '$salary', '$hr')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="formContainer">
        <form action="" method="POST">
            <h1>Add Employee</h1>


            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="inputField">
                <input type="text" placeholder="Name" name="name" required />
            </div>
            <div class="inputField">
                <input type="email" placeholder="Email" name="email" required />
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
                <input type="text" placeholder="ID" name="" required />
            </div>
            
            <div>
                <button type="submit">Add Employee</button>
            </div>
        </form>
    </div>
</body>
</html>
