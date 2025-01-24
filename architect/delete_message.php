<?php
session_start();
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id'])) {
    $messageId = (int) $_POST['message_id'];

    $deleteQuery = "DELETE FROM messages WHERE id = ?";
    $stmt = $database->prepare($deleteQuery);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>