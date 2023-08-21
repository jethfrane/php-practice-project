<?php
// Start the session to manage user authentication
session_start();

// Unset the session variables for user login and access
unset($_SESSION['UserLogin']);
unset($_SESSION['Access']);

// Redirect the user to the login page after logout
header("Location: login.php");
?>