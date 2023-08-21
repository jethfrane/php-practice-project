<?php
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

// Initialize variables
$id = null;

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record from the database using the provided ID
    $sql = "SELECT * FROM student_list WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

// Process form submission for updating notes
if (isset($_POST['updateNotes'])) {
    $newNotes = $_POST['new_notes'];

    // Update the notes in the database using prepared statements
    $updateSql = "UPDATE student_list SET notes = ? WHERE ID = ?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param("si", $newNotes, $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the details page
    header("Location: details.php?id=$id");
    exit();
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
        /* For example, you can add styles for the form container */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Style for the textarea */
        #new_notes {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }
        
        /* Style for the update button */
        .btn-primary {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Notes</h1>
        <div class="form-container">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="new_notes" class="form-label">Write a note:</label>
                    <textarea class="form-control" name="new_notes" id="new_notes" rows="10" cols="60"><?php echo $row['notes']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="updateNotes">Update Notes</button>
            </form>
            <br>
            <a href="details.php?id=<?php echo $id; ?>">Back</a>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>
