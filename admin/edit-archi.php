<?php



//import database
include ("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");
    $name = $_POST['name'];
    $oldemail = $_POST["oldemail"];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];

    if ($password == $cpassword) {
        $error = '3';
        $result = $database->query("select architect.archiid from architect inner join webuser on architect.archiemail=webuser.email where webuser.email='$email';");
        if ($result->num_rows == 1) {
            $id2 = $result->fetch_assoc()["archiid"];
        } else {
            $id2 = $id;
        }

        echo $id2 . "jdfjdfdh";
        if ($id2 != $id) {
            $error = '1';

        } else {

            $sql1 = "update architect set archiemail='$email',archiname='$name',archipassword='$password',architel='$tele',archiaddress='$address' where archiid=$id ;";
            $database->query($sql1);

            $sql1 = "update webuser set email='$email' where email='$oldemail' ;";
            $database->query($sql1);
            //echo $sql1;
            //echo $sql2;
            $error = '4';

        }

    } else {
        $error = '2';
    }




} else {
    //header('location: signup.php');
    $error = '3';
}


header("location: architects.php?action=edit&error=" . $error . "&id=" . $id);
?>



</body>

</html>