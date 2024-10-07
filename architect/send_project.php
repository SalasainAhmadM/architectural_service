<?php
// Include database connection
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $archiid = $_POST['archiid'];
    $client_id = $_POST['client_id'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_client = $_POST['project_client'];
    $project_startdate = $_POST['project_startdate'];
    $project_enddate = $_POST['project_enddate'];
    $project_cost = $_POST['project_cost'];
    $appoid = $_POST['appoid'];

    // Debugging: Print variables to ensure they are set
    echo "Appoid: $appoid<br>";
    echo "Project Name: $project_name<br>";
    echo "Archiid: $archiid<br>";
    echo "Client ID: $client_id<br>";

    // Handle the project image upload
    $project_image = "";
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["project_image"]["name"]);
        if (move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file)) {
            $project_image = $target_file;
        } else {
            // Handle file upload error
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Insert data into finished_project table
    $sql = "INSERT INTO finished_project (archiid, client_id,  project_name, project_description, project_client, project_startdate, project_enddate,  project_image, project_cost) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $database->prepare($sql)) {
        $stmt->bind_param("iissssssd", $archiid, $client_id, $project_name, $project_description, $project_client, $project_startdate, $project_enddate, $project_image, $project_cost);

        if ($stmt->execute()) {
            // Debugging: Check if the insertion was successful
            echo "Project inserted successfully.<br>";

            // Update the appointment record to indicate the project has been sent
            $updateSql = "UPDATE appointment SET project_sent = 1 WHERE appoid = ?";
            if ($updateStmt = $database->prepare($updateSql)) {
                $updateStmt->bind_param("i", $appoid);

                if ($updateStmt->execute()) {
                    // Debugging: Check if the update was successful
                    echo "Project_sent updated successfully.<br>";

                    // Delete the appointment after it has been successfully sent
                    $deleteSql = "DELETE FROM appointment WHERE appoid = ?";
                    if ($deleteStmt = $database->prepare($deleteSql)) {
                        $deleteStmt->bind_param("i", $appoid);

                        if ($deleteStmt->execute()) {
                            // Debugging: Check if the deletion was successful
                            echo "Appointment deleted successfully.<br>";

                            // Redirect to the appointment page with a success status
                            header("Location: appointment.php?success=2");
                            exit;
                        } else {
                            // Handle delete error
                            echo "Error deleting appointment: " . $deleteStmt->error;
                        }
                        $deleteStmt->close();
                    } else {
                        // Handle statement preparation error for delete
                        echo "Error preparing delete statement: " . $database->error;
                    }
                } else {
                    // Handle update error
                    echo "Error updating project_sent: " . $updateStmt->error;
                }
                $updateStmt->close();
            } else {
                // Handle statement preparation error
                echo "Error preparing update statement: " . $database->error;
            }
        } else {
            // Handle execution error
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Handle statement preparation error
        echo "Error preparing statement: " . $database->error;
    }

    $database->close();
}
?>