<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST["service_id"];
    $service_name = $_POST["service_name"];
    $service_description = $_POST["service_description"];
    $service_cost = $_POST["service_cost"];
    // $service_date = $_POST["service_date"];

    if ($_FILES["service_image"]["name"]) {
        $service_image = $_FILES["service_image"]["name"];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($service_image);
        move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file);

        $sql = "UPDATE project SET service_name='$service_name', service_description='$service_description', service_cost='$service_cost',  service_image='$service_image' WHERE service_id='$service_id'";
    } else {
        $sql = "UPDATE project SET service_name='$service_name', service_description='$service_description', service_cost='$service_cost'  WHERE service_id='$service_id'";
    }

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project updated successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: project.php");
    exit();
}
?>