<?php
session_start();
include ("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archiid = $_POST['archiid'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_client = $_POST['project_client'];
    $project_date = $_POST['project_date'];
    $project_cost = $_POST['project_cost'];

    // Handle image upload
    $project_image = $_FILES['project_image']['name'];
    $target = "uploads/" . basename($project_image);

    if (move_uploaded_file($_FILES['project_image']['tmp_name'], $target)) {
        $sql = "INSERT INTO portfolio (archiid, project_name, project_description, project_client, project_date, project_image, project_cost) 
                VALUES ('$archiid', '$project_name', '$project_description', '$project_client', '$project_date', '$project_image', '$project_cost')";
        if ($database->query($sql)) {
            $_SESSION['success_message'] = "Project added successfully!";
        } else {
            $_SESSION['error_message'] = "Error adding project.";
        }
    }
    header('Location: appointment.php');
}
