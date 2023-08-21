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

    // Delete the record from the database using the provided ID
    $sql = "DELETE FROM student_list WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    // Redirect back to the index page after deleting the record
    header("Location: index.php");
} else {
    // If no ID parameter is provided, redirect back to the index page
    header("Location: index.php");
}
?>