<?php
require_once '../Control/auth.php';
checkLogin();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../Model/style.css">
</head>
<body>
    <div class="formContainer">
        <form action="../Control/sendLeaveApplication.php" method="POST">
            <h1>Apply For Leave</h1>


            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="inputField">
                <input type="text" placeholder="Subject" name="subject" required/>
            </div>
            <div class="inputField">
                <input type="text" placeholder="Reason" name="reason" required/>
            </div>
            <div class="inputField">
                <input type="datetime-local" placeholder="Leave From" name="leaveFrom" required/>
            </div>
            <div class="inputField">
                <input type="datetime-local" placeholder="Leave To" name="leaveTo" required/>
            </div>
            
            <div>
                <button type="submit">Apply</button>
            </div>
        </form>
    </div>
</body>
</html>
