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
    $sql = "SELECT * FROM student_list WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

// Process form submission for updating notes
if (isset($_POST['updateNotes'])) {
    $newNotes = $_POST['new_notes'];

    // Update the notes in the database using prepared statements
    $updateSql = "UPDATE student_list SET notes = ? WHERE ID = ?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param("si", $newNotes, $id); // "si" indicates a string and an integer
    $stmt->execute();
    $stmt->close();

    // Redirect back to the details page
    header("Location: details.php?id=$id");
    exit();
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
    <h1>Notes</h1>

    <form action="" method="post">
        <label for="new_notes">Write a note:</label><br>
        <textarea name="new_notes" id="new_notes" rows="10" cols="60"><?php echo $row['notes']; ?></textarea><br>
        <input type="submit" name="updateNotes" value="Update Notes">
    </form>
    <br>
    <a href="details.php?id=<?php echo $id; ?>">Back</a><br>
</body>

</html>
