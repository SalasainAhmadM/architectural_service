<?php
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

// Fetch team data
$team_result = $database->query("SELECT * FROM team");
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

    <title>Architect</title>
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
                <!-- Profile Section -->
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
                <!-- Menu Items -->
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
                        <a href="client.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Clients</p>
                            </div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="team.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-people-group"></i>
                                <p>Members</p>
                            </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style="margin-top:25px;">
                <tr>
                    <td width="13%">
                        <a href="portfolio.php"><button class="login-btn btn-primary-soft btn"
                                style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <i class="fa-solid fa-backward"></i>
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td></td>
                    <td width="15%">
                        <p class="heading-sub12"
                            style="padding: 0;margin: 0;text-align: right;font-size: 14px;color: rgb(119, 119, 119);">
                            Today's Date</p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;text-align: right;">
                            <?php
                            date_default_timezone_set('Asia/Manila');
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
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Team
                            Members</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Name</th>
                                            <th class="table-headin">Role</th>
                                            <th class="table-headin">Profile Image</th>
                                            <th class="table-headin">Social Media 1</th>
                                            <th class="table-headin">Social Media 2</th>
                                            <th class="table-headin">Social Media 3</th>
                                            <th class="table-headin">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($team_result->num_rows > 0) {
                                            while ($row = $team_result->fetch_assoc()) {
                                                $teamId = htmlspecialchars($row['team_id'], ENT_QUOTES, 'UTF-8');
                                                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                                                $role = htmlspecialchars($row['role'], ENT_QUOTES, 'UTF-8');
                                                $profileImage = htmlspecialchars($row['profile_image'], ENT_QUOTES, 'UTF-8');
                                                $socialMedia1 = htmlspecialchars($row['social_media_1'], ENT_QUOTES, 'UTF-8');
                                                $socialMedia2 = htmlspecialchars($row['social_media_2'], ENT_QUOTES, 'UTF-8');
                                                $socialMedia3 = htmlspecialchars($row['social_media_3'], ENT_QUOTES, 'UTF-8');
                                                echo "<tr>";
                                                echo "<td>{$name}</td>";
                                                echo "<td>{$role}</td>";
                                                echo "<td><img style='height: 100px; width: 100px; padding: 5px;' src='../img/{$profileImage}'></td>";
                                                echo "<td>{$socialMedia1}</td>";
                                                echo "<td>{$socialMedia2}</td>";
                                                echo "<td>{$socialMedia3}</td>";
                                                echo "<td>";
                                                echo "<button class='btn-primary-soft btn button-icon edit-button' data-team-id='{$teamId}' data-name='{$name}' data-role='{$role}' data-profile-image='{$profileImage}' data-social-media-1='{$socialMedia1}' data-social-media-2='{$socialMedia2}' data-social-media-3='{$socialMedia3}'>";
                                                echo "<i style='margin-right: 4px' class='fa-solid fa-pen-to-square'></i>Edit";
                                                echo "</button>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No team members found.</td></tr>";
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

    <!-- Edit Team Member Modal -->
    <div id="editFormModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="edit_team.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="team_id" id="editTeamId">
                <label for="editName">Name:</label>
                <input type="text" name="name" id="editName" required>
                <label for="editRole">Role:</label>
                <input type="text" name="role" id="editRole" required>
                <label for="editProfileImage">Profile Image:</label>
                <input type="file" name="profile_image" id="editProfileImage">
                <label for="editSocialMedia1">Social Media 1:</label>
                <input type="text" name="social_media_1" id="editSocialMedia1" required>
                <label for="editSocialMedia2">Social Media 2:</label>
                <input type="text" name="social_media_2" id="editSocialMedia2" required>
                <label for="editSocialMedia3">Social Media 3:</label>
                <input type="text" name="social_media_3" id="editSocialMedia3" required>
                <button type="submit">Save Changes</button>
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
    <script>
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
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
</body>

<script>
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', () => {
            const teamId = button.getAttribute('data-team-id');
            const name = button.getAttribute('data-name');
            const role = button.getAttribute('data-role');
            const socialMedia1 = button.getAttribute('data-social-media-1');
            const socialMedia2 = button.getAttribute('data-social-media-2');
            const socialMedia3 = button.getAttribute('data-social-media-3');

            document.getElementById('editTeamId').value = teamId;
            document.getElementById('editName').value = name;
            document.getElementById('editRole').value = role;
            document.getElementById('editSocialMedia1').value = socialMedia1;
            document.getElementById('editSocialMedia2').value = socialMedia2;
            document.getElementById('editSocialMedia3').value = socialMedia3;

            document.getElementById('editFormModal').style.display = 'flex';
        });
    });

    // Close the modal when the user clicks the close button
    document.querySelector('.close').addEventListener('click', () => {
        document.getElementById('editFormModal').style.display = 'none';
    });

    // Close the modal when the user clicks outside of the modal
    window.addEventListener('click', (event) => {
        if (event.target == document.getElementById('editFormModal')) {
            document.getElementById('editFormModal').style.display = 'none';
        }
    });
</script>

</html>