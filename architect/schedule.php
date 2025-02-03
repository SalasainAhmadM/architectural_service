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

    <title>Schedule</title>
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
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }

    } else {
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");
    $userrow = $database->query("select * from architect where archiemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["archiid"];
    $username = $userfetch["archiname"];
    $archi_image = $userfetch["archi_image"];
    //echo $userid;
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="<?php echo !empty($archi_image) ? $archi_image : '../img/user.png'; ?>"
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
                                <p>Dashboard</p>
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
                        <a href="schedule.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-days"></i>
                                <p>Sessions</p>
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
                        <a href="project.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-bell-concierge"></i>
                                <p>Services</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="portfolio.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-briefcase"></i>
                                <p>Portfolio</p>
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
                        <a href="schedule.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Sessions</p>

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

                            $list110 = $database->query("select  * from  schedule where archiid=$userid;");

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
                        <div style="display: flex;margin-top: 40px;">
                            <div class="heading-main12"
                                style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule
                                a
                                Session</div>
                            <a href="?action=add-session&id=none&error=0" class="non-style-link"><button
                                    class="login-btn btn-primary btn button-icon" style="margin-left:25px;"><i
                                        style="margin-right: 4px" class="fa-solid fa-plus"></i>Add a
                                    Session
                                    </font></button>
                            </a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">

                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My
                            Sessions (<?php echo $list110->num_rows; ?>) </p>
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
                                        <button
                                            style="background-color: #008080; border: 1px solid #008080; color: white; 
                                            border-radius: 4px; height: 50%; width: 70%; font-size: 14px; padding: 6px; "
                                            type="submit" name="filter" class="icon-button">
                                            <i class="fa-solid fa-filter"></i> Filter
                                        </button>
                                        </form>
                                    </td>

                                </tr>
                            </table>

                        </center>
                    </td>

                </tr>

                <?php

                $sqlmain = "select schedule.scheduleid,schedule.title,schedule.cost,architect.archiname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join architect on schedule.archiid=architect.archiid where architect.archiid=$userid ";
                if ($_POST) {
                    //print_r($_POST);
                    $sqlpt1 = "";
                    if (!empty($_POST["sheduledate"])) {
                        $sheduledate = $_POST["sheduledate"];
                        $sqlmain .= " and schedule.scheduledate='$sheduledate' ";
                    }

                }

                ?>

                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">


                                                Session Title

                                            </th>
                                            <th class="table-headin">


                                                Initial Cost

                                            </th>
                                            <th class="table-headin">


                                                Remaining Cost

                                            </th>
                                            <th class="table-headin">


                                                Total Cost

                                            </th>
                                            <th class="table-headin">

                                                Scheduled Date & Time

                                            </th>
                                            <th class="table-headin">

                                                Max num that can be booked

                                            </th>

                                            <th class="table-headin">

                                                Events

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                            <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                            <img src="../img/empty.png" width="25%">
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords!</p>
                                            <a class="non-style-link" href="schedule.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</button></a>
                                            </center>
                                            <br><br><br><br>
                                            </td>
                                            </tr>';
                                        } else {
                                            $currentDateTime = new DateTime();

                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $scheduleid = $row["scheduleid"];
                                                $title = $row["title"];
                                                $archiname = $row["archiname"];
                                                $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                                $scheduletime = date("g:ia", strtotime($row["scheduletime"]));
                                                $nop = $row["nop"];
                                                $cost = $row["cost"];

                                                $scheduleDateTime = new DateTime($row["scheduledate"] . ' ' . $row["scheduletime"]);


                                                $isInactive = $scheduleDateTime < $currentDateTime;

                                                echo '<tr';
                                                if ($isInactive) {
                                                    echo ' style="background-color: #f8d7da;"';
                                                }
                                                echo '>';

                                                echo '<td> &nbsp;' . substr($title, 0, 30) . '</td>';
                                                echo '<td style="text-align:center;">₱' . number_format($cost * 0.3, 2) . '</td>';
                                                echo '<td style="text-align:center;">₱' . number_format($cost * 0.7, 2) . '</td>';
                                                echo '<td style="text-align:center;">₱' . number_format($cost, 2) . '</td>';
                                                echo '<td style="text-align:center;">' . $scheduledate . ' @ ' . $scheduletime . '</td>';
                                                echo '<td style="text-align:center;">' . $nop . '</td>';

                                                echo '<td>';
                                                echo '<div style="display:flex;justify-content: center;">';

                                                if ($isInactive) {
                                                    echo '<span style="color: red;"></span>';
                                                }

                                                echo '<a href="?action=view&id=' . $scheduleid . '" class="non-style-link"><button class="btn-primary-soft btn button-icon" style="font-size: 12px;padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text"><i style="margin-right: 4px;" class="fa-regular fa-eye"></i>View</font></button></a>';
                                                echo '&nbsp;&nbsp;&nbsp;';
                                                echo '<a href="?action=drop&id=' . $scheduleid . '&name=' . $title . '" class="non-style-link"><button class="btn-primary-soft btn button-icon" style="font-size: 12px;padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text"><i style="margin-right: 4px;" class="fa-solid fa-xmark"></i>Cancel Session</font></button></a>';

                                                echo '</div>';
                                                echo '</td>';
                                                echo '</tr>';
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
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'add-session') {
            echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <a class="close" href="schedule.php">&times;</a> 
                    <div style="display: flex;justify-content: center;">
                        <div class="abc">
                            <table width="80%" class="sub-table scrolldown add-archi-form-container" border="0">
                                <tr>
                                    <td class="label-td" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <form action="add-session.php" method="POST" class="add-new-form">
                                            <label for="title" class="form-label">Session Title: </label>
                                    </td>
                                </tr>
                               <tr>
                                    <td class="label-td" colspan="2">
                                        <select name="title" id="title" class="box" required onchange="updateCosts(this.value)">
                                            <option value="" disabled selected hidden>Choose Service Name from the list</option>';

            // Query to fetch service names and costs from the `project` table
            $service_list = $database->query("SELECT service_id, service_name, service_cost FROM project ORDER BY service_name ASC;");
            $service_data = [];
            while ($row = $service_list->fetch_assoc()) {
                $service_name = $row["service_name"];
                $service_id = $row["service_id"];
                $service_cost = $row["service_cost"];
                $service_data[$service_name] = $service_cost;
                echo "<option value='$service_name'>$service_name</option>";
            }

            echo '
                                        </select><br><br>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="initial_payment" class="form-label">Initial Payment (30%): </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" id="initial_payment" name="initial_payment" class="input-text" readonly><br>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="remaining_payment" class="form-label">Remaining Payment (70%): </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" id="remaining_payment" name="remaining_payment" class="input-text" readonly><br>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="total_payment" class="form-label">Total Payment: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" id="cost" name="cost" class="input-text" readonly><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="archiid" class="form-label">Architect: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <select name="archiid" id="" class="box">
                                            <option value="" disabled selected hidden>Choose Architect Name from the list</option><br/>';

            $list11 = $database->query("SELECT * FROM architect ORDER BY archiname ASC;");
            for ($y = 0; $y < $list11->num_rows; $y++) {
                $row00 = $list11->fetch_assoc();
                $sn = $row00["archiname"];
                $id00 = $row00["archiid"];
                echo "<option value=" . $id00 . ">$sn</option><br/>";
            }

            echo '
                                        </select><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="nop" class="form-label">Number of Clients/Appointment Numbers: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="number" name="nop" class="input-text" min="0" placeholder="The final appointment number for this session depends on this number" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="date" class="form-label">Session Date: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="date" name="date" class="input-text" min="' . date('Y-m-d') . '" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="time" class="form-label">Schedule Time: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="time" name="time" class="input-text" placeholder="Time" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
                                    </td>
                                </tr>
                            </form>
                        </tr>
                    </table>
                </div>
            </div>
        </center>
        <br><br>
    </div>
    </div>
    ';
        } elseif ($action == 'session-added') {
            $titleget = $_GET["title"];
            echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <br><br>
                    <h2>Session Placed.</h2>
                    <a class="close" href="schedule.php">&times;</a>
                    <div class="content">
                        ' . substr($titleget, 0, 40) . ' was scheduled.<br><br>
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                    </div>
                </center>
            </div>
        </div>
        ';
        } elseif ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="schedule.php">&times;</a>
                    <div class="content">
                        You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <a href="delete-session.php?id=' . $id . '" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
            </div>
        </div>
        ';
        } elseif ($action == 'view') {
            $sqlmain = "SELECT schedule.scheduleid, schedule.title,schedule.cost, architect.archiname, schedule.scheduledate, schedule.scheduletime, schedule.nop 
                    FROM schedule 
                    INNER JOIN architect ON schedule.archiid=architect.archiid  
                    WHERE schedule.scheduleid=$id";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $archiname = $row["archiname"];
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $nop = $row['nop'];
            $cost = $row['cost'];

            $sqlmain12 = "SELECT * FROM appointment WHERE scheduleid=$id";
            $result12 = $database->query($sqlmain12);
            $appo = $result12->num_rows;

            $remainingnop = $nop - $appo;

            echo '
        <div id="popup1" class="overlay">
                <div class="popup">
                    <a class="close" href="schedule.php">&times;</a>
                    <div class="content">
                        <h2>Session Details</h2>
                        <table class="styled-table">
                            <tr>
                                <th>Session Title:</th>
                                <td>' . $title . '</td>
                            </tr>
                            <tr>
                                <th>Initial Payment:</th>
                                <td>₱' . number_format($cost * 0.3, 2) . '</td>
                            </tr>
                            <tr>
                                <th>Remaining Payment:</th>
                                <td>₱' . number_format($cost * 0.7, 2) . '</td>
                            </tr>
                            <tr>
                                <th>Total Cost:</th>
                                <td>₱' . number_format($cost, 2) . '</td>
                            </tr>
                            <tr>
                                <th>Architect of this session:</th>
                                <td>' . $archiname . '</td>
                            </tr>
                            <tr>
                                <th>Scheduled Date:</th>
                                <td>' . $scheduledate . '</td>
                            </tr>
                            <tr>
                                <th>Scheduled Time:</th>
                                <td>' . $scheduletime . '</td>
                            </tr>
                            <tr>
                                <th>Number of Appointments:</th>
                                <td>' . $nop . '</td>
                            </tr>
                            <tr>
                                <th>Number of Patients Already Registered:</th>
                                <td>' . $appo . '</td>
                            </tr>
                            <tr>
                                <th>Number of Appointments Remaining:</th>
                                <td>' . $remainingnop . '</td>
                            </tr>
                        </table>
                        <div class="button-container">
                            <a href="schedule.php" class="btn btn-primary-soft">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        
            <style>
                /* Modal Overlay */
                .overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.7);
                    z-index: 1000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
        
                /* Modal Content */
                .popup {
                    background: #fff;
                    border-radius: 10px;
                    padding: 20px;
                    width: 90%;
                    max-width: 600px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
                    position: relative;
                }
        
                /* Close Button */
                .close {
                    position: absolute;
                    top: 15px;
                    right: 20px;
                    font-size: 30px;
                    text-decoration: none;
                    color: #333;
                }
        
                /* Modal Header */
                .content h2 {
                    margin-top: 0;
                    color: #333;
                    text-align: center;
                    font-size: 28px;
                }
        
                /* Styled Table */
                .styled-table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                }
        
                .styled-table th, .styled-table td {
                    text-align: left;
                    padding: 12px 15px;
                    border-bottom: 1px solid #ddd;
                }
        
                .styled-table th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
        
                .styled-table tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
        
                /* Button Container */
                .button-container {
                    text-align: center;
                    margin-top: 20px;
                }
        
                /* Primary Button */
                .btn-primary-soft {
                    background-color: #008080;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 16px;
                    transition: background-color 0.3s;
                }
        
            </style>
    ';
        }
    }
    ?>
    <script>
        // Store the service data as a JavaScript object
        const serviceData = <?php echo json_encode($service_data); ?>;

        function updateCosts(serviceName) {
            const serviceCost = serviceData[serviceName];
            const initialPayment = serviceCost * 0.3;
            const remainingPayment = serviceCost * 0.7;
            const totalPayment = serviceCost * 1.0;

            document.getElementById("initial_payment").value = initialPayment.toFixed(2);
            document.getElementById("remaining_payment").value = remainingPayment.toFixed(2);
            document.getElementById("cost").value = totalPayment.toFixed(2);
        }

    </script>


    </div>
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>