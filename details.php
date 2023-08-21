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

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Process form submission for updating notes
    if (isset($_POST['updateNotes'])) {
        $newNotes = $_POST['new_notes'];

        // Update the notes in the database
        $updateSql = "UPDATE student_list SET notes = '$newNotes' WHERE ID = '$id'";
        $con->query($updateSql) or die($con->error);

        // Display the "Edited successfully" alert
        echo '<div class="alert alert-success mt-3" role="alert" id="successAlert">
                Edited successfully!
              </div>';
    }

    // Retrieve the record from the database using the provided ID
    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql) or die($con->error);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details - Student Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .student-info p {
            margin-bottom: 10px;
        }

        .notes-section {
            padding-top: 20px;
        }

        .notes-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        #notesTextarea {
            resize: vertical;
        }

        .back-button {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Details</h1>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 student-info">
                <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
            </div>
            <div class="col-md-6 notes-section">
                <h4>Notes:</h4>
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <p id="originalNotes"><?php echo $row['notes']; ?></p>
                    <div class="notes-buttons">
                        <div class="d-flex align-items-center">
                            <button id="editNotesButton" class="btn btn-primary me-2">Edit Notes</button>
                            <button id="cancelEditButton" class="btn btn-danger" style="display: none;">Cancel</button>
                        </div>
                    </div>
                    <div id="notesTextareaDiv" style="display: none;">
                        <textarea id="notesTextarea" class="form-control mt-3" rows="4"><?php echo $row['notes']; ?></textarea>
                        <button id="updateNotesButton" class="btn btn-success mt-3">Update Note</button>
                    </div>
                    <div id="successAlert" class="alert alert-success mt-3" role="alert" style="display: none;">
                        Edited successfully!
                    </div>
                    <script>
                        const editNotesButton = document.getElementById("editNotesButton");
                        const cancelEditButton = document.getElementById("cancelEditButton");
                        const originalNotes = document.getElementById("originalNotes");
                        const notesTextarea = document.getElementById("notesTextarea");
                        const notesTextareaDiv = document.getElementById("notesTextareaDiv");
                        const updateNotesButton = document.getElementById("updateNotesButton");
                        let editingMode = false;

                        editNotesButton.addEventListener("click", () => {
                            originalNotes.style.display = "none";
                            editNotesButton.style.display = "none";
                            cancelEditButton.style.display = "block";
                            notesTextareaDiv.style.display = "block";
                            notesTextarea.value = originalNotes.textContent.trim();
                            editingMode = true;
                        });

                        cancelEditButton.addEventListener("click", () => {
                            originalNotes.style.display = "block";
                            editNotesButton.style.display = "block";
                            cancelEditButton.style.display = "none";
                            notesTextareaDiv.style.display = "none";
                            editingMode = false;
                        });

                        updateNotesButton.addEventListener("click", () => {
                            const newNotes = notesTextarea.value.trim();
                            if (newNotes !== "" && newNotes !== originalNotes.textContent.trim()) {
                                originalNotes.textContent = newNotes;
                                originalNotes.style.display = "block";
                                editNotesButton.style.display = "block";
                                cancelEditButton.style.display = "none";
                                notesTextareaDiv.style.display = "none";
                                editingMode = false;

                                // Send the updated note to the server
                                const formData = new FormData();
                                formData.append("updateNotes", "true");
                                formData.append("new_notes", newNotes);

                                fetch(window.location.href, {
                                    method: "POST",
                                    body: formData
                                })
                                    .then(response => response.text())
                                    .then(data => console.log(data))
                                    .catch(error => console.error("Error:", error));
                            }
                        });
                    </script>
                <?php } else { ?>
                    <p><?php echo $row['notes']; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="back-button">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
