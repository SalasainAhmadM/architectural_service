<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Create Account</title>
    <style>
        .container {
            animation: transitionIn-X 0.5s;
        }
    </style>
    <style>
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

        .password-container {
            position: relative;
            width: 100%;
        }

        .input-text {
            width: 100%;
            padding-right: 40px;
            /* Adjust to make space for the icon */
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com
//Unset all the server side variables
    
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');

    $_SESSION["date"] = $date;


    //import database
    include ("connection.php");





    if ($_POST) {

        $result = $database->query("select * from webuser");

        $fname = $_SESSION['personal']['fname'];
        $lname = $_SESSION['personal']['lname'];
        $name = $fname . " " . $lname;
        $address = $_SESSION['personal']['address'];
        $dob = $_SESSION['personal']['dob'];
        $email = $_POST['newemail'];
        $tele = $_POST['tele'];
        $newpassword = $_POST['newpassword'];
        $cpassword = $_POST['cpassword'];

        if ($newpassword == $cpassword) {
            $sqlmain = "select * from webuser where email=?;";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
            } else {
                //TODO
                $database->query("insert into client(client_email,client_name,client_password, client_address, client_dob,client_tel) values('$email','$name','$newpassword','$address','$dob','$tele');");
                $database->query("insert into webuser values('$email','p')");

                //print_r("insert into client values($client_id,'$email','$fname','$lname','$newpassword','$address','$dob','$tele');");
                $_SESSION["user"] = $email;
                $_SESSION["usertype"] = "p";
                $_SESSION["username"] = $fname;

                header('Location: client/index.php');
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
            }

        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
        }




    } else {
        //header('location: signup.php');
        $error = '<label for="promter" class="form-label"></label>';
    }

    ?>


    <center>
        <div class="container">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">It's Okey, Now Create User Account.</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Email: </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                    </td>

                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Mobile Number: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="tele" class="input-text" placeholder="ex: 09123456789"
                            pattern="[0]{1}[9]{1}[0-9]{9}">
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword" class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <div class="password-container">
                            <input type="password" id="newpassword" name="newpassword" class="input-text"
                                placeholder="New Password" required>
                            <span id="toggle-newpassword" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Confirm Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <div class="password-container">
                            <input type="password" id="cpassword" name="cpassword" class="input-text"
                                placeholder="Confirm Password" required>
                            <span id="toggle-cpassword" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>


                <tr>

                    <td colspan="2">
                        <?php echo $error ?>

                    </td>
                </tr>

                <tr>
                    <td>
                        <input style="color: white;" type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>

                </form>
                </tr>
            </table>

        </div>
    </center>
    <script>
        document.getElementById('toggle-newpassword').addEventListener('click', function () {
            const passwordField = document.getElementById('newpassword');
            const toggleIcon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggle-cpassword').addEventListener('click', function () {
            const passwordField = document.getElementById('cpassword');
            const toggleIcon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>