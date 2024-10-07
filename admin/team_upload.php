<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

include ("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $social_media_1 = $_POST['social_media_1'];
    $social_media_2 = $_POST['social_media_2'];
    $social_media_3 = $_POST['social_media_3'];

    // Handle the file upload
    $profile_image = $_FILES['profile_image']['name'];
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO team (name, role, profile_image, social_media_1, social_media_2, social_media_3) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("ssssss", $name, $role, $profile_image, $social_media_1, $social_media_2, $social_media_3);

        if ($stmt->execute()) {
            header("location: team.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>