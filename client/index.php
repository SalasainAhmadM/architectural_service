<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Dashboard</title>


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
                        <a href="index.php" class="menu-link-active">
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
                        <a href="appointment.php" class="menu-link">
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
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

                <tr>

                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>

                    </td>
                    <td width="25%">

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


                            $clientrow = $database->query("select  * from  client;");
                            $architectrow = $database->query("select  * from  architect;");
                            $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                            $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label"
                            style="display: flex;justify-content: center;align-items: center;"><img
                                src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <tr>
                    <td colspan="4">

                        <center>
                            <table class="filter-container architect-header client-header"
                                style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1><?php echo $username ?>.</h1>



                                    </td>
                                </tr>
                            </table>
                        </center>

                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width=" 50%">






                            <center>
                                <table class="filter-container" style="border: none;" border="0">
                                    <tr>
                                        <td colspan="4">
                                            <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;">
                                            <div class="dashboard-items"
                                                style="padding:20px;margin:auto;width:95%;display: flex">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo $architectrow->num_rows ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        Architect &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i style="color: #008080; font-size: 30px"
                                                            class="fa-solid fa-sitemap"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 25%;">
                                            <div class="dashboard-items"
                                                style="padding:20px;margin:auto;width:95%;display: flex;">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo $clientrow->num_rows ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        All Clients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i style="color: #008080; font-size: 30px"
                                                            class="fa-solid fa-users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;">
                                            <div class="dashboard-items"
                                                style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo $appointmentrow->num_rows ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        New Booking &nbsp;&nbsp;
                                                        <i style="color: #008080; font-size: 30px"
                                                            class="fa-solid fa-calendar-check"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                        <td style="width: 25%;">
                                            <div class="dashboard-items"
                                                style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo $schedulerow->num_rows ?>
                                                    </div><br>
                                                    <div class="h3-dashboard" style="font-size: 15px">
                                                        Today Sessions&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i style="color: #008080; font-size: 30px"
                                                            class="fa-solid fa-calendar-days"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                </table>
                            </center>








                    </td>
                    <td>



                        <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Your Upcoming
                            Booking
                        </p>
                        <center>
                            <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                <table width="85%" class="sub-table scrolldown" border="0">
                                    <thead>

                                        <tr>
                                            <th class="table-headin">


                                                Appoint. Number

                                            </th>
                                            <th class="table-headin">


                                                Session Title

                                            </th>

                                            <th class="table-headin">
                                                Architect
                                            </th>
                                            <th class="table-headin">

                                                Sheduled Date & Time

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $nextweek = date("Y-m-d", strtotime("+1 week"));
                                        $sqlmain = "select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid  where  client.client_id=$userid  and schedule.scheduledate>='$today' order by schedule.scheduledate asc";
                                        //echo $sqlmain;
                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/empty.png" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Channel a architect &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';

                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $scheduleid = $row["scheduleid"];
                                                $title = $row["title"];
                                                $apponum = $row["apponum"];
                                                $archiname = $row["archiname"];
                                                $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                                $scheduletime = date("g:ia", strtotime($row["scheduletime"]));

                                                echo '<tr>
                                                        <td style="padding:30px;font-size:25px;font-weight:700;"> &nbsp;' .
                                                    $apponum
                                                    . '</td>
                                                        <td style="padding:20px;"> &nbsp;' .
                                                    substr($title, 0, 30)
                                                    . '</td>
                                                        <td>
                                                        ' . substr($archiname, 0, 20) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . $scheduledate . ' @ ' . $scheduletime . '
                                                        </td>

                
                                                       
                                                    </tr>';

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
            </td>
            <tr>
                </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>