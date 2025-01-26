<?php
include '../Control/databaseConnection.php';

$LoggedInEmployeeID = 1;
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = $_POST['subject'];
    $reason = $_POST['reason'];
    $leaveFrom = $_POST['leaveFrom'];
    $leaveTo = $_POST['leaveTo'];
    
    if (empty($subject) || empty($reason) || empty($leaveFrom) || empty($leaveTo)) {
        $error = "All fields are required.";
    } else {
        $sql = "INSERT INTO leave_requests (employee_id, subject, reason, leave_from, leave_to) 
                VALUES ($LoggedInEmployeeID, '$subject', '$reason', '$leaveFrom', '$leaveTo')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: EmployeeLeave.php");
            exit;
        } else {
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
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
</head>
<body>
    <div class="formContainer">
        <form action="" method="POST">
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
