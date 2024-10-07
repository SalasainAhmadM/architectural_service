<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST["service_name"];
    $service_description = $_POST["service_description"];
    $service_cost = $_POST["service_cost"];
    // $service_date = $_POST["service_date"];
    $service_image = $_FILES["service_image"]["name"];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($service_image);
    move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO project (service_name, service_description, service_cost, service_image) VALUES ('$service_name', '$service_description', '$service_cost', '$service_image')";

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project added successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: project.php");
    exit();
}
?>