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
    include ("../connection.php");


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
                        <a href="index.php" class="menu-link">
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
                        <a href="appointment.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Appointments</p>
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>

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

                            $list110 = $database->query("select  * from  appointment;");

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

                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All
                            Appointments (<?php echo $list110->num_rows; ?>)</p>
                    </td>

                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;">
                        <center>
                            <table class="filter-container" border="0">
                                <tr>
                                    <!-- <td width="10%">

                                    </td>
                                    <td width="5%" style="text-align: center;">
                                        Date:
                                    </td>
                                    <td width="30%">
                                        <form action="" method="post">

                                            <input type="date" name="sheduledate" id="date"
                                                class="input-text filter-container-items" style="margin: 0;width: 95%;">

                                    </td>
                                    <td width="5%" style="text-align: center;">
                                        architect:
                                    </td> -->
                                    <!-- <td width="30%">
                                        <select name="archiid" id="" class="box filter-container-items"
                                            style="width:90% ;height: 37px;margin: 0;">
                                            <option value="" disabled selected hidden>Choose architect Name from the
                                                list
                                            </option><br />

                                            <?php

                                            $list11 = $database->query("select  * from  architect order by archiname asc;");

                                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                                $row00 = $list11->fetch_assoc();
                                                $sn = $row00["archiname"];
                                                $id00 = $row00["archiid"];
                                                echo "<option value=" . $id00 . ">$sn</option><br/>";
                                            }
                                            ;


                                            ?>

                                        </select>
                                    </td>
                                    <td width="12%">
                                        <input type="submit" name="filter" value=" Filter"
                                            class=" btn-primary-soft btn button-icon btn-filter"
                                            style="padding: 15px; margin :0;width:100%">
                                        </form>
                                    </td> -->

                                </tr>
                            </table>

                        </center>
                    </td>

                </tr>

                <?php
                if ($_POST) {
                    //print_r($_POST);
                    $sqlpt1 = "";
                    if (!empty($_POST["sheduledate"])) {
                        $sheduledate = $_POST["sheduledate"];
                        $sqlpt1 = " schedule.scheduledate='$sheduledate' ";
                    }


                    $sqlpt2 = "";
                    if (!empty($_POST["archiid"])) {
                        $archiid = $_POST["archiid"];
                        $sqlpt2 = " architect.archiid=$archiid ";
                    }
                    //echo $sqlpt2;
                    //echo $sqlpt1;
                    $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,architect.archiname,client.client_name,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid";
                    $sqllist = array($sqlpt1, $sqlpt2);
                    $sqlkeywords = array(" where ", " and ");
                    $key2 = 0;
                    foreach ($sqllist as $key) {

                        if (!empty($key)) {
                            $sqlmain .= $sqlkeywords[$key2] . $key;
                            $key2++;
                        }
                        ;
                    }
                    ;
                    //echo $sqlmain;
                


                    //
                } else {
                    $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,architect.archiname,client.client_name,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid  order by schedule.scheduledate desc";

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
                                                Client name
                                            </th>
                                            <th class="table-headin">

                                                Appointment Number

                                            </th>


                                            <th class="table-headin">
                                                Architect
                                            </th>
                                            <th class="table-headin">


                                                Session Title

                                            </th>

                                            <th class="table-headin" style="font-size:10px">

                                                Session Date & Time

                                            </th>

                                            <th class="table-headin">

                                                Appointment Date

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
                                    <td colspan="7">
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
                                                $appodate = date("M d, Y", strtotime($row["appodate"]));

                                                echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;' .

                                                    substr($client_name, 0, 25)
                                                    . '</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color:#008080;">
                                        ' . $apponum . '
                                        
                                        </td>
                                        <td>
                                        ' . substr($archiname, 0, 25) . '
                                        </td>
                                        <td>
                                        ' . substr($title, 0, 15) . '
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            ' . $scheduledate . ' <br>' . $scheduletime . '
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            ' . $appodate . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <!--<a href="?action=view&id=' . $appoid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;-->
                                       <a href="?action=drop&id=' . $appoid . '&name=' . $client_name . '&session=' . $title . '&apponum=' . $apponum . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon "  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text"><i style="margin-right: 4px"class="fa-solid fa-xmark"></i>Cancel</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
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
                                <td class="label-td" colspan="2">' .
                ""

                . '</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title" class="form-label">Session Title : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="archiid" class="form-label">Select Architect: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="archiid" id="" class="box" >
                                    <option value="" disabled selected hidden>Choose architect Name from the list</option><br/>';


            $list11 = $database->query("select  * from  architect;");

            for ($y = 0; $y < $list11->num_rows; $y++) {
                $row00 = $list11->fetch_assoc();
                $sn = $row00["archiname"];
                $id00 = $row00["archiid"];
                echo "<option value=" . $id00 . ">$sn</option><br/>";
            }
            ;




            echo '       </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Number of Clients/Appointment Numbers : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0"  placeholder="The final appointment number for this session depends on this number" required><br>
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
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
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
                        
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'drop') {
            $nameget = $_GET["name"];
            $session = $_GET["session"];
            $apponum = $_GET["apponum"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Client Name: &nbsp;<b>' . substr($nameget, 0, 40) . '</b><br>
                            Appointment number &nbsp; : <b>' . substr($apponum, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from architect where archiid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["archiname"];
            $email = $row["archiemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $tele = $row['architel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="architects.php">&times;</a>
                        <div class="content">
                            earchi Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-archi-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Contact Number: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="architects.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }
    }

    ?>
    </div>
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>