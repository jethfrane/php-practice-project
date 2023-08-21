<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit();
}

include_once("connections/connection.php");

$con = connection();
$itemsPerPage = isset($_GET['itemsPerPage']) ? $_GET['itemsPerPage'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$totalRecords = $con->query("SELECT COUNT(*) AS total FROM student_list")->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $itemsPerPage);
$offset = ($page - 1) * $itemsPerPage;

$allStudents = $con->query("SELECT * FROM student_list")->fetch_all(MYSQLI_ASSOC);
$sql = "SELECT * FROM student_list ORDER BY ID DESC LIMIT $offset, $itemsPerPage";
$students = $con->query($sql) or die($con->$connection->error);
$row = $students->fetch_assoc();
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
            <?php echo "Welcome " . $_SESSION['UserLogin'] . " | <a href='logout.php'>Logout</a>"; ?>
        </div>
        <br>
        <!-- Search Box -->
        <form id="search-form">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" class="form-control"
                        placeholder="Search by first or last name" value="<?php echo $searchTerm; ?>">
                </div>
                <div class="col-md-4 mb-3"></div>
                <div class="col-md-4 text-md-end mb-3">
                    <label for="itemsPerPage" class="me-2">Items per page:</label>
                    <select id="itemsPerPage" name="itemsPerPage" onchange="changeItemsPerPage(this)"
                        class="form-select">
                        <option value="10" <?php if ($itemsPerPage == 10)
                            echo 'selected'; ?>>10</option>
                        <option value="20" <?php if ($itemsPerPage == 20)
                            echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($itemsPerPage == 50)
                            echo 'selected'; ?>>50</option>
                        <option value="100" <?php if ($itemsPerPage == 100)
                            echo 'selected'; ?>>100</option>
                    </select>
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
                <?php while ($row = $students->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <a href="details.php?id=<?php echo $row['id']; ?>">View</a>
                        </td>
                        <td>
                            <?php echo $row['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['last_name']; ?>
                        </td>
                        <?php if ($_SESSION['Access'] === 'administrator') { ?>
                            <td class="actions-cell" style="display: none;">
                                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                <a href="delete.php?id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-3">
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <button class="btn btn-primary" onclick="location.href='add.php'">Add New</button>
                    <button id="edit-button" class="btn btn-secondary">Edit</button>
                    <a href="export_csv.php" class="btn btn-success">Download as .csv</a>
                <?php } ?>
            </div>
            <br><br>
            <div class="col-md-12 text-md-end">
                <div class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <a href="?page=<?php echo $i; ?>&itemsPerPage=<?php echo $itemsPerPage; ?>" class="pagination-link <?php if ($page == $i)
                                  echo 'active'; ?>"><?php echo $i; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>
