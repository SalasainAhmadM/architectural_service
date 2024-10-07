<?php
// Import database
include("../connection.php"); // Ensure the path is correct to your connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appoid = $_POST['appoid'];
    $status = $_POST['status'];

    // Update the appointments table
    $sql = "UPDATE appointment SET status = ? WHERE appoid = ?";
    $stmt = $database->prepare($sql); // Use $database instead of $conn
    $stmt->bind_param('si', $status, $appoid);

    if ($stmt->execute()) {
        // Status updated successfully
        header("Location: appointment.php");
    } else {
        // Handle error
        echo "Error updating status: " . $database->error;
    }
    $stmt->close();
}
?>