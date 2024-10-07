<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


if ($_POST) {
    //import database
    include ("../connection.php");
    $title = $_POST["title"];
    $archiid = $_POST["archiid"];
    $nop = $_POST["nop"];
    $cost = $_POST["cost"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $sql = "insert into schedule (archiid,title,cost,scheduledate,scheduletime,nop) values ($archiid,'$title','$cost','$date','$time',$nop);";
    $result = $database->query($sql);
    header("location: schedule.php?action=session-added&title=$title");

}


?>