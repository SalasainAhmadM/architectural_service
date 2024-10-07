<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}

include ("../connection.php");

if (isset($_POST['appoid'])) {
    $appoid = $_POST['appoid'];

    // Delete the appointment
    $sql = "DELETE FROM appointment WHERE appoid = ?";
    $stmt = $database->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $appoid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("location: appointment.php?status=deleted");
        } else {
            header("location: appointment.php?status=error");
        }

        $stmt->close();
    } else {
        header("location: appointment.php?status=error");
    }
} else {
    header("location: appointment.php");
}

$database->close();
?>