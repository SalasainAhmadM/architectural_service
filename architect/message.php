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

include("../connection.php");
$userrow = $database->query("select * from architect where archiemail='$useremail'");
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["archiid"];
$username = $userfetch["archiname"];
$archi_image = $userfetch["archi_image"];

// Handle message sending
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && isset($_POST['receiver_id'])) {
    $message = mysqli_real_escape_string($database, $_POST['message']);
    $receiver_id = (int) $_POST['receiver_id'];

    $insertMessageQuery = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$userid', '$receiver_id', '$message')";
    mysqli_query($database, $insertMessageQuery);
}

// Fetch clients
$clientsQuery = "SELECT * FROM client";
$clientsResult = mysqli_query($database, $clientsQuery);

function markMessagesAsRead($selectedClientId, $userid, $database)
{
    $markAsReadQuery = "
        UPDATE messages 
        SET is_read = 1 
        WHERE sender_id = ? 
          AND receiver_id = ? 
          AND is_read = 0 
          AND sender_type = 'client'";  // Only mark messages where sender_type is 'client'

    $stmt = $database->prepare($markAsReadQuery);
    $stmt->bind_param("ii", $selectedClientId, $userid);  // Bind selectedClientId (sender) and architect (receiver)
    $stmt->execute();
    $stmt->close();
}

// Main logic
$selectedClientId = isset($_GET['client_id']) ? (int) $_GET['client_id'] : 0;
if ($selectedClientId > 0) {
    // Call function to mark messages as read
    markMessagesAsRead($selectedClientId, $userid, $database);
}

// Fetch messages between architect and the selected client
$messagesQuery = "SELECT * 
                  FROM messages 
                  WHERE (sender_id = ? AND receiver_id = ?) 
                     OR (sender_id = ? AND receiver_id = ?) 
                  ORDER BY timestamp ASC";
