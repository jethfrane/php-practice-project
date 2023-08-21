<?php
// Start the session to check user login status
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection function
include_once("connections/connection.php");

// Establish a database connection
$con = connection();

// Check if the "Update" button is clicked
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    // Update the record in the database using the provided data
    $sql = "UPDATE student_list SET first_name = '$fname', last_name = '$lname', gender = '$gender' WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    header("Location: index.php");
}

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database using the provided ID
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
    <title>Edit - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Edit Student Details</h1>
    <br>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>First Name</label><br>
        <input type="text" name="firstname" value="<?php echo $row['first_name']; ?>"><br><br>
        <label>Last Name</label><br>
        <input type="text" name="lastname" value="<?php echo $row['last_name']; ?>"><br><br>
        <label>Gender</label><br>
        <select name="gender">
            <option value="Male" <?php if ($row['gender'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($row['gender'] === 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <button type="submit" name="update">Update</button>
    </form>

    <!-- Back button -->
    <a href="index.php" style="display: block; text-align: left; margin-top: 10px;">Back</a>

</body>

</html>
