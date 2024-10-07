<?php
session_start(); // Start the session at the very top

// Redirect if not logged in or not the correct user type
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'd') {
    header("location: ../login.php");
    exit(); // Ensure script stops here after redirect
}

// Include database connection
include("../connection.php");

// Fetch user details
$useremail = $_SESSION["user"];
$userrow = $database->query("SELECT * FROM architect WHERE archiemail='$useremail'");
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["archiid"];
$username = $userfetch["archiname"];
$archi_image = $userfetch["archi_image"];

$project_query = "SELECT * FROM project";

// Check for date filter submission
if (isset($_POST['filter'])) {
    $filter_date = $_POST['sheduledate'];
    if (!empty($filter_date)) {
        $project_query .= " WHERE service_date = '$filter_date'";
    }
}

$project_result = $database->query($project_query);

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
    <title>Portfolio</title>
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
            background-color: #006666;
            border: 1px solid #006666;
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
            background-color: #006666;
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

        .sub-table td {
            text-align: center;
        }

        .sub-table .btn {
            display: inline-block;
            margin-right: 10px;
        }

        /* Modal Styles */
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
                                <p>Schedule</p>
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
                        <a href="project.php" class="menu-link-active">
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
            <table border="0" width="100%" style="margin-top:25px;">
                <tr>
                    <td width="13%">
                        <a href="project.php"><button class="login-btn btn-primary-soft btn"
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
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">My
                            Services</p>
                    </td>
                    <td colspan="2">
                        <button id="add-service-button" class="login-btn btn-primary btn button-icon"
                            style="display: flex;justify-content: center;align-items: center;margin-left:75px;">
                            <i style="margin-right: 4px" class="fa-solid fa-plus"></i>Add New</button>
                    </td>
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
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Service Name</th>
                                            <th class="table-headin">Service Image</th>
                                            <th style="width: 400px" class="table-headin">Description</th>
                                            <th class="table-headin">Service Cost</th>
                                            <!-- <th class="table-headin">Date</th> -->
                                            <th style="width: 300px" class="table-headin">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($project_result->num_rows > 0) {
                                            while ($row = $project_result->fetch_assoc()) {
                                                $serviceId = htmlspecialchars($row['service_id'], ENT_QUOTES, 'UTF-8');
                                                $serviceName = htmlspecialchars($row['service_name'], ENT_QUOTES, 'UTF-8');
                                                $serviceDescription = htmlspecialchars($row['service_description'], ENT_QUOTES, 'UTF-8');
                                                $serviceCost = htmlspecialchars($row['service_cost'], ENT_QUOTES, 'UTF-8');
                                                $serviceDate = htmlspecialchars($row['service_date'], ENT_QUOTES, 'UTF-8');
                                                $serviceImage = htmlspecialchars($row['service_image'], ENT_QUOTES, 'UTF-8');
                                                $formattedDate = formatDate($serviceDate);
                                                echo "<tr>";
                                                echo "<td>{$serviceName}</td>";
                                                echo "<td><img style='height: 100px; width: 100px; padding: 5px;' src='../img/{$serviceImage}'></td>";
                                                echo "<td>{$serviceDescription}</td>";
                                                echo "<td>₱{$serviceCost}</td>";
                                                // echo "<td>{$formattedDate}</td>";
                                                echo "<td>";
                                                echo "<button class='btn-primary-soft btn button-icon edit-button' data-service-id='{$serviceId}' data-service-name='{$serviceName}' data-service-description='{$serviceDescription}' data-service-cost='{$serviceCost}' data-service-date='{$serviceDate}' data-service-image='{$serviceImage}'>";
                                                echo "<i style='margin-right: 4px' class='fa-solid fa-pen-to-square'></i>Edit";
                                                echo "</button>";
                                                echo "<form action='delete_project.php' method='post' onsubmit=\"return confirm('Are you sure you want to delete this service?');\" style='display:inline-block;'>";
                                                echo "<input type='hidden' name='service_id' value='{$serviceId}'>";
                                                echo "<button type='submit' class='btn-primary-soft btn button-icon'>";
                                                echo "<i style='margin-right: 4px' class='fa-solid fa-trash'></i>Delete";
                                                echo "</button>";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No services found.</td></tr>";
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

    <!-- Add Project Modal -->
    <div id="add-service-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Add New Project</h2>
            <form action="add_project.php" method="post" enctype="multipart/form-data">
                <label for="service_name">Project Name:</label>
                <input type="text" id="service_name" name="service_name" required>
                <label for="service_image">Project Image:</label>
                <input type="file" id="service_image" name="service_image" accept="image/*" required>
                <label for="service_description">Description:</label>
                <textarea id="service_description" name="service_description" required></textarea>
                <label for="service_cost">Project Cost:</label>
                <input type="number" id="service_cost" name="service_cost" step="0.01" min="0" placeholder="0.00"
                    required>
                <!-- <label for="service_date">Date:</label>
                <input type="date" id="service_date" name="service_date" required> -->
                <button type="submit" class="btn btn-primary">Add Project</button>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="edit-service-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Edit Project</h2>
            <form id="edit-service-form" action="edit_project.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit_service_id" name="service_id">
                <label for="edit_service_name">Project Name:</label>
                <input type="text" id="edit_service_name" name="service_name" required>
                <label for="edit_service_image">Project Image:</label>
                <input type="file" id="edit_service_image" name="service_image" accept="image/*">
                <label for="edit_service_description">Description:</label>
                <textarea id="edit_service_description" name="service_description" required></textarea>
                <label for="edit_service_cost">Project Cost</label>
                <input type="number" id="edit_service_cost" name="service_cost" step="0.01" min="0" placeholder="0.00"
                    required>
                <!-- <label for="edit_service_date">Date:</label>
                <input type="date" id="edit_service_date" name="service_date" required> -->
                <button type="submit" class="btn btn-primary">Update Project</button>
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




    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
    <script>
        // Add Project Modal
        const addProjectModal = document.getElementById('add-service-modal');
        const addProjectButton = document.getElementById('add-service-button');
        const closeButtons = document.querySelectorAll('.close-button');

        addProjectButton.onclick = function () {
            addProjectModal.style.display = 'flex';
        };

        closeButtons.forEach(button => {
            button.onclick = function () {
                button.closest('.modal').style.display = 'none';
            };
        });

        window.onclick = function (event) {
            if (event.target === addProjectModal) {
                addProjectModal.style.display = 'none';
            }
            if (event.target === editProjectModal) {
                editProjectModal.style.display = 'none';
            }
            if (event.target === successModal) {
                successModal.style.display = 'none';
            }
        };

        // Edit Project Modal
        const editProjectModal = document.getElementById('edit-service-modal');
        const editButtons = document.querySelectorAll('.edit-button');
        const editProjectForm = document.getElementById('edit-service-form');

        editButtons.forEach(button => {
            button.onclick = function () {
                const serviceId = button.getAttribute('data-service-id');
                const serviceName = button.getAttribute('data-service-name');
                const serviceDescription = button.getAttribute('data-service-description');
                const serviceCost = button.getAttribute('data-service-cost');
                // const serviceDate = button.getAttribute('data-service-date');

                document.getElementById('edit_service_id').value = serviceId;
                document.getElementById('edit_service_name').value = serviceName;
                document.getElementById('edit_service_description').value = serviceDescription;
                document.getElementById('edit_service_cost').value = serviceCost;
                // document.getElementById('edit_service_date').value = serviceDate;

                editProjectModal.style.display = 'flex';
            };
        });

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

        // Display the success modal if the operation was successful
        <?php if (isset($_SESSION['success_message'])) { ?>
            showSuccessModal("<?php echo $_SESSION['success_message']; ?>");
            <?php unset($_SESSION['success_message']); ?>
        <?php } ?>
    </script>

</body>

</html>