$stmt = $database->prepare($messagesQuery);
$stmt->bind_param("iiii", $userid, $selectedClientId, $selectedClientId, $userid);
$stmt->execute();
$messagesResult = $stmt->get_result();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_message_id'])) {
    $deleteMessageId = (int) $_POST['delete_message_id'];

    $deleteMessageQuery = "DELETE FROM messages WHERE message_id = ? AND sender_id = ? AND sender_type = 'architect'";
    $stmt = $database->prepare($deleteMessageQuery);
    $stmt->bind_param("ii", $deleteMessageId, $userid);
    $stmt->execute();
    $stmt->close();

    // Refresh the page to reflect the changes
    header("Location: message.php?client_id=$selectedClientId");
    exit();
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

        .client-image {
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

        .chatbox-message p {
            margin: 0;
            padding: 10px;
            border-radius: 10px;
            display: inline-block;
            max-width: 70%;
        }

        .chatbox-message-sender p {
            background-color: #d1e7dd;
            color: #0f5132;
            border-bottom-right-radius: 0;
        }

        .chatbox-message-receiver p {
            background-color: #f8d7da;
            color: #842029;
            border-bottom-left-radius: 0;
        }

        .chatbox-timestamp {
            font-size: 12px;
            color: #6c757d;
            display: block;
            margin-top: 5px;
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
            background-color: #ccc;
            cursor: not-allowed;
        }

        .client-info {
            position: relative;
            display: inline-block;
            margin-left: 10px;
        }

        .client-info span {
            font-size: 14px;
            font-weight: bold;
        }

        .notification-badge {
            background-color: #ff0000;
            color: white;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50%;
            padding: 3px 6px;
            position: absolute;
            top: -8px;
            right: -20px;
            transform: translateY(-50%);
        }

        .delete-message-btn {
            background: none;
            border: none;
            color: #ff0000;
            cursor: pointer;
            margin-left: 10px;
        }

        .delete-message-btn:hover {
            color: #cc0000;
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
                                <p>Dashboard</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="appointment.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Projects</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="schedule.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-calendar-days"></i>
                                <p>Sessions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="client.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Clients</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="portfolio.php" class="menu-link">
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
                        <a href="message.php" class="menu-link-active">
                            <div class="menu-item">
                                <i class="fa-solid fa-message"></i>
                                <p>Chat Box</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td>
                        <a href="settings.php" class="menu-link">
                            <div class="menu-item">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </div>
                        </a>
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
                        <p class="heading-sub 12" style="padding: 0;margin: 0;text-align: right;">
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
                <!-- List of Clients -->
                <div class="clients-list">
                    <h3>Select a Client to Chat With:</h3>
                    <ul>
                        <?php while ($client = mysqli_fetch_assoc($clientsResult)): ?>
                            <?php
                            // Query to get the count of unread messages for this client
                            $clientId = $client['client_id'];
                            $unreadQuery = "
            SELECT COUNT(*) AS unread_count 
            FROM messages 
            WHERE sender_id = $clientId 
              AND receiver_id = $userid 
              AND sender_type = 'client' 
              AND is_read = 0";
                            $unreadResult = mysqli_query($database, $unreadQuery);
                            $unreadCount = mysqli_fetch_assoc($unreadResult)['unread_count'];
                            ?>
                            <li>
                                <a href="message.php?client_id=<?php echo $client['client_id']; ?>"
                                    class="<?php echo $selectedClientId == $client['client_id'] ? 'active' : ''; ?>">
                                    <img class="client-image"
                                        src="<?php echo !empty($client['client_image']) ? $client['client_image'] : '../img/user.png'; ?>"
                                        alt="Client Image">
                                    <div class="client-info">
                                        <span><?php echo $client['client_name']; ?></span>
                                        <?php if ($unreadCount > 0): ?>
                                            <span class="notification-badge"><?php echo $unreadCount; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                </div>


                <div class="chatbox">
                    <div class="chatbox-messages" id="chatbox-messages">
                        <?php while ($message = mysqli_fetch_assoc($messagesResult)): ?>
                            <div
                                class="chatbox-message <?php echo $message['sender_type'] == 'architect' ? 'chatbox-message-sender' : 'chatbox-message-receiver'; ?>">
                                <p><?php echo $message['message']; ?></p>
                                <span
                                    class="chatbox-timestamp"><?php echo date('h:i A', strtotime($message['timestamp'])); ?></span>
                                <?php if ($message['sender_type'] == 'architect'): ?>
                                    <form method="POST" class="delete-message-form" style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="delete_message_id"
                                            value="<?php echo $message['message_id']; ?>">
                                        <button type="submit" class="delete-message-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>


                    <div class="chatbox-input">
                        <form method="POST">
                            <textarea name="message" id="chatbox-input"
                                placeholder="Type your message here..."></textarea>
                            <input type="hidden" name="receiver_id" value="<?php echo $selectedClientId; ?>">
                            <button id="send-button" type="submit" <?php if ($selectedClientId == 0)
                                echo 'disabled'; ?>>Send</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/1046de6bec.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sendButton = document.getElementById('send-button');
            const clientLinks = document.querySelectorAll('.clients-list a');

            clientLinks.forEach(clientLink => {
                clientLink.addEventListener('click', function () {
                    sendButton.disabled = false;
                });
            });

            // If no client is selected, disable the send button
            if (<?php echo $selectedClientId; ?> === 0) {
                sendButton.disabled = true;
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const sendButton = document.getElementById("send-button");
            const messageInput = document.getElementById("chatbox-input");

            // Enable send button if text is entered
            messageInput.addEventListener("input", function () {
                sendButton.disabled = !messageInput.value.trim();
            });

            // Trigger send button on Enter key press
            messageInput.addEventListener("keydown", function (event) {
                if (event.key === "Enter" && !event.shiftKey && !sendButton.disabled) {
                    event.preventDefault(); // Prevent new line
                    sendButton.click(); // Trigger the send button
                }
            });
        });
    </script>
</body>

</html>