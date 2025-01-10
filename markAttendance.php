<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "HR";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employees = $conn->query("SELECT id, name FROM employees");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    foreach ($_POST['attendance'] as $employee_id => $status) {
        $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $employee_id, $date, $status);
        $stmt->execute();
    }
    echo "Attendance marked successfully.";
}
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

        <h1>Mark Attendance</h1>
        <form method="POST" action="">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($employee = $employees->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td>
                            <select name="attendance[<?php echo $employee['id']; ?>]" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Leave">Leave</option>
                            </select>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button type="submit">Submit Attendance</button>
        </form>

        </div>
        <div class="rightSidebar">
            others
        </div>
    </div>
</body>
</html>

