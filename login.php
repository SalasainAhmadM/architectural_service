<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Login</title>



</head>

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

    .back-to-homepage {
        display: inline-block;
        margin-top: 10px;
        font-size: 14px;
        color: #008080;
        text-decoration: none;
    }

    .back-to-homepage:hover {
        color: #004d4d;
    }
</style>

<body>
    <?php


    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');

    $_SESSION["date"] = $date;


    //import database
    include("connection.php");





    if ($_POST) {

        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];

        $error = '<label for="promter" class="form-label"></label>';

        $result = $database->query("select * from webuser where email='$email'");
        if ($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];
            if ($utype == 'p') {
                //TODO
                $checker = $database->query("select * from client where client_email='$email' and client_password='$password'");
                if ($checker->num_rows == 1) {


                    //   Client dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';

                    header('location: client/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            } elseif ($utype == 'a') {
                //TODO
                $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
                if ($checker->num_rows == 1) {


                    //   Admin dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';

                    header('location: admin/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }


            } elseif ($utype == 'd') {
                //TODO
                $checker = $database->query("select * from architect where archiemail='$email' and archipassword='$password'");
                if ($checker->num_rows == 1) {


                    //   architect dashbord
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: architect/index.php');

                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }

        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
        }







    } else {
        $error = '<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
        <div style="width: 30%;" class="container">
            <table border="0" style="margin-top: 20px;padding: 10px;width: 90%;">
                <h2>Architectural Services</h2>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td">
                            <label style="" for="useremail" class="form-label">Email </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <label for="userpassword" class="form-label">Password </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <div class="password-container">
                            <input type="Password" id="password" name="userpassword" class="input-text"
                                placeholder="Password" required>
                            <span id="toggle-password" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>



                <tr>
                    <td><br>
                        <?php echo $error ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Login" class="login-btn btn-primary btn">
                    </td>
                </tr>
        </div>
        <tr>
            <td>
                <br>
                <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                <a href="signup.php" class="hover-link1 non-style-link">Register</a><br><br>
                <br><br><br>
                <a href="index.php" class="back-to-homepage">
                    <i class="fas fa-arrow-left"></i> Back to Homepage
                </a>
            </td>
        </tr>




        </form>
        </table>

        </div>
    </center>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
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