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

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database using the provided ID
    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql) or die($con->error);
    $row = $result->fetch_assoc();
}

// Process form submission for updating notes
if (isset($_POST['updateNotes'])) {
    $newNotes = $_POST['new_notes'];

    // Update the notes in the database
    $updateSql = "UPDATE student_list SET notes = '$newNotes' WHERE ID = '$id'";
    $con->query($updateSql) or die($con->error);

    // Refresh the page to show the updated notes
    header("Location: details.php?id=$id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Student Details</h1>
    <p><strong>First Name:</strong>
        <?php echo $row['first_name']; ?>
    </p>
    <p><strong>Last Name:</strong>
        <?php echo $row['last_name']; ?>
    </p>
    <p><strong>Gender:</strong>
        <?php echo $row['gender']; ?>
    </p>
    <p><strong>Notes:</strong>
        <?php echo $row['notes']; ?>
    </p>

    <!-- Only show the "Edit Notes" button to administrators -->
    <?php if ($_SESSION['Access'] === 'administrator') { ?>
        <a href="update_notes.php?id=<?php echo $id; ?>">Edit Notes</a>
    <?php } ?><br><br>

    <a href="index.php">Back</a>

</body>

</html>