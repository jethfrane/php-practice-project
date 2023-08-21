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

// Process form submission
if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $notes = $_POST['notes'];

    // Insert data into the database
    $sql = "INSERT INTO `student_list`(`first_name`, `last_name`, `gender`, `notes`) VALUES ('$fname','$lname','$gender','$notes')";
    $con->query($sql) or die($con->error);

    // Redirect back to the index page after adding data
    header("Location: index.php");
    exit(); // Stop further execution of the script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Add New Student</h1>
    <form action="" method="post">
        <?php if (isset($error_message)) { ?>
            <p style="color: red;">
                <?php echo $error_message; ?>
            </p>
        <?php } ?>
        <label for="firstname">First Name<span class="required-indicator">*</span></label><br>
        <input type="text" name="firstname" id="firstname" required><br><br>
        <label for="lastname">Last Name<span class="required-indicator">*</span></label><br>
        <input type="text" name="lastname" id="lastname" required><br><br>
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <label for="notes">Notes</label><br>
        <textarea type="text" name="notes" id="notes"></textarea><br>
        <br>
        <input type="submit" name="submit" value="Submit Form">
    </form>

    <!-- Back button -->
    <a href="index.php" style="display: block; text-align: left; margin-top: 10px;">Back</a>
</body>

</html>
