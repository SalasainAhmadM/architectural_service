<?php
session_start();
include ("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_id = $_POST["team_id"];
    $name = $_POST["name"];
    $role = $_POST["role"];
    $social_media_1 = $_POST["social_media_1"];
    $social_media_2 = $_POST["social_media_2"];
    $social_media_3 = $_POST["social_media_3"];

    if (!empty($_FILES["profile_image"]["name"])) {
        $profile_image = $_FILES["profile_image"]["name"];
        $target_dir = "../img/";
        $target_file = $target_dir . basename($profile_image);

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE team SET name='$name', role='$role', social_media_1='$social_media_1', social_media_2='$social_media_2', social_media_3='$social_media_3', profile_image='$profile_image' WHERE team_id='$team_id'";
        } else {
            $_SESSION['error_message'] = "Error uploading the image.";
            header("Location: team.php");
            exit();
        }
    } else {
        $sql = "UPDATE team SET name='$name', role='$role', social_media_1='$social_media_1', social_media_2='$social_media_2', social_media_3='$social_media_3' WHERE team_id='$team_id'";
    }

    if ($database->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Team member updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $database->error;
    }
    header("Location: team.php");
    exit();
}
?>