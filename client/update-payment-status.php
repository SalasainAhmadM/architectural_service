<?php
// Include your database connection
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appoid = $_POST['appoid'];
    $archi = $_POST['archi'];

    // Update the payment status to "Paid"
    $stmt = $database->prepare("UPDATE appointment SET pay_status = 'Fully Paid' WHERE appoid = ?");
    $stmt->bind_param("i", $appoid);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $database->close();
}
?>