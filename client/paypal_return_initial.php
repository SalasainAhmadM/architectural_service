<?php
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['payment']) && $_GET['payment'] == 'success') {
    $appoid = $_GET['appoid'];


    $stmt = $database->prepare("UPDATE appointment SET pay_status = 'Pay Remaining Payment Now' WHERE appoid = ?");

    if (!$stmt) {
        echo "Prepare failed: (" . $database->errno . ") " . $database->error;
        exit;
    }

    $stmt->bind_param("i", $appoid);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Payment Success</title>
                <style>
                    .modal {
                        display: block; /* Display the modal */
                        position: fixed;
                        z-index: 1;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background-color: rgba(0,0,0,0.4);
                    }

                    .modal-content {
                        background-color: #fff;
                        margin: 15% auto;
                        padding: 20px;
                        border: 1px solid #888;
                        width: 30%;
                        text-align: center;
                        border-radius: 5px;
                    }

                    .modal-content h2 {
                        font-size: 24px;
                        margin-bottom: 20px;
                        color: #008080;
                    }

                    .close-button {
                        color: #008080;
                        float: right;
                        font-size: 28px;
                        font-weight: bold;
                    }

                    .close-button:hover,
                    .close-button:focus {
                        color: black;
                        text-decoration: none;
                        cursor: pointer;
                    }
                </style>
            </head>
            <body>
                <!-- Success Modal -->
                <div id="success-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>Success!</h2>
                        <p id="success-message">Fully Paid✅</p>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var modal = document.getElementById("success-modal");
                        var closeButton = document.getElementsByClassName("close-button")[0];

                        closeButton.onclick = function () {
                            modal.style.display = "none";
                            // Redirect after closing modal
                            window.location.href = "appointment.php";
                        }

                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                                // Redirect after closing modal
                                window.location.href = "appointment.php";
                            }
                        }
                    });
                </script>
            </body>
            </html>';
        } else {
            echo "Error: No rows were updated. Check if appoid exists in the table.";
        }
    } else {
        // Debugging: If execute fails, show error
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
    $database->close();
} else {
    echo "Invalid request.";
}
?>