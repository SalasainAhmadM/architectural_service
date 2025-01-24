<?php
// Learn from w3schools.com

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

// Import database
include("../connection.php");

$sqlmain = "select * from client where client_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();
$userfetch = $result->fetch_assoc(); // Change $userrow to $userfetch
$userid = $userfetch["client_id"];
$username = $userfetch["client_name"];
$client_image = $userfetch["client_image"];

// echo $userid;
// echo $username;

date_default_timezone_set('Asia/Manila');

$today = date('Y-m-d');

// echo $userid;
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

    <title>Sessions</title>
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
            <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0; margin-top: 25px;">
                <tr>
                    <td width="13%">
                        <a href="appointment.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <!-- <form action="schedule.php" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar"
                                placeholder="Search architect name or Email or Date (YYYY-MM-DD)" list="architects">
                            &nbsp;&nbsp;
                            <?php
                            echo '<datalist id="architects">';
                            $list11 = $database->query("select DISTINCT * from architect;");
                            $list12 = $database->query("select DISTINCT * from schedule GROUP BY title;");

                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["archiname"];
                                echo "<option value='$d'><br/>";
                            }

                            for ($y = 0; $y < $list12->num_rows; $y++) {
                                $row00 = $list12->fetch_assoc();
                                $d = $row00["title"];
                                echo "<option value='$d'><br/>";
                            }

                            echo ' </datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn"
                                style="padding-left: 25px; padding-right: 25px; padding-top: 10px; padding-bottom: 10px;">
                        </form> -->
                    </td>
                    <td width="15%">
                        <p
                            style="font-size: 14px; color: rgb(119, 119, 119); padding: 0; margin: 0; text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0; margin: 0;">
                            <?php
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
                    <td colspan="4" style="padding-top: 10px; width: 100%;">
                        <!-- <p class="heading-main12" style="margin-left: 45px; font-size: 18px; color: rgb(49, 49, 49); font-weight: 400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="100%" class="sub-table scrolldown" border="0"
                                    style="padding: 50px; border: none">
                                    <tbody>
                                        <?php
                                        if ($_GET && isset($_GET["id"])) {
                                            $id = $_GET["id"];

                                            // Initialize payment status
                                            $pay_status = 'Not Paid';

                                            // Check if payment was successful
                                            if (isset($_GET['payment']) && $_GET['payment'] === 'success') {
                                                $pay_status = 'Pay Remaining Payment Now';

                                                // Update the payment status in the database
                                                $sqlUpdatePayment = "UPDATE appointment SET pay_status = ? WHERE scheduleid = ? AND client_id = ?";
                                                $stmtUpdate = $database->prepare($sqlUpdatePayment);
                                                $stmtUpdate->bind_param("sii", $pay_status, $id, $userid);
                                                if ($stmtUpdate->execute()) {
                                                    echo '<script>document.getElementById("success-modal").style.display = "block";</script>';
                                                } else {
                                                    echo '<div class="alert alert-danger">Error updating payment status: ' . $stmtUpdate->error . '</div>';
                                                }
                                            }

                                            // Fetch schedule details
                                            $sqlmain = "SELECT * FROM schedule 
                                                    INNER JOIN architect ON schedule.archiid = architect.archiid 
                                                    WHERE schedule.scheduleid = ? 
                                                    ORDER BY schedule.scheduledate DESC";
                                            $stmt = $database->prepare($sqlmain);
                                            $stmt->bind_param("i", $id);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $row = $result->fetch_assoc();

                                            // Retrieve schedule details
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $archiname = $row["archiname"];
                                            $archiemail = $row["archiemail"];
                                            $scheduledate = date("M d, Y", strtotime($row["scheduledate"]));
                                            $scheduletime = date("g:ia", strtotime($row["scheduletime"]));
                                            $cost = $row["cost"];
                                            $nop = $row["nop"]; // Number of participants allowed
                                        
                                            // Count current number of appointments
                                            $sql2 = "SELECT COUNT(*) AS total_appointments FROM appointment WHERE scheduleid = ?";
                                            $stmt2 = $database->prepare($sql2);
                                            $stmt2->bind_param("i", $scheduleid);
                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            $data = $result2->fetch_assoc();
                                            $current_appointments = $data['total_appointments'];

                                            // Calculate appointment number
                                            $apponum = $current_appointments + 1;

                                            if ($current_appointments < $nop) {
                                                $initial_fee = $cost * 0.3;
                                                $formatted_fee = $initial_fee;

                                                echo '
                                                <form id="booking-form" action="booking-complete.php" method="post" onsubmit="return validateBooking();">
                                                    <input type="hidden" name="scheduleid" value="' . $scheduleid . '">
                                                    <input type="hidden" name="apponum" value="' . $apponum . '">
                                                    <input type="hidden" name="date" value="' . $today . '">
                                                    <input type="hidden" id="payment-status" value="' . $pay_status . '">
                                                    <td style="width: 50%;" rowspan="2">
                                                        <div class="dashboard-items search-items">
                                                            <div style="width:100%">
                                                                <div class="h1-search" style="font-size:25px;">
                                                                  Session Details
                                                                </div><br><br>
                                                                <div class="h3-search" style="font-size:18px;line-height:30px">
                                                                 Architect name: &nbsp;&nbsp;<b>' . $archiname . '</b><br>
                                                                 Architect Email: &nbsp;&nbsp;<b>' . $archiemail . '</b>
                                                                </div><br>
                                                                <div class="h3-search" style="font-size:18px;">
                                                                 Session Title: ' . $title . '<br>
                                                                 Session Scheduled Date: ' . $scheduledate . '<br>
                                                                 Session Starts: ' . $scheduletime . '<br>
                                                                 Initial fee: <b>₱' . $formatted_fee . '</b>
                                                                </div>
                                                                <br>';

                                                if ($pay_status === 'Pay Remaining Payment Now') {
                                                    echo '<div class="alert alert-success" role="alert">Initial Payment Successful!</div>';
                                                } else {
                                                    echo '<div id="paypal-button-container">
                                                    <button type="button" class="btn btn-primary" onclick="redirectToPayPal()"><i class="fa-brands fa-paypal"></i>Pay with PayPal</button>
                                                  </div>';
                                                }

                                                echo '
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items search-items">
                                                        <div style="width:100%; padding-top: 15px; padding-bottom: 15px;">
                                                            <div class="h1-search" style="font-size:20px; line-height: 35px; margin-left:8px; text-align:center;">
                                                                Your Appointment Number
                                                            </div>
                                                            <center>
                                                                <div class="dashboard-icons" style="margin-left: 0px; width:90%; font-size:70px; font-weight:800; text-align:center; color:var(--btnnictext); background-color: var(--btnice)">
                                                                    ' . $apponum . '
                                                                </div>
                                                            </center>
                                                        </div><br>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- Book Now Button -->
                                                    <input type="submit" id="book-now-button" class="login-btn btn-primary btn btn-book" 
                                                    style="margin-left:10px; padding-left: 25px; padding-right: 25px; padding-top: 10px; padding-bottom: 10px; width:95%; text-align: center;" 
                                                    value="Book now" name="booknow">
                                                </form>
                                                </td>
                                            </tr>';
                                            } else {
                                                echo '
                                            <tr>
                                                <td colspan="2" style="text-align:center;">
                                                    <div class="dashboard-items search-items">
                                                        <div style="width:100%; padding-top: 15px; padding-bottom: 15px;">
                                                            <div class="h1-search" style="font-size:20px; line-height: 35px; margin-left:8px; text-align:center;">
                                                                Booking Full
                                                            </div>
                                                            <center>
                                                                <div class="dashboard-icons" style="margin-left: 0px; width:90%; font-size:70px; font-weight:800; text-align:center; color:red;">
                                                                    No more slots available.
                                                                </div>
                                                            </center>
                                                        </div><br>
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
    <script>
        function redirectToPayPal() {
            window.location.href = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sb-daa2k32419423@business.example.com&item_name=<?php echo urlencode($title); ?>&amount=<?php echo $formatted_fee; ?>&currency_code=PHP&return=<?php echo urlencode("http://localhost/architectural_service/client/booking.php?id=" . $scheduleid . "&payment=success"); ?>&cancel_return=<?php echo urlencode("http://localhost/architectural_service/client/booking.php?id=" . $scheduleid . "&payment=failed"); ?>";
        }

        function validateBooking() {
            var paymentStatus = document.getElementById('payment-status').value;
            if (paymentStatus !== 'Pay Remaining Payment Now') {
                alert('Please complete the initial payment before booking.');
                return false;
            }
            return true;
        }
        function closeModal() {
            document.getElementById('success-modal').style.display = 'none';
        }
    </script>

    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>