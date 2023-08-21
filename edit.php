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

// Check if the "Update" button is clicked
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    // Update the record in the database using the provided data
    $sql = "UPDATE student_list SET first_name = '$fname', last_name = '$lname', gender = '$gender' WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    // Display a success alert
    echo '<div class="alert alert-success mt-3" role="alert">
            Student details updated successfully!
          </div>';
}

// Check if the "Delete" button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Delete the record from the database
    $deleteSql = "DELETE FROM student_list WHERE ID = '$id'";
    $con->query($deleteSql) or die($con->error);

    // Display a success alert
    echo '<div class="alert alert-success mt-3" role="alert">
            Student details deleted successfully!
          </div>';
}

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database using the provided ID
    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - Student Management System</title>
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

        .btn-primary,
        .btn-danger {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-success {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            background-color: #28a745;
            border: none;
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
        <h1 class="mb-4">Edit Student Details</h1>
        <div class="form-container">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo $row['first_name']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo $row['last_name']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="Male" <?php if ($row['gender'] === 'Male')
                            echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($row['gender'] === 'Female')
                            echo 'selected'; ?>>Female</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>

            <form action="" method="post" class="mt-3">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>

            <a href="index.php" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>