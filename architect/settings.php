<?php
session_start();
include("../connection.php");

// Redirect if session is not set or user type is incorrect
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'd') {
    header("location: ../login.php");
    exit();
}

$useremail = $_SESSION["user"];

// Fetch user details
$userrow = $database->query("SELECT * FROM architect WHERE archiemail='$useremail'");
if ($userrow->num_rows > 0) {
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["archiid"];
    $username = $userfetch["archiname"];
    $useraddress = $userfetch["archiaddress"];
    $archi_image = $userfetch["archi_image"];
    $fb_link = $userfetch["fb_link"];
    $ig_link = $userfetch["ig_link"];
    $twitter_link = $userfetch["twitter_link"];
    $linkedin_link = $userfetch["linkedin_link"];
} else {
    header("location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_changes"])) {
    $archiname = $_POST["archiname"];
    $archiemail = $_POST["archiemail"];
    $architel = $_POST["architel"];
    $archiaddress = $_POST["archiaddress"];
    $archipass = $_POST["archipassword"];
    $fb_link = $_POST["fb_link"];
    $ig_link = $_POST["ig_link"];
    $twitter_link = $_POST["twitter_link"];
    $linkedin_link = $_POST["linkedin_link"];

    $updatequery = "UPDATE architect SET 
                    archiname='$archiname', 
                    archiemail='$archiemail', 
                    architel='$architel', 
                    archiaddress='$archiaddress',
                    archipassword='$archipass',
                    fb_link='$fb_link',
                    ig_link='$ig_link',
                    twitter_link='$twitter_link',
                    linkedin_link='$linkedin_link'";

    if (!empty($_FILES['archi_image']['name'])) {
        $archi_image = $_FILES['archi_image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($archi_image);

        if (move_uploaded_file($_FILES['archi_image']['tmp_name'], $target_file)) {
            $updatequery .= ", archi_image='$target_file'";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    $updatequery .= " WHERE archiid='$userid'";
    if ($database->query($updatequery) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('successModal').style.display = 'block';
        });
        </script>";
    }
}

$result = $database->query("SELECT * FROM architect WHERE archiid='$userid'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $archiname = $row["archiname"];
    $archiemail = $row["archiemail"];
    $architel = $row["architel"];
    $archiaddress = $row["archiaddress"];
    $archipass = $row["archipassword"];
    $archi_image = $row["archi_image"];
    $fb_link = $row["fb_link"];
    $ig_link = $row["ig_link"];
    $twitter_link = $row["twitter_link"];
    $linkedin_link = $row["linkedin_link"];
}
?>

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
    <title>Settings</title>
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

        .dashboard-items {
            border: 2px solid #008080;
            color: #008080;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 300px;
            text-align: center;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content p {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }

        .modal-content button {
            background-color: #008080;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-content button:hover {
            background-color: #006666;
        }

        .input-text {
            width: 400px;
        }

        .social-icons a {
            margin: 0 10px;
            color: #008080;
            font-size: 24px;
        }

        .social-icons a:hover {
            color: #005050;
        }
    </style>
    </style>
    </style>
</head>

<body>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding: 10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left: 20px">
                                    <img src="<?php echo !empty($archi_image) ? $archi_image : '../img/user.png'; ?>"
                                        alt="" width="100%" style="border-radius: 50%">
                                </td>
                                <td style="padding: 0px; margin: 0px;">
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
                                <p>Appointments</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="schedule.php" class="menu-link">
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
                        <a href="settings.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </div>
                    </td>
                </tr>
                </tr>
            </table>
        </div>
        <style>
            .navbar {
                display: flex;
                justify-content: left;
                padding: 10px 0;
            }

            .navbar a {
                text-decoration: none;
                color: #333;
                padding: 10px 15px;
                margin: 0 5px;
                font-size: 16px;
                transition: color 0.3s, background-color 0.3s;
                border-radius: 5px;
            }

            .navbar a:hover {
                color: #fff;
                background-color: #008080;
            }

            .navbar a.active {
                color: #fff;
                background-color: #008080;
            }
        </style>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0;">
                <tr>
                    <td width="13%">
                        <a href="settings.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <!-- <td>
                        <p style="font-size: 25px; font-weight: 600; margin-left: 20px;">Settings</p>
                    </td> -->
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
                        <button class="btn-label" style="display: flex; justify-content: center; align-items: center;">
                            <img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>

        </div>
        <tr>
            <td colspan="4">
                <table border="0" width="100%" class="sub-table scrolldown add-doc-form-container"
                    style="padding: 50px; border: none">
                    <tr>
                        <td class="label-td" colspan="2">
                            <nav style="margin-top: -55px" class="navbar">
                                <a href="settings.php" class="active">Settings</a>
                                <a href="aboutus.php">About Us</a>
                                <a href="chooseus.php">Choose Us</a>
                                <a href="carousel.php">Carousel</a>
                            </nav>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <form action="settings.php" method="post" enctype="multipart/form-data">
                                <label for="archiname" class="form-label">Name: </label>
                                <input type="text" name="archiname" class="input-text" value="<?php echo $archiname ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="archiemail" class="form-label">Email: </label>
                            <input type="email" name="archiemail" class="input-text" value="<?php echo $archiemail ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="fb_link" class="form-label">Facebook Link: </label>
                            <input type="url" name="fb_link" class="input-text" value="<?php echo $fb_link ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="ig_link" class="form-label">Instagram Link: </label>
                            <input type="url" name="ig_link" class="input-text" value="<?php echo $ig_link ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="twitter_link" class="form-label">Twitter Link: </label>
                            <input type="url" name="twitter_link" class="input-text"
                                value="<?php echo $twitter_link ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="linkedin_link" class="form-label">LinkedIn Link: </label>
                            <input type="url" name="linkedin_link" class="input-text"
                                value="<?php echo $linkedin_link ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="architel" class="form-label">Contact Number: </label>
                            <input type="tel" name="architel" class="input-text" value="<?php echo $architel ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="archiaddress" class="form-label">Address: </label>
                            <input type="text" name="archiaddress" class="input-text"
                                value="<?php echo $archiaddress ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="archipassword" class="form-label">Password: </label>
                            <input type="password" name="archipassword" class="input-text"
                                value="<?php echo $archipass ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="archi_image" class="form-label">Upload Image: </label>
                            <input type="file" name="archi_image" class="input-text">
                            <img id="preview"
                                src="<?php echo !empty($archi_image) ? $archi_image : '../img/user.png'; ?>"
                                alt="Architect Image" style="max-width: 200px; margin-top: 20px;">
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="submit" value="Save Changes" name="save_changes" class="btn-primary btn">
                        </td>
                    </tr>
            </td>
        </tr>
        </form>
        <div id="successModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Updated Successfully!</p>
                <button onclick="closeModal()">OK</button>
            </div>
        </div>
        <script>
            document.querySelector('input[name="archi_image"]').addEventListener('change', function (event) {
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            });

            // Modal handling
            var modal = document.getElementById("successModal");
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function () {
                modal.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            function closeModal() {
                modal.style.display = "none";
            }
        </script>

        <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>