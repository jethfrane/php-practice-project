<?php
session_start(); // Start the session

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM student_list ORDER BY ID DESC";
$students = $con->query($sql) or die($con->$connection->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .header-links {
            display: flex;
            align-items: center;
        }
        .header-links a {
            margin-left: 10px;
        }
        .header-links .add-new-link {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <h1>Student Management System</h1>
    <br><br>
    <div class="header-links">
        <?php
        if (isset($_SESSION['UserLogin'])) {
            echo "Welcome " . $_SESSION['UserLogin'] . " | <a href='logout.php'>Logout</a>";
        } else {
            echo "Welcome Guest | <a href='login.php'>Login</a>";
        }
        ?>
        <?php
        if (isset($_SESSION['UserLogin'])) {
            echo "<a class='add-new-link' href='add.php'>Add New</a>";
        }
        ?>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            <?php do { ?>
                <tr>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                </tr>
            <?php } while ($row = $students->fetch_assoc()) ?>
        </tbody>
    </table>
</body>
</html>