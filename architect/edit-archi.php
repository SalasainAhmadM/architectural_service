<?php
// Import database
include ("../connection.php");

if ($_POST) {
    $result = $database->query("select * from webuser");
    $name = $_POST['name'];
    $oldemail = $_POST["oldemail"];
    $spec = $_POST['spec'];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];
    $archimage = $_FILES['archimage']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($archimage);

    if ($password == $cpassword) {
        $error = '3';
        $result = $database->query("select architect.archiid from architect inner join webuser on architect.archiemail=webuser.email where webuser.email='$email';");
        if ($result->num_rows == 1) {
            $id2 = $result->fetch_assoc()["archiid"];
        } else {
            $id2 = $id;
        }

        if ($id2 != $id) {
            $error = '1';
        } else {
            if (move_uploaded_file($_FILES['archimage']['tmp_name'], $target_file)) {
                $sql1 = "update architect set archiemail='$email', archiname='$name', archipassword='$password', architel='$tele', specialties=$spec, archimage='$target_file' where archiid=$id;";
                $database->query($sql1);

                $sql1 = "update webuser set email='$email' where email='$oldemail';";
                $database->query($sql1);

                $error = '4';
            } else {
                $error = '5'; // Error code for image upload failure
            }
        }
    } else {
        $error = '2'; // Passwords do not match
    }
} else {
    $error = '3'; // Invalid form submission
}

header("location: settings.php?action=edit&error=" . $error . "&id=" . $id);
?>

</body>

</html>