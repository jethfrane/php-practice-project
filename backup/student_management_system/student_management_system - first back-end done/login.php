<?php
// Start the session to manage user authentication
session_start();

// Include the database connection
include_once("connections/connection.php");
$con = connection();

// Check if the login form has been submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user details
    $sql = "SELECT * FROM student_users WHERE username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    // Check if user exists
    if ($total > 0) {
        // Store user details in session variables
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];

        // Redirect to the main page after successful login
        header("Location: index.php");
    } else {
        // Redirect to the login page on failed login
        header("Location: login.php");
    }
}

// Process form submission for creating a new account
if (isset($_POST['createAccount'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    // Insert new user account into the database with "user" access
    $insertSql = "INSERT INTO student_users (username, password, access) VALUES ('$newUsername', '$newPassword', 'user')";
    $con->query($insertSql) or die($con->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Student Management System</h1>
    <h3>Sign in</h3>
    <br>
    <form action="" method="post">
        <label>Username</label><br>
        <input type="text" name="username" id="username"><br><br>
        <label>Password</label><br>
        <input type="password" name="password" id="password"><br><br>
        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>
