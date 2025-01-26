<?php
include '../Control/databaseConnection.php';
$id = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$designation = $_GET['designation'];
$salary = $_GET['salary'];



if($_SERVER["REQUEST_METHOD"]=='POST'){

    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];
    $newDesignation = $_POST['designation'];
    $newSalary = $_POST['salary'];


    $update_sql = "UPDATE employees SET name='$newName', email='$newEmail', phone='$newPhone', designation='$newDesignation', salary='$newSalary' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Employee updated successfully.";
        header("Location: employees.php");
        exit;
    } else {
        echo "Error updating employee: ";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../Model/style.css">
</head>
<body>
    <div class="formContainer">
        <form action="" method="POST">
            <h1>Edit Employee</h1>

            <div class="inputField">
                <input type="text" placeholder="Name" name="name" value="<?php echo $name ;?>" required />
            </div>
            <div class="inputField">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email ;?>" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="Phone" name="phone" value="<?php echo $phone ;?>" required />
            </div>
            <div class="inputField">
                <input type="text" placeholder="Designation" name="designation" value="<?php echo $designation ;?>" 
                required />
            </div>
            <div class="inputField">
                <input type="number" placeholder="Salary" name="salary" value="<?php echo $salary ;?>" required />
            </div>
             <div>
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</body>
</html>