<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit();
}

include_once("connections/connection.php");

$con = connection();

// Retrieve all students from the database
$allStudents = $con->query("SELECT * FROM student_list")->fetch_all(MYSQLI_ASSOC);

$searchTerm = "";

if (isset($_GET['search'])) {
    $searchTerm = strtolower($_GET['search']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Management System</h1>
    </div>
    <div class="container">
        <div class="text-left header-link">
            <?php echo "Welcome " . $_SESSION['UserLogin'] . " | "; ?>
            <button class="btn btn-danger btn-sm" onclick="location.href='logout.php'">Logout</button>
        </div>
        <br>
        <!-- Search Box -->
        <form id="search-form">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="First or Last name"
                        value="<?php echo $searchTerm; ?>">
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th></th> <!-- Empty th to give space to view button -->
                    <th>First Name</th>
                    <th>Last Name</th>
                    <?php if ($_SESSION['Access'] === 'administrator') { ?>
                        <th id="action-header" style="display: none;">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="search-results">
                <?php foreach ($allStudents as $student) { ?>
                    <tr>
                        <td>
                            <a href="details.php?id=<?php echo $student['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                        </td>
                        <td>
                            <?php echo $student['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $student['last_name']; ?>
                        </td>
                        <?php if ($_SESSION['Access'] === 'administrator') { ?>
                            <td class="actions-cell" style="display: none;">
                                <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-secondary">Edit</a>
                                <a href="delete.php?id=<?php echo $student['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?')"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-3">
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <button class="add-new-button btn btn-primary mb-2" onclick="location.href='add.php'">Add New</button>
                    <button id="edit-button" class="btn btn-secondary mb-2">Edit</button>
                    <a href="export_csv.php" class="btn btn-success mb-2">Download as .csv</a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>