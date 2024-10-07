<?php
session_start();
include("../connection.php");

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate form inputs
    $archiid = $_POST['archiid'] ?? null;
    $projectName = $_POST['project_name'] ?? null;
    $projectDescription = $_POST['project_description'] ?? null;
    $projectClient = $_POST['project_client'] ?? null;
    $projectstartDate = $_POST['project_startdate'] ?? null;
    $projectendDate = $_POST['project_enddate'] ?? null;
    $projectCost = $_POST['project_cost'] ?? null;
    $currentImage = $_POST['current_image'] ?? null;
    $project_id = $_POST['project_id'];
    $appoid = $_POST['appoid']; // Added for appointment deletion

    // Debugging output
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Check for required fields
    if ($archiid === null || $projectName === null || $projectClient === null || $projectstartDate === null || $projectendDate === null || $projectCost === null || $project_id === null || $appoid === null) {
        die('Required fields are missing.');
    }

    // Handle file upload
    $imageName = $currentImage; // Use existing image by default
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === 0) {
        $image = $_FILES['project_image'];
        // Prevent uploading the same image by comparing names
        if (basename($image['name']) !== $currentImage) {
            $imageName = time() . '-' . basename($image['name']);
            $imagePath = '../uploads/' . $imageName;
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
    }

    // Prepare and execute SQL query to add to portfolio
    $stmt = $database->prepare("INSERT INTO portfolio (archiid, project_name, project_description, project_client, project_startdate, project_enddate, project_image, project_cost, project_id , appoid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssiii", $archiid, $projectName, $projectDescription, $projectClient, $projectstartDate, $projectendDate, $imageName, $projectCost, $project_id, $appoid);

    if ($stmt->execute()) {
        // Prepare and execute SQL query to delete the appointment
        $deleteStmt = $database->prepare("DELETE FROM appointment WHERE appoid = ?");
        $deleteStmt->bind_param("i", $appoid);
        $deleteStmt->execute();
        $deleteStmt->close();

        // Redirect with success flag for adding to portfolio
        header("Location: appointment.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $database->close();
}
?>