<?php


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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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

        .table-headin {
            border-bottom: 3px solid #008080;
        }

        .btn-cancel,
        .btn-send {
            background-color: #008080;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .sub-table td {
            text-align: center;
        }

        .btn-cancel:hover,
        .btn-send:hover {
            background-color: #008585;
        }

        .status-dropdown {
            padding: 5px;
            font-size: 16px;
            font-weight: 500;
            color: #008080;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            width: 150px;
            text-align: center;
        }

        .status-dropdown:focus {
            border-color: #008080;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 128, 128, 0.5);
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
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s;
        }

        .modal-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #008080;
        }

        .modal-content label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            background-color: #008080;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .modal-content button:hover {
            background-color: #006666;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
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
                        <a href="appointment.php" class="menu-link-active">
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
                        <a href="appointment.php">
                            <button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button>
                        </a>
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
                            $list110 = $database->query("select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join client on client.client_id=appointment.client_id inner join architect on schedule.archiid=architect.archiid  where  architect.archiid=$userid ");
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
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My
                            Appointments (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;">
                        <center>
                            <table class="filter-container" border="0">
                                <tr>
                                    <td width="10%"></td>
                                    <td width="5%" style="text-align: center;">Date:</td>
                                    <td width="30%">
                                        <form action="" method="post">
                                            <input type="date" name="sheduledate" id="date"
                                                class="input-text filter-container-items" style="margin: 0;width: 95%;">
                                    </td>
                                    <td width="12%">
                                        <button
                                            style="background-color: #008080; border: 1px solid #008080; color: white; 
                                            border-radius: 4px; height: 50%; width: 70%; font-size: 14px; padding: 6px;"
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
                $sqlmain = "SELECT appointment.appoid, schedule.scheduleid, schedule.cost, schedule.title, appointment.status,appointment.project_sent, appointment.pay_status, architect.archiid, architect.archiname, client.client_id, client.client_name, schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate, finished_project.project_enddate,finished_project.project_description, finished_project.project_id, finished_project.project_image 
            FROM schedule 
            INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid 
            INNER JOIN client ON client.client_id = appointment.client_id 
            LEFT JOIN finished_project ON appointment.appoid = finished_project.project_id 
            INNER JOIN architect ON schedule.archiid = architect.archiid  
            WHERE architect.archiid = $userid";

                if ($_POST) {
                    if (!empty($_POST["sheduledate"])) {
                        $sheduledate = $_POST["sheduledate"];
                        $sqlmain .= " AND schedule.scheduledate = '$sheduledate'";
                    }
                }

                $result = $database->query($sqlmain);
                ?>

                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Client name</th>
                                            <th class="table-headin">Appointment number</th>
                                            <th class="table-headin">Session Title</th>
                                            <!-- <th class="table-headin">Session Date & Time</th> -->
                                            <th class="table-headin">Appointment Date</th>
                                            <th class="table-headin">Balance</th>
                                            <th class="table-headin">Status</th>
                                            <th class="table-headin">Payment</th>
                                            <th class="table-headin">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $scheduledDate = new DateTime($row["scheduledate"]);
                                                $scheduledDateFormatted = $scheduledDate->format('M d, Y');

                                                $scheduledTime = new DateTime($row["scheduletime"]);
                                                $scheduledTimeFormatted = $scheduledTime->format('h:i A');

                                                // Format the appointment date
                                                $appodate = new DateTime($row["appodate"]);
                                                $appodateFormatted = $appodate->format('M d, Y');

                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row["client_name"]) . "</td>";
                                                echo "<td style='text-align:center;font-size:23px;font-weight:500; color:#008080;'>" . htmlspecialchars($row["apponum"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                                                // echo "<td>" . $scheduledDateFormatted . " @ " . $scheduledTimeFormatted . "</td>";
                                                echo "<td>" . $appodateFormatted . "</td>";
                                                echo "<td>₱" . htmlspecialchars($row["cost"] * 0.7) . "</td>";

                                                // Dropdown for status
                                                echo "<td>";
                                                echo '<form method="POST" action="update-status.php">';
                                                echo '<input type="hidden" name="appoid" value="' . htmlspecialchars($row["appoid"]) . '">';
                                                echo '<select name="status" class="status-dropdown" onchange="this.form.submit()">';
                                                $statuses = ["Initiation", "Started", "Finalizing", "Finished"];
                                                foreach ($statuses as $status) {
                                                    $selected = ($row["status"] === $status) ? "selected" : "";
                                                    echo "<option value='$status' $selected>$status</option>";
                                                }
                                                echo '</select>';
                                                $pay_status = htmlspecialchars($row["pay_status"]);
                                                if ($pay_status === "Pay Remaining Payment Now") {
                                                    $pay_status = "Initial Payment Paid";
                                                }
                                                if ($pay_status === "Fully Paid") {
                                                    $pay_status = " Fully Paid ✅";
                                                }
                                                echo "<td>" . $pay_status . "</td>";
                                                echo '</form>';
                                                echo "</td>";

                                                echo "<td>";
                                                if ($row["status"] === "Finished" && $row["pay_status"] === "Fully Paid") {

                                                    echo '<button type="button" class="btn-cancel" style="font-size: 16px; padding: 10px 5px;" onclick="openModal(\'' . htmlspecialchars($row["title"]) . '\', \'' . htmlspecialchars($row["client_name"]) . '\', \'' . htmlspecialchars($row["cost"]) . '\', \'' . htmlspecialchars($row["archiid"]) . '\',\'' . htmlspecialchars($row["appodate"]) . '\', \'' . htmlspecialchars($row["client_id"]) . '\', \'' . htmlspecialchars($row["appoid"]) . '\' )">';
                                                    echo '<i style="margin-right: 2px" class="fa-solid fa-paper-plane"></i> Send and Add to Portfolio';
                                                    echo '</button>';

                                                } else {
                                                    // Show the "Cancel" button as before
                                                    echo '<form method="POST" action="delete-appointment.php" onsubmit="return confirm(\'Are you sure you want to delete this appointment?\');">';
                                                    echo '<input type="hidden" name="appoid" value="' . htmlspecialchars($row["appoid"]) . '">';
                                                    echo '<button style="font-size: 16px; padding: 10px 5px;" type="submit" class="btn-cancel"><i style="margin-right: 2px" class="fa-solid fa-xmark"></i> Cancel</button>';
                                                    echo '</form>';
                                                }
                                                echo "</td>";


                                                echo "</tr>";
                                            }
                                        } else {
                                            echo '<tr>
<td colspan="7">
<br><br><br><br>
<center>
<img src="../img/empty.png" width="25%">
<br>
<p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
<a class="non-style-link" href="appointment.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</button></a>
</center>
<br><br><br><br>
</td>
</tr>';
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
    <!-- Modal Structure -->
    <div id="send-project-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2>Send Project and Add to Portfolio</h2>
            <form action="send_project.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="archiid" name="archiid">
                <input type="hidden" id="client_id" name="client_id">
                <input type="hidden" id="appoid" name="appoid">
                <label for="project_name">Project Name:</label>
                <input type="text" id="project_name" name="project_name" required>
                <label for="project_image">Project Image:</label>
                <input type="file" id="project_image" name="project_image" accept="image/*" required>
                <label for="project_description">Description:</label>
                <textarea id="project_description" name="project_description" required></textarea>
                <label for="project_client">Client Name:</label>
                <input type="text" id="project_client" name="project_client" required>
                <label for="project_cost">Project Cost:</label>
                <input type="number" id="project_cost" name="project_cost" step="0.01" min="0" placeholder="0.00"
                    required>
                <label for="project_startdate">Started Date:</label>
                <input type="date" id="project_startdate" name="project_startdate" required>
                <label for="project_enddate">Finished Date:</label>
                <input type="date" id="project_enddate" name="project_enddate" required>
                <button type="submit" class="btn btn-primary">Send Project</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Success!</h2>
            <p id="success-message"></p>
        </div>
    </div>
    <!-- Add Project Modal -->
    <div id="add-project-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeAddModal()">&times;</span>
            <h2>Add To Portfolio</h2>
            <form action="add_newportfolio.php" method="post" enctype="multipart/form-data">
                <input type="number" id="modal_archiid" name="archiid">
                <input type="number" id="modal_apponum" name="apponum">
                <input type="number" id="modal_appoid" name="appoid">
                <input type="number" id="project_id" name="archiid">
                <input type="number" id="modal_client_id" name="client_id">
                <input type="hidden" id="current_image" name="current_image"> <!-- Store current image name -->
                <label for="portfolio_project_name">Project Name:</label>
                <input type="text" id="portfolio_project_name" name="project_name" required>
                <label for="portfolio_project_image">Project Image:</label>
                <input type="hidden" id="portfolio_project_image" name="project_image" accept="image/*">
                <img id="portfolio_project_image_preview" style="display: none; max-width: 100px; max-height: 100px;">
                <label for="portfolio_project_description">Description:</label>
                <textarea id="portfolio_project_description" name="project_description" required></textarea>
                <label for="portfolio_project_client">Client Name:</label>
                <input type="text" id="portfolio_project_client" name="project_client" required>
                <label for="portfolio_project_cost">Project Cost:</label>
                <input type="number" id="portfolio_project_cost" name="project_cost" step="0.01" min="0"
                    placeholder="0.00" required>
                <label for="portfolio_project_startdate">Started Date:</label>
                <input type="date" id="portfolio_project_startdate" name="project_startdate" required>
                <label for="portfolio_project_enddate">Finished Date:</label>
                <input type="date" id="portfolio_project_enddate" name="project_enddate" required>
                <button type="submit" class="btn btn-primary">Add Project</button>
            </form>

        </div>
    </div>



    <script>
        function openModal(projectName, clientName, projectCost, archiid, appodate, client_id, appoid) {
            document.getElementById('project_name').value = projectName;
            document.getElementById('project_client').value = clientName;
            document.getElementById('project_cost').value = projectCost;
            document.getElementById('archiid').value = archiid;
            document.getElementById('client_id').value = client_id;
            document.getElementById('appoid').value = appoid;
            document.getElementById('project_startdate').value = appodate;
            document.getElementById('send-project-modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById("send-project-modal").style.display = "none";
        }

        // Add Modal
        function openAddModal(projectName, clientName, projectCost, appodate, projectEndDate, projectDescription, projectImage, archiid, appoid, apponum, client_id, project_id) {
            document.getElementById('portfolio_project_name').value = projectName;
            document.getElementById('portfolio_project_client').value = clientName;
            document.getElementById('portfolio_project_cost').value = projectCost;
            document.getElementById('portfolio_project_startdate').value = appodate;
            document.getElementById('portfolio_project_enddate').value = projectEndDate;
            document.getElementById('portfolio_project_description').value = projectDescription;
            document.getElementById('modal_archiid').value = archiid;
            document.getElementById('modal_appoid').value = appoid;
            document.getElementById('modal_apponum').value = apponum;
            document.getElementById('modal_client_id').value = client_id;
            document.getElementById('project_id').value = project_id;

            const imagePreview = document.getElementById('portfolio_project_image_preview');
            if (projectImage) {
                imagePreview.src = '../uploads/' + projectImage; // Path to image
                imagePreview.style.display = 'block'; // Show the image
                document.getElementById('portfolio_project_image').disabled = true; // Disable file input
                document.getElementById('current_image').value = projectImage; // Save current image name
            } else {
                imagePreview.style.display = 'none';
                document.getElementById('portfolio_project_image').disabled = false; // Enable file input if no image
            }

            document.getElementById('add-project-modal').style.display = 'block';
        }




        function closeAddModal() {
            document.getElementById('add-project-modal').style.display = 'none';
        }


        // Success Modal
        const successModal = document.getElementById('success-modal');
        const successMessage = document.getElementById('success-message');

        function showSuccessModal(message) {
            successMessage.textContent = message;
            successModal.style.display = 'flex';
        }

        // Close the success modal when the close button is clicked
        document.querySelector('#success-modal .close-button').onclick = function () {
            successModal.style.display = 'none';
        };

        // Check if the success flag is set and display the modal
        <?php if (isset($_GET['success'])) { ?>
            <?php if ($_GET['success'] == 1) { ?>
                showSuccessModal("Project has been successfully Added!");
            <?php } elseif ($_GET['success'] == 2) { ?>
                showSuccessModal("Project has been successfully sent!");
            <?php } ?>
        <?php } ?>
    </script>


    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>