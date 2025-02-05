<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }

} else {
    header("location: ../login.php");
}


//import database
include("../connection.php");
$sqlmain = "select * from client where client_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["client_id"];
$username = $userfetch["client_name"];


if ($_POST) {
    if (isset($_POST["booknow"])) {
        $apponum = $_POST["apponum"];
        $scheduleid = $_POST["scheduleid"];
        $date = $_POST["date"];
        $pay_status = isset($_POST["pay_status"]) ? $_POST["pay_status"] : 'Pay Remaining Payment Now';

        $sql2 = "INSERT INTO appointment (client_id, apponum, scheduleid, appodate, pay_status) 
                 VALUES (?, ?, ?, ?, ?)";
        $stmt = $database->prepare($sql2);
        $stmt->bind_param("iiiss", $userid, $apponum, $scheduleid, $date, $pay_status);
        $stmt->execute();

        header("location: appointment.php?action=booking-added&id=" . $apponum . "&titleget=none");
    }
}

?>