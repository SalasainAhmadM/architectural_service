<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../img/archi_logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Dashboard</title>
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


</head>

<body>
    <?php

    //learn from w3schools.com
    
    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }

    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@archi.com</p>
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
                                <p>Dashboard</p>
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
                                <p>Schedule</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="appointment.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Projects</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="client.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Clients</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="team.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-people-group"></i>
                                <p>Members</p>
                            </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

                <tr>

                    <td colspan="2" class="nav-bar">

                        <!-- <form action="architects.php" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar"
                                placeholder="Search Architect name or Email" list="architects">&nbsp;&nbsp;

                            <?php
                            echo '<datalist id="architects">';
                            $list11 = $database->query("select  archiname,archiemail from  architect;");

                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["archiname"];
                                $c = $row00["archiemail"];
                                echo "<option value='$d'><br/>";
                                echo "<option value='$c'><br/>";
                            }
                            ;

                            echo ' </datalist>';
                            ?>


                            <input type="Submit" value="Search" class="login-btn btn-primary-soft btn"
                                style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                        </form> -->

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
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td colspan="4">
                                        <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:80%;display: flex">
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
                                            <!-- <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/architects-hover.svg');">
                                            </div> -->
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:80%;display: flex;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $clientrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Clients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <i style="color: #008080; font-size: 30px"
                                                        class="fa-solid fa-users"></i>
                                                </div>
                                            </div>
                                            <!-- <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/clients-hover.svg');"></div> -->
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:80%;display: flex; ">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $appointmentrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    NewBooking &nbsp;&nbsp;
                                                    <i style="color: #008080; font-size: 30px"
                                                        class="fa-solid fa-calendar-check"></i>
                                                </div>
                                            </div>
                                            <!-- <div class="btn-icon-back dashboard-icons"
                                                style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');">
                                            </div> -->
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:75%;display: flex;padding-top:26px;padding-bottom:26px;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $schedulerow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px">
                                                    Today Sessions &nbsp;&nbsp;&nbsp;
                                                    <i style="color: #008080; font-size: 30px"
                                                        class="fa-solid fa-calendar-days"></i>
                                                </div>
                                            </div>
                                            <!-- <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/session-iceblue.svg');">
                                            </div> -->
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>






                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                    <p
                                        style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:#008080;">
                                        Upcoming Projects until Next <?php
                                        echo date("l", strtotime("+1 week"));
                                        ?>
                                    </p>
                                    <p
                                        style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Here's Quick access to Upcoming Projects until 7 days<br>
                                        More details available in @Project section.
                                    </p>

                                </td>
                                <td>
                                    <p
                                        style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:#008080;">
                                        Upcoming Sessions until Next <?php
                                        echo date("l", strtotime("+1 week"));
                                        ?>
                                    </p>
                                    <p
                                        style="padding-bottom:19px;text-align:right;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Here's Quick access to Upcoming Sessions that Scheduled until 7 days<br>
                                        Add,Remove and Many features available in @Schedule section.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                            <table width="85%" class="sub-table scrolldown" border="0">
                                                <thead>
                                                    <tr>
                                                        <th class="table-headin" style="font-size: 12px;">

                                                            Appointment number

                                                        </th>
                                                        <th class="table-headin">
                                                            Client name
                                                        </th>
                                                        <th class="table-headin">


                                                            Architect

                                                        </th>
                                                        <th class="table-headin">


                                                            Session

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                                                    $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,architect.archiname,client.client_name,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid  where schedule.scheduledate>='$today'  and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc";

                                                    $result = $database->query($sqlmain);

                                                    if ($result->num_rows == 0) {
                                                        echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/empty.png" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';

                                                    } else {
                                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                                            $row = $result->fetch_assoc();
                                                            $appoid = $row["appoid"];
                                                            $scheduleid = $row["scheduleid"];
                                                            $title = $row["title"];
                                                            $archiname = $row["archiname"];
                                                            $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                                            $scheduletime = date("g:ia", strtotime($row["scheduletime"]));
                                                            $client_name = $row["client_name"];
                                                            $apponum = $row["apponum"];
                                                            $appodate = $row["appodate"];
                                                            echo '<tr>


                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            ' . $apponum . '
                                                            
                                                        </td>

                                                        <td style="font-weight:600;"> &nbsp;' .

                                                                substr($client_name, 0, 25)
                                                                . '</td >
                                                        <td style="font-weight:600;"> &nbsp;' .

                                                                substr($archiname, 0, 25)
                                                                . '</td >
                                                           
                                                        
                                                        <td>
                                                        ' . substr($title, 0, 15) . '
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
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                            <table width="85%" class="sub-table scrolldown" border="0">
                                                <thead>
                                                    <tr>
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
                                                    $sqlmain = "select schedule.scheduleid,schedule.title,architect.archiname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join architect on schedule.archiid=architect.archiid  where schedule.scheduledate>='$today' and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc";
                                                    $result = $database->query($sqlmain);

                                                    if ($result->num_rows == 0) {
                                                        echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/empty.png" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
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
                                                            $archiname = $row["archiname"];
                                                            $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                                            $scheduletime = date("g:ia", strtotime($row["scheduletime"]));
                                                            $nop = $row["nop"];
                                                            echo '<tr>
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
                            <tr>
                                <td>
                                    <center>
                                        <a href="appointment.php" class="non-style-link"><button class="btn-primary btn"
                                                style="width:85%">Show all Projects</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="schedule.php" class="non-style-link"><button class="btn-primary btn"
                                                style="width:85%">Show all Sessions</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
            </center>
            </td>
            </tr>
            </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>