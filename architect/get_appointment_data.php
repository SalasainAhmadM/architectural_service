<?php
session_start();
include '../connection.php'; // Ensure this points to your correct database connection file

// Function to retrieve appointment data by apponum
function getAppointmentByApponum($apponum, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM appointment WHERE apponum = ?");
    if ($stmt) {
        $stmt->bind_param("s", $apponum);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['apponum'])) {
        $apponum = $_POST['apponum'];

        $appointment = getAppointmentByApponum($apponum, $conn);

        if ($appointment) {
            echo json_encode($appointment);
        } else {
            echo json_encode(null);
        }
    } else {
        echo json_encode(['error' => 'No appointment number provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>