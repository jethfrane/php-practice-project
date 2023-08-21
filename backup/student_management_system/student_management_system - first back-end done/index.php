<?php
// Start the session to manage user authentication
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit(); // Stop further execution of the script
}

// Include the database connection
include_once("connections/connection.php");

// Establish a database connection
$con = connection();

// Set default items per page and page number
$itemsPerPage = isset($_GET['itemsPerPage']) ? $_GET['itemsPerPage'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Fetch total number of records
$totalRecords = $con->query("SELECT COUNT(*) AS total FROM student_list")->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $itemsPerPage);

// Calculate starting record for current page
$offset = ($page - 1) * $itemsPerPage;

// Fetch all student data for search
$allStudents = $con->query("SELECT * FROM student_list")->fetch_all(MYSQLI_ASSOC);

// Fetch student data from the database with pagination
$sql = "SELECT * FROM student_list ORDER BY ID DESC LIMIT $offset, $itemsPerPage";
$students = $con->query($sql) or die($con->$connection->error);
$row = $students->fetch_assoc();
$searchTerm = ""; // Initialize search term

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
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Apply Arial font to the whole body */
        body {
            font-family: "Arial";
        }

        /* Center-align the heading */
        h1 {
            text-align: center;
        }

        /* Styling for the table */
        table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
            max-height: 400px;
            /* Set the maximum height of the table */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        /* Styling for table headers and cells */
        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        /* Alternate background color for even rows */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Styling for header links */
        .header-links {
            display: flex;
            align-items: center;
        }

        /* Styling for header link anchors */
        .header-links a {
            margin-left: 10px;
        }

        /* Styling for "Add New" link in header */
        .header-links .add-new-button {
            margin-left: auto;
        }

        /* Style for the Download CSV button */
        #download-csv-button {
            margin-left: auto;
            display: inline-block;
        }

        /* Style for items per page and pagination */
        .items-per-page,
        .pagination {
            text-align: right;
            margin-top: 10px;
        }

        .pagination a {
            padding: 5px 10px;
            text-decoration: none;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            margin: 0 2px;
            color: black;
        }

        .pagination a.active {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Student Management System</h1>
    <br><br>
    <div class="header-links">
        <?php
        // Display user-specific welcome message and logout link
        echo "Welcome " . $_SESSION['UserLogin'] . " | <a href='logout.php'>Logout</a>";

        // Display "Download CSV" button for all users
        echo "<a id='download-csv-button' class='add-new-button' href='download_csv.php'>Download CSV</a>";
        ?>
    </div>
    <br>

    <!-- Search Box -->
<form id="search-form">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Search by first or last name" value="<?php echo $searchTerm; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="itemsPerPage" value="<?php echo $itemsPerPage; ?>">
    <button type="submit">Search</button>
</form>
    <br>
    <table>
        <thead>
            <tr>
                <th></th> <!-- Empty th to give space to view button -->
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <th id="action-header" style="display: none;">Actions</th>
                <?php } ?>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody id="search-results">
            <?php do { ?>
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
            <?php } while ($row = $students->fetch_assoc()) ?>
        </tbody>
    </table>
    <br>
    <?php
    // Display "Add New" button only for administrators
    if ($_SESSION['Access'] === 'administrator') {
        echo "<button class='add-new-button' onclick='location.href=\"add.php\"'>Add New</button>";
        echo "<button id='edit-button'>Edit</button>";
    } ?>

    <!-- Items per page selection -->
    <div class="items-per-page">
        <label for="itemsPerPage">Items per page:</label>
        <select id="itemsPerPage" name="itemsPerPage" onchange="changeItemsPerPage(this)">
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

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>&itemsPerPage=<?php echo $itemsPerPage; ?>" class="<?php if ($page == $i)
                      echo 'active'; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>
    <script>
        const editButton = document.getElementById('edit-button');
        const actionHeader = document.getElementById('action-header');
        const actionCells = document.getElementsByClassName('actions-cell');

        editButton.addEventListener('click', function () {
            actionHeader.style.display = actionHeader.style.display === 'none' ? 'table-cell' : 'none';
            for (let cell of actionCells) {
                cell.style.display = actionHeader.style.display;
            }
        });

        const searchInput = document.getElementById('search');
        const searchResults = document.getElementById('search-results');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = searchResults.getElementsByTagName('tr');

            for (let row of rows) {
                const firstName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                const lastName = row.getElementsByTagName('td')[2].textContent.toLowerCase();
                const isVisible = firstName.includes(searchTerm) || lastName.includes(searchTerm);
                row.style.display = isVisible ? 'table-row' : 'none';
            }
        });

        // Function to change items per page
        function changeItemsPerPage(select) {
            const selectedValue = select.options[select.selectedIndex].value;
            window.location.href = `?page=1&itemsPerPage=${selectedValue}`;
        }
    </script>
</body>

</html>