<?php
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

include("../connection.php");

// Fetch client details from the database
$sqlmain = "SELECT * FROM client WHERE client_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["client_id"];
$username = $userfetch["client_name"];
$client_image = $userfetch["client_image"];

// Query to fetch finished projects for the logged-in client
$finished_project_query = "SELECT * FROM finished_project WHERE client_id=?";

// Check for date filter submission
if (isset($_POST['filter'])) {
    $filter_date = $_POST['sheduledate'];
    if (!empty($filter_date)) {
        $finished_project_query .= " AND project_startdate = ?";
    }
}

$stmt = $database->prepare($finished_project_query);

// Bind parameters based on whether a date filter is applied
if (isset($filter_date) && !empty($filter_date)) {
    $stmt->bind_param("is", $userid, $filter_date);
} else {
    $stmt->bind_param("i", $userid);
}

$stmt->execute();
$finished_project_result = $stmt->get_result();

// Function to format date
function formatDate($date)
{
    return date('F j, Y', strtotime($date));
}
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
    <title>Finished</title>
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

        .chat-container {
            display: flex;
            height: 100%;
        }

        .clients-list {
            width: 25%;
            border-right: 1px solid #ddd;
            padding: 10px;
            background-color: #f5f5f5;
        }

        .clients-list h3 {
            margin-top: 0;
        }

        .clients-list ul {
            list-style: none;
            padding: 0;
        }

        .clients-list li {
            margin: 10px 0;
        }

        .clients-list a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .clients-list a:hover,
        .clients-list a.active {
            background-color: #008080;
            color: white;
        }

        .archi-image {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chatbox {
            width: 50%;
            height: 70%;
            border: 2px solid #f5f5f5;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
            margin-left: 20px;
            background-color: white;
            display: flex;
            flex-direction: column;
        }

        .chatbox-messages {
            flex-grow: 1;
            overflow-y: auto;
            border-bottom: 1px solid #008080;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .chatbox-message-sender {
            text-align: right;
            margin: 5px 0;
        }

        .chatbox-message-receiver {
            text-align: left;
            margin: 5px 0;
        }

        .chatbox-input {
            display: flex;
        }

        .chatbox-input textarea {
            width: 100%;
            height: 50px;
            border: 1px solid #008080;
            border-radius: 10px;
            padding: 10px;
            resize: none;
        }

        .chatbox-input button {
            background-color: #008080;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            margin-left: 10px;
            cursor: pointer;
        }

        .chatbox-input button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .feedback-form-container {
            width: 50%;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .feedback-form h2 {
            text-align: center;
            color: #008080;
            margin-bottom: 20px;
        }

        .feedback-form label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        .feedback-form input[type="text"],
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .feedback-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .feedback-form button {
            background-color: #008080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .feedback-form button:hover {
            background-color: #005f5f;
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
                                    <p class="profile-title"><?php echo substr($username, 0, 13); ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22); ?></p>
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
                        <a href="project.php" class="menu-link-active">
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
            <table border="0" width="100%" style="margin-top:25px;">
                <tr>
                    <td width="13%">
                        <a href="portfolio.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>

                    </td>
                    <td width="15%">
                        <p class="heading-sub12"
                            style="padding: 0;margin: 0;text-align: right;font-size: 14px;color: rgb(119, 119, 119);">
                            Today's Date</p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;text-align: right;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $today = date('Y-m-d');
                            echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">
                            Finished Projects</p>
                    </td>
                    <!-- <td colspan="2">
                        <button id="add-project-button" class="login-btn btn-primary btn button-icon"
                            style="display: flex;justify-content: center;align-items: center;margin-left:75px;">
                            <i style="margin-right: 4px" class="fa-solid fa-plus"></i>Add New</button>
                    </td> -->
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;">
                        <center>
                            <table class="filter-container" border="0">
                                <tr>
                                    <td width="12%">
                                        <!-- Filter form placeholder -->
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td style="margin-bottom: 20px" colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Project Name</th>
                                            <th class="table-headin">Project Image</th>
                                            <th style="width: 250px" class="table-headin">Description</th>
                                            <!-- <th class="table-headin">Client Name</th> -->
                                            <th class="table-headin">Project Cost</th>
                                            <th class="table-headin">Started Date</th>
                                            <th class="table-headin">Finished Date</th>
                                            <th style="width: 200px" class="table-headin">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($finished_project_result->num_rows > 0) {
                                            while ($row = $finished_project_result->fetch_assoc()) {
                                                $projectId = htmlspecialchars($row['project_id'], ENT_QUOTES, 'UTF-8');
                                                $clientId = htmlspecialchars($row['client_id'], ENT_QUOTES, 'UTF-8');
                                                $projectName = htmlspecialchars($row['project_name'], ENT_QUOTES, 'UTF-8');
                                                $projectClient = htmlspecialchars($row['project_client'], ENT_QUOTES, 'UTF-8');
                                                $projectDescription = htmlspecialchars($row['project_description'], ENT_QUOTES, 'UTF-8');
                                                $projectCost = htmlspecialchars($row['project_cost'], ENT_QUOTES, 'UTF-8');
                                                $projectstartDate = htmlspecialchars($row['project_startdate'], ENT_QUOTES, 'UTF-8');
                                                $projectendDate = htmlspecialchars($row['project_enddate'], ENT_QUOTES, 'UTF-8');
                                                $projectImage = htmlspecialchars($row['project_image'], ENT_QUOTES, 'UTF-8');
                                                $formattedstartDate = formatDate($projectstartDate);
                                                $formattedendDate = formatDate($projectendDate);
                                                echo "<tr>";
                                                echo "<td style='text-align: center'>{$projectName}</td>";
                                                echo "<td style='text-align: center'> <img style='height: 100px; width: 100px; padding: 5px;' src='../uploads/{$projectImage}'></td>";
                                                echo "<td style='text-align: center'>{$projectDescription}</td>";
                                                // echo "<td style='text-align: center'>{$projectClient}</td>";
                                                echo "<td style='text-align: center'>₱{$projectCost}</td>";
                                                echo "<td style='text-align: center'>{$formattedstartDate}</td>";
                                                echo "<td style='text-align: center'>{$formattedendDate}</td>";
                                                echo "<td style='text-align: center'>";

                                                echo "<button class='btn-primary-soft btn button-icon view-button' data-project-id='{$projectId}' data-client-id='{$clientId}' data-project-name='{$projectName}' data-project-description='{$projectDescription}' data-project-client='{$projectClient}' data-project-cost='{$projectCost}' data-project-startdate='{$projectstartDate}' data-project-enddate='{$projectendDate}' data-project-image='{$projectImage}'>";
                                                echo "<i style='margin-right: 4px' class='fa-solid fa-eye'></i>View";
                                                echo "</button>";

                                                // echo "<form action='delete_portfolio.php' method='post' onsubmit=\"return confirm('Are you sure you want to delete this project?');\" style='display:inline-block;'>";
                                                // echo "<input type='hidden' name='project_id' value='{$projectId}'>";
                                                // echo "<button type='submit' class='btn-primary-soft btn button-icon'>";
                                                // echo "<i class='fa-solid fa-trash'></i>";
                                                // echo "</button>";
                                                // echo "</form>";
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
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find any finished projects paid by you!</p>
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
    <!-- Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color: #008080" id="modalProjectName"></h2>
            <p><strong>Client Name:</strong> <span id="modalProjectClient"></span></p>
            <p><strong>Description:</strong> <span id="modalProjectDescription"></span></p>
            <p><strong>Cost:</strong> ₱<span id="modalProjectCost"></span></p>
            <p><strong>Started Date:</strong> <span id="modalProjectStartDate"></span></p>
            <p><strong>Finished Date:</strong> <span id="modalProjectEndDate"></span></p>
            <p><strong>Project Image:</strong></p>
            <a id="downloadLink" download><img id="modalProjectImage" style="width: 300px; height: auto;"
                    alt="Project Image"></a>
            <br><br>
            <a id="downloadLinkButton" class="btn-primary-soft btn" download>
                <i class="fa-solid fa-download"></i> Download Image
            </a>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 15px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    </div>
    <script>
        // Modal functionality
        document.addEventListener("DOMContentLoaded", function () {
            const viewButtons = document.querySelectorAll('.view-button');
            const modal = document.getElementById("viewModal");
            const closeModal = document.querySelector(".close");
            const projectImage = document.getElementById("modalProjectImage");
            const projectNameElement = document.getElementById("modalProjectName");
            const projectClientElement = document.getElementById("modalProjectClient");
            const projectDescriptionElement = document.getElementById("modalProjectDescription");
            const projectCostElement = document.getElementById("modalProjectCost");
            const projectStartDateElement = document.getElementById("modalProjectStartDate");
            const projectEndDateElement = document.getElementById("modalProjectEndDate");
            const downloadLink = document.getElementById("downloadLink");
            const downloadLinkButton = document.getElementById("downloadLinkButton");

            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const projectName = this.getAttribute('data-project-name');
                    const projectClient = this.getAttribute('data-project-client');
                    const projectDescription = this.getAttribute('data-project-description');
                    const projectCost = this.getAttribute('data-project-cost');
                    const projectStartDate = this.getAttribute('data-project-startdate');
                    const projectEndDate = this.getAttribute('data-project-enddate');
                    const projectImageSrc = "../uploads/" + this.getAttribute('data-project-image');

                    // Set modal data
                    projectNameElement.innerText = projectName;
                    projectClientElement.innerText = projectClient;
                    projectDescriptionElement.innerText = projectDescription;
                    projectCostElement.innerText = projectCost;
                    projectStartDateElement.innerText = projectStartDate;
                    projectEndDateElement.innerText = projectEndDate;
                    projectImage.src = projectImageSrc;

                    // Set download link for the image
                    downloadLink.href = projectImageSrc;
                    downloadLink.download = projectName + "_" + projectClient + ".jpg";

                    // Also set the button download link and name
                    downloadLinkButton.href = projectImageSrc;
                    downloadLinkButton.download = projectName + "_" + projectClient + ".jpg";

                    modal.style.display = "block";
                });
            });

            // Close modal when clicking the close button
            closeModal.onclick = function () {
                modal.style.display = "none";
            }

            // Close modal when clicking outside of it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

</html>