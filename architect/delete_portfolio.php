<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $sql = "DELETE FROM finished_project WHERE project_id='$project_id'";

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project deleted successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: portfolio.php");
    exit();
}
?>