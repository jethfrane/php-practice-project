<?php
session_start();

include_once("connections/connection.php");
$con = connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM student_list WHERE ID = '$id'";
    $con->query($sql) or die($con->error);

    header("Location: index.php");
} else {
    header("Location: index.php");
}
?>
