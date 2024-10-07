<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

if ($_GET) {
    // Import database connection
    include ("../connection.php");

    $id = $_GET["id"];

    // Delete the appointment using a parameterized query
    $sql = "DELETE FROM appointment WHERE appoid = ?";
    $stmt = $database->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $database->error;
    }

    // Redirect to the appointment page after deletion
    header("location: appointment.php");
    exit();
}
?>