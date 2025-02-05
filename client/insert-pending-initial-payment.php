<?php
// Start session and ensure user authentication
session_start();

if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'p')) {
    header("location: ../login.php");
    exit();
}

$useremail = $_SESSION["user"];

// Include database connection
include("../connection.php");

// Get user information
$sqlmain = "SELECT * FROM client WHERE client_email = ?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();

$userid = $userfetch["client_id"];
$username = $userfetch["client_name"];

if ($_POST && isset($_POST["booknow"])) {
    $apponum = $_POST["apponum"];
    $scheduleid = $_POST["scheduleid"];
    $date = $_POST["date"];

    // Insert appointment securely
    $sql2 = "INSERT INTO appointment (client_id, apponum, scheduleid, appodate) VALUES (?, ?, ?, ?)";
    $stmt2 = $database->prepare($sql2);
    $stmt2->bind_param("iiis", $userid, $apponum, $scheduleid, $date);

    if ($stmt2->execute()) {
        echo '<script>
            Swal.fire({
                title: "Booking Successful",
                text: "Your appointment has been successfully booked.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "appointment.php?action=booking-added&id=' . $apponum . '";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Error",
                text: "An error occurred while booking the appointment: ' . $stmt2->error . '",
                icon: "error",
                confirmButtonText: "OK"
            }).then(() => {
                window.history.back();
            });
        </script>';
    }

    $stmt2->close();
}

$database->close();
?>