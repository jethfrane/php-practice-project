<?php
include_once("connections/connection.php");

$con = connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql) or die($con->error);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .edit-link {
            display: <?php echo isset($_SESSION['UserLogin']) ? 'inline' : 'none'; ?>;
        }
    </style>
</head>
<body>
    <h1>Student Details</h1>
    <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
    <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
    <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
    <!-- You can add more fields here -->

    <?php if (isset($_SESSION['UserLogin'])) { ?>
        <div class="edit-link">
            <a href="edit.php?id=<?php echo $row['ID']; ?>">Edit Details</a>
        </div>
    <?php } ?>

    <br>
    <a href="index.php">Back</a>
</body>
</html>