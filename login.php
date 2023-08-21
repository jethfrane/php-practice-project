<?php
session_start();
include_once("connections/connection.php");
$con = connection();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM student_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];
        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php");
        exit;
    }
}

if (isset($_POST['createAccount'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    $insertSql = "INSERT INTO student_users (username, password, access) VALUES (?, ?, 'user')";
    $stmt = $con->prepare($insertSql);
    $stmt->bind_param("ss", $newUsername, $newPassword);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Management System</h1>
    </div>
    <div class="container">
        <div class="col-md-6">
            <h3 class="mt-4">Sign in</h3>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="button btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
