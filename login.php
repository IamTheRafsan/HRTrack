<?php

session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "HR";

$conn = new mysqli($host, $username, $password, $dbname);

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = $conn->real_escape_string($email); 
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows === 1)
    {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];

        header("Location: dashboard.php");
        exit;
    }
    else{ $error = "Invalid username or password."; }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="formContainer">
        <form action="" method="POST">
            <h1>Sign In</h1>
        <div class = "inputField">
            <input type="text" placeholder="email" name="email"/>
        </div>
        <div class = "inputField">
            <input type="password" placeholder="Password" name="password"/>
        </div>
        <div>
            <button>Sign In</button>
        </div>
        
        </form>
    </div>
</body>
</html>