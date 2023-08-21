<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit();
}

include_once("connections/connection.php");

$con = connection();

// Retrieve all students from the database in ascending order by first name
$allStudents = $con->query("SELECT * FROM student_list ORDER BY first_name ASC")->fetch_all(MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Your custom styles if needed -->
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .header-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
        }

        .header-link button {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .action-buttons {
            margin-top: 20px;
        }

        .action-buttons button {
            margin-right: 10px;
        }

        .action-buttons a {
            margin-right: 10px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-secondary,
        .btn-danger,
        .btn-success {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.sortable').on('click', function () {
                const sortBy = $(this).data('sort');
                const sortOrder = $(this).hasClass('asc') ? 'desc' : 'asc';
                
                $('.sortable').removeClass('asc desc');
                $(this).addClass(sortOrder);

                const rows = $('#search-results tr').get();
                rows.sort(function (a, b) {
                    const aValue = $(a).find('td[data-sort="' + sortBy + '"]').text().toLowerCase();
                    const bValue = $(b).find('td[data-sort="' + sortBy + '"]').text().toLowerCase();
                    return aValue.localeCompare(bValue);
                });

                if (sortOrder === 'desc') {
                    rows.reverse();
                }

                $('#search-results').empty();
                $.each(rows, function (index, row) {
                    $('#search-results').append(row);
                });
            });
        });
    </script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Management System</h1>
    </div>
    <br>
    <div class="container">
        <div class="header-link">
            <div>
                Welcome <?php echo $_SESSION['UserLogin']; ?>
            </div>
            <div>
                <button class="btn btn-danger btn-sm" onclick="location.href='logout.php'">Logout</button>
            </div>
        </div>
        <br>
        <form id="search-form" method="get">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" id="search" name="search" class="form-control"
                        placeholder="First or Last name" value="<?php echo $searchTerm; ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th class="sortable asc" data-sort="first_name">First Name</th>
                    <th class="sortable" data-sort="last_name">Last Name</th>
                    <?php if ($_SESSION['Access'] === 'administrator') { ?>
                        <th class="action-header">Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="search-results">
                <?php foreach ($allStudents as $student) {
                    // Check if the search term matches the first name or last name
                    $firstNameMatch = strpos(strtolower($student['first_name']), $searchTerm) !== false;
                    $lastNameMatch = strpos(strtolower($student['last_name']), $searchTerm) !== false;
                    
                    if ($firstNameMatch || $lastNameMatch) { // Display matching students
                ?>
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
                            <td class="actions-cell">
                                <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $student['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?')"
                                    class="btn btn-outline-danger btn-sm">Delete</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php 
                    }
                } ?>
            </tbody>
        </table>
        <div class="row action-buttons">
            <div class="col-lg-3">
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary btn-sm" onclick="location.href='add.php'">Add New</button>
                        <a href="export_csv.php" class="btn btn-success btn-sm">Download as .csv</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br><br><br>
    </div>
    <script src="js/script.js"></script>
</body>

</html>
