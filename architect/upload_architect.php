<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id00"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $tele = $_POST["Tele"];
    $spec = $_POST["spec"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Handle image upload
    if (isset($_FILES['archi_image']) && $_FILES['archi_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['archi_image']['tmp_name'];
        $fileName = $_FILES['archi_image']['name'];
        $fileSize = $_FILES['archi_image']['size'];
        $fileType = $_FILES['archi_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $archi_image = $dest_path;
                // Update the database with the new image path
                $sql = "UPDATE architect SET archiemail='$email', archiname='$name', architel='$tele', specialties='$spec', profile_image_path='$archi_image' WHERE archiid='$id'";
                $result = $database->query($sql);
                // Additional code to handle password update and other fields...
            }
        }
    }
}
?>