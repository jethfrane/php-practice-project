<?php
session_start();

if (!isset($_SESSION['UserLogin'])) {
    header("Location: login.php");
    exit();
}

include_once("connections/connection.php");

$con = connection();

// Fetch all student records
$sql = "SELECT * FROM student_list";
$students = $con->query($sql) or die($con->error);

// Set the HTTP header for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="student_records.csv"');

// Create a file pointer (output stream) for the CSV data
$output = fopen('php://output', 'w');

// Write the CSV headers
fputcsv($output, array('ID', 'First Name', 'Last Name', 'Gender', 'Notes'));

// Write the CSV data rows
while ($row = $students->fetch_assoc()) {
    fputcsv($output, $row);
}

// Close the file pointer
fclose($output);
?>