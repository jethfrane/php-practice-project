<?php
session_start();

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];

    $sql = "UPDATE student_list SET first_name = '$fname', last_name = '$lname' WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Student</h1>
    <br>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>First Name</label>
        <input type="text" name="firstname" value="<?php echo $row['first_name']; ?>">
        <label>Last Name</label>
        <input type="text" name="lastname" value="<?php echo $row['last_name']; ?>">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
