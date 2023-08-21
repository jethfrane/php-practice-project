<?php
session_start();
include_once("connections/connection.php");

$con = connection();

if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];

    $sql = "SELECT * FROM student_list WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' ORDER BY ID DESC";
    $students = $con->query($sql) or die($con->$connection->error);
    $searchResults = [];

    while ($row = $students->fetch_assoc()) {
        $searchResults[] = $row;
    }

    echo json_encode($searchResults);
}
?>
