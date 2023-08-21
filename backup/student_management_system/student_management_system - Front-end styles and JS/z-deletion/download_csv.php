<?php
// Include the database connection
include_once("connections/connection.php");

// Establish a database connection
$con = connection();

// Fetch student data from the database
$sql = "SELECT * FROM student_list ORDER BY ID DESC";
$students = $con->query($sql) or die($con->$connection->error);

// Function to convert data to CSV format
function arrayToCsv($data) {
    $output = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
}

$data = array();

while ($row = $students->fetch_assoc()) {
    $data[] = $row;
}

// Set headers to prompt download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=student_list.csv');

// Output the CSV content
arrayToCsv($data);
exit();
?>
