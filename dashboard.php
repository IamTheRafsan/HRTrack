<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "HR";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name, email, phone, designation, salary FROM employees";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="top">
        <div class="left">
            
        </div>
        <div class="center">
            Hello, Mr. Rafsan
        </div>
        <div class="right">
            right sidebar
        </div>
    </div>
    <div class="page">
        <div class="dashboardContents">
            
        <?php
        include 'sidebar.php';
        ?>
    

        </div>
        <div class="manage">
        <h2>Employee List</h2>
            <table class="table" border="1" style="width: 100%; text-align: left;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td><?php echo $row['salary']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No employees found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
        </div>
        <div class="rightSidebar">
            others
        </div>
    </div>
</body>
</html>