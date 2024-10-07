<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST["project_name"];
    $project_description = $_POST["project_description"];
    $project_client = $_POST["project_client"];
    $project_cost = $_POST["project_cost"];
    $project_startdate = $_POST["project_startdate"];
    $project_enddate = $_POST["project_enddate"];
    $project_image = $_FILES["project_image"]["name"];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($project_image);
    move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO finished_project (project_name, project_description, project_client, project_cost, project_startdate, project_enddate, project_image) VALUES ('$project_name', '$project_description', '$project_client', '$project_cost','$project_startdate', '$project_enddate', '$project_image')";

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project added successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: portfolio.php");
    exit();
}
?>