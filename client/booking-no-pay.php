<?php
session_start();


// Import database connection
include("../connection.php");


if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }

} else {
    header("location: ../login.php");
}

$sqlmain = "select * from client where client_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$client_id = $userfetch["client_id"];
$username = $userfetch["client_name"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['scheduleid'], $_POST['apponum'], $_POST['date'])) {
        $scheduleid = $_POST['scheduleid'];
        $apponum = $_POST['apponum'];
        $appodate = $_POST['date'];
        $pay_status = 'No Initial Payment Yet';

        // Insert into appointment table
        $sql = "INSERT INTO appointment (client_id, apponum, scheduleid, appodate, pay_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("iiiss", $client_id, $apponum, $scheduleid, $appodate, $pay_status);

        if ($stmt->execute()) {
            header("location: appointment.php?action=booking-added&id=" . $apponum . "&titleget=none");
        } else {
            echo '<script>
                Swal.fire({
                    title: "Error",
                    text: "There was an issue booking your appointment. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
        }

        $stmt->close();
    } else {
        echo '<script>
            Swal.fire({
                title: "Error",
                text: "Missing required fields.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
} else {
    echo '<script>
        Swal.fire({
            title: "Error",
            text: "Invalid request.",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>';
}
?>