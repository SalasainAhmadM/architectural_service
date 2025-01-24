<?php
session_start();
include("../connection.php");

// Redirect if session is not set or user type is incorrect
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'p') {
    header("location: ../login.php");
    exit();
}

$useremail = $_SESSION["user"];

// Fetch user details
$userrow = $database->query("select * from client where client_email='$useremail'");
if ($userrow->num_rows > 0) {
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["client_id"];
    $username = $userfetch["client_name"];
    $client_image = $userfetch["client_image"];
} else {
    header("location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_changes"])) {
    $client_name = $_POST["client_name"];
    $client_email = $_POST["client_email"];
    $client_tel = $_POST["client_tel"];
    $client_pass = $_POST["client_password"];
    $client_address = $_POST["client_address"];
    $client_dob = $_POST["client_dob"];

    $updatequery = "UPDATE client SET client_name='$client_name', client_email='$client_email', client_tel='$client_tel', client_password='$client_pass', client_address='$client_address', client_dob='$client_dob'";

    if (!empty($_FILES['client_image']['name'])) {
        $client_image = $_FILES['client_image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($client_image);

        if (move_uploaded_file($_FILES['client_image']['tmp_name'], $target_file)) {
            $updatequery .= ", client_image='$target_file'";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    $updatequery .= " WHERE client_id='$userid'";
    if ($database->query($updatequery) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('successModal').style.display = 'block';
        });
        </script>";
    }
}

$result = $database->query("select * from client where client_id='$userid'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $client_name = $row["client_name"];
    $client_email = $row["client_email"];
    $client_tel = $row["client_tel"];
    $client_pass = $row["client_password"];
    $client_address = $row["client_address"];
    $client_dob = $row["client_dob"];
    $client_image = $row["client_image"];
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
        .client_tect-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .client_tect-heade {
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
                                    <img src="<?php echo !empty($client_image) ? $client_image : '../img/user.png'; ?>"
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
                        <a href="feedback.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <p>Feedback</p>
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
                        <a href="settings.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0;">
                <tr>
                    <td width="13%">
                        <a href="index.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td></td>
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
                        <button class="btn-label" style="display: flex; justify-content: center; align-items: center;">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%" class="sub-table scrolldown add-doc-form-container"
                            style="padding: 50px; border: none">
                            <tr>
                                <td class="label-td" colspan="2">
                                    <p style="font-size: 25px; font-weight: 600;">Settings</p>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <form action="settings.php" method="post" enctype="multipart/form-data">
                                        <label for="client_name" class="form-label">Name: </label>
                                        <input type="text" name="client_name" class="input-text"
                                            value="<?php echo $client_name ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_email" class="form-label">Email: </label>
                                    <input type="email" name="client_email" class="input-text"
                                        value="<?php echo $client_email ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_tel" class="form-label">Contact Number: </label>
                                    <input type="tel" name="client_tel" class="input-text"
                                        value="<?php echo $client_tel ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_address" class="form-label">Address: </label>
                                    <input type="text" name="client_address" class="input-text"
                                        value="<?php echo $client_address ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_dob" class="form-label">Date of Birth: </label>
                                    <input type="date" name="client_dob" class="input-text"
                                        value="<?php echo $client_dob ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_password" class="form-label">Password: </label>
                                    <input type="password" name="client_password" class="input-text"
                                        value="<?php echo $client_pass ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="client_image" class="form-label">Upload Image: </label>
                                    <input type="file" name="client_image" class="input-text">
                                    <img id="preview" src="<?php echo $client_image; ?>" alt="Client Image"
                                        style="max-width: 200px; margin-top: 20px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="submit" value="Save Changes" name="save_changes"
                                        class="btn-primary btn">
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
                                document.querySelector('input[name="client_image"]').addEventListener('change', function (event) {
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