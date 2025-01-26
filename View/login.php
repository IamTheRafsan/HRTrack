<?php
include '../Control/loginController.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    loginValidation();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Model/style.css">
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