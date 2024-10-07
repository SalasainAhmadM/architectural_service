<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Appointments</title>
</head>

<body>
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
    $client_image = $userfetch["client_image"];


    //echo $userid;
    //echo $username;
    

    //TODO
    $sqlmain = "select appointment.appoid,appointment.status,appointment.pay_status,schedule.scheduleid,schedule.cost,schedule.title,architect.archiname,client.client_name,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid  where  client.client_id=$userid ";

    if ($_POST) {
        //print_r($_POST);
    



        if (!empty($_POST["sheduledate"])) {
            $sheduledate = $_POST["sheduledate"];
            $sqlmain .= " and schedule.scheduledate='$sheduledate' ";
        }
        ;



        //echo $sqlmain;
    
    }

    $sqlmain .= "order by appointment.appodate  asc";
    $result = $database->query($sqlmain);
    ?>
    <style>
        .dashbord-tables,
        .architect-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .architect-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .btn-primary {
            background-color: #008080;
            border: 1px solid #008080;
            color: #fff;
            box-shadow: 0 3px 5px 0 rgba(57, 108, 240, 0.3);
        }

        .btn-primary:hover {
            background-color: #008080;
            border: 1px solid #008080;
            color: #fff;
            box-shadow: 0 3px 5px 0 rgba(57, 108, 240, 0.3);
        }

        body {
            background-image: url(./img/2.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
            font-family: 'Roboto', sans-serif;
        }

        .btn {
            font-family: 'Montserrat', sans-serif;
        }

        .btn-primary-soft {
            background-color: #008080;
            border: 1px solid rgba(57, 108, 240, 0.1);
            color: white;
        }

        .btn-primary-soft:hover {
            background-color: #008080;
            border: 1px solid rgba(57, 108, 240, 0.1);
            color: white;
        }

        .menu-row {
            text-align: left;

        }

        .menu-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            padding: 10px;
            margin-left: 10px;
        }

        .menu-link-active {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            margin-left: 10px;
            background-color: #008080;
        }

        .menu-link:hover {
            background-color: #008080;
        }

        .menu-item {
            display: flex;
            align-items: center;
        }

        .menu-item:hover {
            color: white;
        }

        .menu-item i {
            font-size: 24px;
            margin-right: 8px;
        }

        .menu-item p {
            margin: 0;
        }

        .dashboard-items {
            border: 2px solid #c9cbce9f;
            color: #008080;
        }

        .table-headin {
            border-bottom: 3px solid #008080;
        }
    </style>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="<?php echo !empty($client_image) ? $client_image : '../img/user.png'; ?>"
                                        alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="index.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fas fa-tachometer-alt"></i>
                                <p>Home</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="architects.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-regular fa-building"></i>
                                <p>Architect</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="schedule.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-days"></i>
                                <p>Scheduled Sessions</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="appointment.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>My Bookings</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="message.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-message"></i>
                                <p>Chat Box</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="project.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-briefcase"></i>
                                <p>Finished Projects</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="feedback.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <p>Feedback</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="settings.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </div>
                    </td>
                </tr>


            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="appointment.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Bookings history</p>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php

                            date_default_timezone_set('Asia/Manila');

                            $today = date('Y-m-d');
                            echo $today;


                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label"
                            style="display: flex;justify-content: center;align-items: center;"><img
                                src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>

                <!-- <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
                        </a>
                        </div>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">

                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My
                            Bookings
                            (<?php echo $result->num_rows; ?>)</p>
                    </td>

                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;">
                        <center>
                            <table class="filter-container" border="0">
                                <tr>
                                    <td width="10%">

                                    </td>
                                    <td width="5%" style="text-align: center;">
                                        Date:
                                    </td>
                                    <td width="30%">
                                        <form action="" method="post">

                                            <input type="date" name="sheduledate" id="date"
                                                class="input-text filter-container-items" style="margin: 0;width: 95%;">

                                    </td>

                                    <td width="12%">
                                        <input type="submit" name="filter" value=" Filter"
                                            class=" btn-primary-soft btn button-icon "
                                            style="padding: 15px; margin :0;width:100%">
                                        </form>
                                    </td>

                                </tr>
                            </table>

                        </center>
                    </td>

                </tr>



                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0" style="border:none">

                                    <tbody>

                                        <?php
                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                                <td colspan="7">
                                                    <br><br><br><br>
                                                    <center>
                                                        <img src="../img/empty.png" width="25%">
                                                        <br>
                                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
                                                        <a class="non-style-link" href="appointment.php">
                                                            <button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">
                                                                &nbsp; Show all Appointments &nbsp;
                                                            </button>
                                                        </a>
                                                    </center>
                                                    <br><br><br><br>
                                                </td>
                                            </tr>';
                                        } else {
                                            for ($x = 0; $x < ($result->num_rows); $x++) {
                                                echo "<tr>";
                                                for ($q = 0; $q < 3; $q++) {
                                                    $row = $result->fetch_assoc();
                                                    if (!isset($row)) {
                                                        break;
                                                    }
                                                    $scheduleid = $row["scheduleid"];
                                                    $title = $row["title"];
                                                    $archiname = $row["archiname"];
                                                    $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                                    $scheduletime = date("g:ia", strtotime($row["scheduletime"]));
                                                    $apponum = $row["apponum"];
                                                    $appodate = date("M d, Y", strtotime($row["appodate"]));
                                                    $appoid = $row["appoid"];
                                                    $status = $row["status"];
                                                    $pay_status = $row["pay_status"];
                                                    $cost = $row["cost"];

                                                    if ($scheduleid == "") {
                                                        break;
                                                    }

                                                    $balance = $pay_status === "Fully Paid" ? "₱0.00" : "₱" . number_format($cost * 0.7, 2);
                                                    $pay_button_text = $pay_status === "Fully Paid" ? "Fully Paid ☑" : "Pay Remaining Payment Now";

                                                    echo '
                                                    <td style="width: 25%;">
                                                        <div class="dashboard-items search-items">
                                                            <div style="width:100%;">
                                                                <div class="h3-search">
                                                                    Booking Date: ' . $appodate . '<br>
                                                                    Reference Number: OC-000-' . $appoid . '
                                                                </div>
                                                                <div class="h1-search">
                                                                    ' . substr($title, 0, 21) . '<br>
                                                                </div>
                                                                <div class="h3-search">
                                                                    Appointment Number:<div class="h1-search">0' . $apponum . '</div>
                                                                </div>
                                                                <div class="h3-search">
                                                                    ' . substr($archiname, 0, 30) . '
                                                                </div>
                                                                <div class="h4-search">
                                                                    End Date: ' . $scheduledate . '<br>Starts: <b>@' . $scheduletime . '</b> 
                                                                </div>
                                                                <div class="h2-search">
                                                                    ' . $status . '
                                                                </div>
                                                                <div style="margin-bottom: 5px;" class="h3-search">
                                                                    Balance: ' . $balance . '
                                                                </div>
                                                                 <div class="h1-search">
                                                                    <button style="font-size: 16px; margin-left: 4px;" class="login-btn btn-primary-soft btn pay-now-btn" onclick="' . ($pay_status !== "Fully Paid" ? 'redirectToPayPal(\'' . $appoid . '\', \'' . addslashes($title) . '\', \'' . $cost * 0.7 . '\')' : 'showModal()') . '">
                                                                    <i class="fa-brands fa-paypal"></i>
                                                                        ' . $pay_button_text . '
                                                                    </button>
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </td>';
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>
                        </center>
                    </td>
                </tr>



            </table>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            text-align: center;
            border-radius: 5px;
        }

        .modal-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #008080;
        }

        .close-button {
            color: #008080;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <!-- Success Modal -->
    <div id="success-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>You have Successfully Paid!</h2>
            <p id="success-message">Fully Paid✅</p>
        </div>
    </div>
    </div>
    <script>
        function redirectToPayPal(appoid, title, amount) {
            var returnUrl = "http://localhost/architectural_service/client/paypal_return.php?appoid=" + encodeURIComponent(appoid) + "&payment=success";
            var cancelUrl = "http://localhost/architectural_service/client/appointment.php?appoid=" + encodeURIComponent(appoid) + "&payment=failed";

            window.location.href = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sb-daa2k32419423@business.example.com&item_name=" + encodeURIComponent(title) + "&amount=" + amount + "&currency_code=PHP&return=" + encodeURIComponent(returnUrl) + "&cancel_return=" + encodeURIComponent(cancelUrl);
        }

        function showModal() {
            var modal = document.getElementById("success-modal");
            modal.style.display = "block";
        }

        document.addEventListener("DOMContentLoaded", function () {
            var closeButton = document.getElementsByClassName("close-button")[0];

            closeButton.onclick = function () {
                var modal = document.getElementById("success-modal");
                modal.style.display = "none";
                window.location.href = "appointment.php"; // Redirect to appointment.php when the modal is closed
            }

            window.onclick = function (event) {
                var modal = document.getElementById("success-modal");
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.location.href = "appointment.php"; // Redirect to appointment.php when clicking outside the modal
                }
            }
        });
    </script>

    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>