<?php

function loginValidation(){

session_start();


if($_SERVER["REQUEST_METHOD"] === "POST")
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        include '../Control/databaseConnection.php';
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $email = $conn->real_escape_string($email); 
        $password = $conn->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        

        if($count>=1)
        {
            $row = $result->fetch_row();
            $user = [
                'id' => $row[0],
                'name' => $row[1],
                'email' => $row[2],
                'role' => $row[4],
            ];
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userName'] = $user['name'];
            $_SESSION['userEmail'] = $user['email'];
            $_SESSION['userRole'] = $user['role'];
            $_SESSION['loggedin'] = true;            

            header("Location: dashboard.php");
            exit;
        }
        else{ 
            $sqlEmployee = "SELECT * FROM employees WHERE email='$email' AND password='$password'";
            $resultEmployee = mysqli_query($conn, $sqlEmployee);
            $countEmployee = mysqli_num_rows($resultEmployee);
            
            if($countEmployee>=1)
            {
                $row = $resultEmployee->fetch_row();
                $user = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[4],
                    'designation' => $row[5],
                    'salary' => $row[6],
                    'hr' => $row[7],
                ];
                $_SESSION['userId'] = $user['id'];
                $_SESSION['userName'] = $user['name'];
                $_SESSION['userEmail'] = $user['email'];
                $_SESSION['userPhone'] = $user['phone'];
                $_SESSION['userDesignation'] = $user['designation'];
                $_SESSION['userSalary'] = $user['salary'];
                $_SESSION['userHr'] = $user['hr'];
                $_SESSION['loggedin'] = true;

                header("Location: EmployeeAttendance.php");
                exit;
            }
            else{
                echo '<script>alert("Email or Password does not match!")</script>';     
            }

        }
            
    }else
    { 
        echo '<script>alert("Empty Fields!")</script>';
    }
}else
{ 
    echo '<script>alert("Response Error!")</script>';
}


}



?>