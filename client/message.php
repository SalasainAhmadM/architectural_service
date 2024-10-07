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

$sqlmain = "select * from client where client_email=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["client_id"];
$username = $userfetch["client_name"];
$client_image = $userfetch["client_image"];

// Handle message sending
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && isset($_POST['receiver_id'])) {
    $message = mysqli_real_escape_string($database, $_POST['message']);
    $receiver_id = (int) $_POST['receiver_id'];

    $insertMessageQuery = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$userid', '$receiver_id', '$message')";
    mysqli_query($database, $insertMessageQuery);
}

// Fetch architects
$architectsQuery = "SELECT * FROM architect";
$architectsResult = mysqli_query($database, $architectsQuery);

// Fetch messages between client and a specific architect
$selectedArchitectId = isset($_GET['architect_id']) ? (int) $_GET['architect_id'] : 0;
$messagesQuery = "SELECT * FROM messages WHERE (sender_id = '$userid' AND receiver_id = '$selectedArchitectId') OR (sender_id = '$selectedArchitectId' AND receiver_id = '$userid') ORDER BY timestamp ASC";
$messagesResult = mysqli_query($database, $messagesQuery);
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
    <title>Dashboard</title>
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
                        <a href="message.php" class="menu-link-active">
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
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Messaging</p>
                    </td>
                    <td width="25%"></td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub 12" style="font-size: 20px;padding: 0;margin: 0;text-align: right;">
                            <?php
                            date_default_timezone_set('Asia/Manila');
                            $today = date('Y-m-d');
                            echo $today;
                            $clientrow = $database->query("SELECT * FROM client;");
                            $architectrow = $database->query("SELECT * FROM architect;");
                            $appointmentrow = $database->query("SELECT * FROM appointment WHERE appodate>='$today';");
                            $schedulerow = $database->query("SELECT * FROM schedule WHERE scheduledate='$today';");
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
            </table>

            <!-- Chatbox Function -->
            <div class="chat-container">
                <!-- List of Architects -->
                <div class="clients-list">
                    <h3>Architect</h3>
                    <ul>
                        <?php while ($architect = mysqli_fetch_assoc($architectsResult)): ?>
                            <li>
                                <a href="message.php?architect_id=<?php echo $architect['archiid']; ?>"
                                    class="<?php echo $selectedArchitectId == $architect['archiid'] ? 'active' : ''; ?>">
                                    <img class="archi-image"
                                        src="<?php echo !empty($architect['archi_image']) ? $architect['archi_image'] : '../img/user.png'; ?>"
                                        alt="Architect Image">
                                    <?php echo $architect['archiname']; ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="chatbox">
                    <div class="chatbox-messages" id="chatbox-messages">
                        <!-- Messages will be dynamically loaded here -->
                        <?php while ($message = mysqli_fetch_assoc($messagesResult)): ?>
                            <div
                                class="chatbox-message <?php echo $message['sender_id'] == $userid ? 'chatbox-message-sender' : 'chatbox-message-receiver'; ?>">
                                <?php echo $message['message']; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="chatbox-input">
                        <form method="POST">
                            <textarea name="message" id="chatbox-input"
                                placeholder="Type your message here..."></textarea>
                            <input type="hidden" name="receiver_id" value="<?php echo $selectedArchitectId; ?>">
                            <button type="submit" id="send-button" disabled>Send</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
    <script>
        // Disable send button if no architect is selected
        const sendButton = document.getElementById('send-button');
        const receiverId = <?php echo $selectedArchitectId; ?>;
        if (receiverId === 0) {
            sendButton.disabled = true;
        } else {
            sendButton.disabled = false;
        }
    </script>
</body>

</html>