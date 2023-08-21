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

    // Retrieve the record from the database using the provided ID
    $sql = "SELECT * FROM student_list WHERE ID = '$id'";
    $result = $con->query($sql) or die($con->error);
    $row = $result->fetch_assoc();
}

// Process form submission for updating notes
$notesUpdated = false;
$isNoteUpdated = false;
if (isset($_POST['updateNotes'])) {
    $newNotes = $_POST['new_notes'];

    // Update the notes in the database
    $updateSql = "UPDATE student_list SET notes = '$newNotes' WHERE ID = '$id'";
    $con->query($updateSql) or die($con->error);

    // Set flags for displaying updated notes
    $notesUpdated = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details - Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Details</h1>
        <div class="details-section">
            <div class="col-md-6 student-info">
                <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
            </div>
            <div class="col-md-6 notes-section">
                <p><strong>Notes:</strong></p>
                <?php if ($_SESSION['Access'] === 'administrator') { ?>
                    <p id="originalNotes"><?php echo $row['notes']; ?></p>
                    <div class="notes-buttons">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button id="editNotesButton" class="btn btn-secondary">Edit Notes</button>
                            </div>
                            <div>
                                <button id="cancelEditButton" class="btn btn-danger ml-2" style="display: none;">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        const editNotesButton = document.getElementById("editNotesButton");
                        const cancelEditButton = document.getElementById("cancelEditButton");
                        const originalNotes = document.getElementById("originalNotes");
                        const notesTextarea = document.createElement("textarea");
                        notesTextarea.id = "notesTextarea";
                        notesTextarea.className = "form-control mt-3";
                        notesTextarea.rows = 4;
                        notesTextarea.value = originalNotes.textContent.trim();
                        let editingMode = false;

                        editNotesButton.addEventListener("click", () => {
                            if (editingMode) {
                                originalNotes.style.display = "block";
                                editNotesButton.style.display = "block";
                                cancelEditButton.style.display = "none";
                                notesTextarea.remove();
                                updateButton.remove();
                                editingMode = false;
                            } else {
                                originalNotes.style.display = "none";
                                editNotesButton.style.display = "none";
                                cancelEditButton.style.display = "block";
                                notesSection.appendChild(notesTextarea);
                                notesSection.appendChild(updateButton);
                                editingMode = true;
                            }
                        });

                        cancelEditButton.addEventListener("click", () => {
                            originalNotes.style.display = "block";
                            editNotesButton.style.display = "block";
                            cancelEditButton.style.display = "none";
                            notesTextarea.remove();
                            updateButton.remove();
                            editingMode = false;
                        });

                        const updateButton = document.createElement("button");
                        updateButton.className = "btn btn-primary mt-3";
                        updateButton.textContent = "Update Note";

                        updateButton.addEventListener("click", () => {
                            const newNotes = notesTextarea.value.trim();
                            if (newNotes !== "" && newNotes !== originalNotes.textContent.trim()) {
                                originalNotes.textContent = newNotes;
                                originalNotes.style.display = "block";
                                editNotesButton.style.display = "block";
                                cancelEditButton.style.display = "none";
                                notesTextarea.remove();
                                updateButton.remove();
                                alert("Note successfully updated!");
                                editingMode = false;
                            }
                        });

                        const notesSection = document.querySelector(".notes-section");
                    </script>
                <?php } else { ?>
                    <p><?php echo $row['notes']; ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="back-button mt-3">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>

</html>
