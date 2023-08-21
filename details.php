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
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/php-logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        /* Integrate your CSS styles here */
        /* For example, you can add styles for form elements */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-color: #fff
        }

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
    <div class="container mt-5 mb-3">
        <h1 class="text-center">Student Details</h1>
    </div>
    <div class="form-container">
        <div class="col-md-6 student-info">
            <p><strong>First Name:</strong>
                <?php echo $row['first_name']; ?>
            </p>
            <p><strong>Last Name:</strong>
                <?php echo $row['last_name']; ?>
            </p>
            <p><strong>Gender:</strong>
                <?php echo $row['gender']; ?>
            </p>
        </div>
        <div class="col-md-6 notes-section">
            <p><strong>Notes:</strong></p>
            <?php if ($_SESSION['Access'] === 'administrator') { ?>
                <p id="originalNotes">
                    <?php echo $row['notes']; ?>
                </p>
                <div class="notes-buttons">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button id="editNotesButton" class="btn btn-primary">Edit Notes</button>
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

                    const notesSection = document.querySelector(".notes-section");
                </script>
            <?php } else { ?>
                <p>
                    <?php echo $row['notes']; ?>
                </p>
            <?php } ?>
        </div>
        <div class="back-button mt-3">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>

</html>