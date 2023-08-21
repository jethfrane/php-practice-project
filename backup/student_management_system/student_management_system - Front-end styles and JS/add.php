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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Student</h1>
        <form action="" method="post">
            <?php if (isset($error_message)) { ?>
                <p class="text-danger">
                    <?php echo $error_message; ?>
                </p>
            <?php } ?>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name<span class="required-indicator">*</span></label>
                <input type="text" class="form-control" name="firstname" id="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name<span class="required-indicator">*</span></label>
                <input type="text" class="form-control" name="lastname" id="lastname" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" name="notes" id="notes"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit Form</button>
        </form>

        <!-- Back button -->
        <a href="index.php" class="mt-3 btn btn-secondary">Back</a>
    </div>
</body>

</html>
