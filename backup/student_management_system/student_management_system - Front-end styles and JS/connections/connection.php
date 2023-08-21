<?php
// Function to establish a database connection
function connection()
{
    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "12345";
    $database = "student_system";

    // Create a new MySQLi object to establish the connection
    $con = new mysqli($host, $username, $password, $database);

    // Check for connection errors
    if ($con->connect_error) {
        // Display the connection error if it occurs
        echo "Connection Error: " . $con->connect_error;
    } else {
        // If no error, return the connection object
        return $con;
    }
}
?>