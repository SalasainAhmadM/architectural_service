<?php
session_start();
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $client_id = $_POST["client_id"];
    $project_name = $_POST["project_name"];
    $project_description = $_POST["project_description"];
    $project_client = $_POST["project_client"];
    $project_cost = $_POST["project_cost"];
    $project_startdate = $_POST["project_startdate"];
    $project_enddate = $_POST["project_enddate"];

    if ($_FILES["project_image"]["name"]) {
        $project_image = $_FILES["project_image"]["name"];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($project_image);
        move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);

        $sql = "UPDATE finished_project SET project_name='$project_name', project_description='$project_description', project_client='$project_client', project_cost='$project_cost', project_startdate='$project_startdate', project_enddate='$project_enddate', project_image='$project_image' , client_id='$client_id' WHERE project_id='$project_id'";
    } else {
        $sql = "UPDATE finished_project SET project_name='$project_name', project_description='$project_description', project_client='$project_client', project_cost='$project_cost' , project_startdate='$project_startdate', project_enddate='$project_enddate'  WHERE project_id='$project_id'";
    }

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Project updated successfully.";
    } else {
        $_SESSION['success_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: portfolio.php");
    exit();
}
?>