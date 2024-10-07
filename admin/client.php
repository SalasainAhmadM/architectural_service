<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Clients</title>
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
                        <a href="appointment.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Appointments</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="client.php" class="menu-link-active">
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

                        <a href="client.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>

                    </td>
                    <td>

                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar"
                                placeholder="Search Client name or Email" list="client">&nbsp;&nbsp;

                            <?php
                            echo '<datalist id="client">';
                            $list11 = $database->query("select  client_name,client_email from client;");

                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["client_name"];
                                $c = $row00["client_email"];
                                echo "<option value='$d'><br/>";
                                echo "<option value='$c'><br/>";
                            }
                            ;

                            echo ' </datalist>';
                            ?>


                            <input type="Submit" value="Search" class="login-btn btn-primary btn"
                                style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                        </form>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Manila');

                            $date = date('Y-m-d');
                            echo $date;
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
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All
                            Clients (<?php echo $list11->num_rows; ?>)</p>
                    </td>

                </tr>
                <?php
                if ($_POST) {
                    $keyword = $_POST["search"];

                    $sqlmain = "select * from client where client_email='$keyword' or client_name='$keyword' or client_name like '$keyword%' or client_name like '%$keyword' or client_name like '%$keyword%' ";
                } else {
                    $sqlmain = "select * from client order by client_id desc";

                }



                ?>

                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">


                                                Name

                                            </th>
                                            <th class="table-headin">


                                                Contact Number

                                            </th>
                                            <th class="table-headin">
                                                Email
                                            </th>
                                            <th class="table-headin">

                                                Date of Birth

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
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="client.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Clients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $client_id = $row["client_id"];
                                                $name = $row["client_name"];
                                                $email = $row["client_email"];
                                                $dob = date("M d, Y", strtotime($row["client_dob"]));
                                                $tel = $row["client_tel"];

                                                echo '<tr>
                                        <td> &nbsp;' .
                                                    substr($name, 0, 35)
                                                    . '</td>
                                        
                                        <td>
                                            ' . substr($tel, 0, 10) . '
                                        </td>
                                        <td>
                                        ' . substr($email, 0, 20) . '
                                         </td>
                                        <td>
                                        ' . $dob . '
                                        </td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id=' . $client_id . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon "  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text"><i style="margin-right: 4px"class="fa-regular fa-eye"></i>View</font></button></a>
                                       
                                        </div>
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
        $sqlmain = "select * from client where client_id='$id'";
        $result = $database->query($sqlmain);
        $row = $result->fetch_assoc();
        $name = $row["client_name"];
        $image = $row["client_image"];
        $email = $row["client_email"];
        $dob = $row["client_dob"];
        $tele = $row["client_tel"];
        $address = $row["client_address"];
        echo '
            <div id="popup1" class="overlay">
    <div class="popup">
        <a class="close" href="client.php">&times;</a>
        <div class="content">
            <h2>Client Details</h2>
            <div style="display: flex; justify-content: center;">
                <table class="styled-table">
                    <tr>
                        <th>Client ID:</th>
                        <td>C-' . $id . '</td>
                    </tr>
                    <tr>
                        <th>Profile:</th>
                        <td>
                            <img src="' . $image . '" alt="Profile Image" style="height: 100px; width: 100px; border-radius: 50%; object-fit: cover;">
                        </td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>' . $name . '</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>' . $email . '</td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                        <td>' . $tele . '</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>' . $address . '</td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>' . $dob . '</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <a href="client.php" class="btn btn-primary-soft">OK</a>
                        </td>
                    </tr>
                </table>
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
            width: 40%;
        }

        .styled-table td {
            background-color: #fff;
        }

        /* Centered Profile Image */
        img[alt="Profile Image"] {
            display: block;
            margin: 0 auto;
        }

        /* Button Design */
        .btn-primary-soft {
            background-color: #008080;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
            display: inline-block;
        }

    </style>
</div>
            ';

    }
    ;

    ?>
    </div>
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>