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

// Check if the "Add" button is clicked
if (isset($_POST['add'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    // Insert the new record into the database
    $sql = "INSERT INTO student_list (first_name, last_name, gender) VALUES ('$fname', '$lname', '$gender')";
    $con->query($sql) or die($con->error);

    // Display a success alert
    echo '<div class="alert alert-success mt-3" role="alert">
            Student added successfully!
          </div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Integrate your CSS styles here */
        /* For example, you can add styles for form elements */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-label {
            font-weight: bold;
        }
        
        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
        }
        
        .btn-primary {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn-secondary {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #6c757d;
            color: #fff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add New Student</h1>
        <div class="form-container">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Add Student</button>
            </form>

            <a href="index.php" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
