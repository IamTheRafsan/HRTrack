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

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="addEmployees.php" style="padding: 10px 20px; background: black; color: white; text-decoration: none; border-radius: 5px;">Add Employee</a>
        </div>


        <h2>Employee List</h2>
            <table class="table" border="1" style="width: 100%; text-align: left; ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Actions</th>
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
                                <td>

                                    <a href="editEmployee.php?id=<?php echo $row['id']; ?>&name=<?php echo urlencode($row['name']); ?>&email=<?php echo urlencode($row['email']); ?>&phone=<?php echo urlencode($row['phone']); ?>&designation=<?php echo urlencode($row['designation']); ?>&salary=<?php echo urlencode($row['salary']); ?>" 
                                       style="padding: 5px; background: blue; color: white; text-decoration: none; border-radius: 5px;">
                                       Edit
                                    </a>

                                    <a href="deleteEmployee.php?id=<?php echo $row['id']; ?>" 
                                        style="padding: 5px; background: red; color: white; text-decoration: none; border-radius: 5px;"
                                        onclick="return confirm('Are you sure you want to delete this employee?');">
                                        Delete
                                    </a>

                                </td>
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