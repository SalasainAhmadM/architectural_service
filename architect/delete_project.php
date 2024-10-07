<?php
session_start();
include ("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST["service_id"];
    $sql = "DELETE FROM project WHERE service_id='$service_id'";

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project deleted successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: project.php");
    exit();
}
?>