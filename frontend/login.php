<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if (isset($_POST['submit'])) {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $pdo->prepare('select * from users where email=:email and password=:pass');
    $sql->execute(array(':email' => $email, ':pass' => $pass));
    $count = $sql->rowCount();
    $user = $sql->fetch();
    $username = $user['fullname'];
    $_SESSION['name'] = $username;
    if ($count === 0) {

        echo '<div class="alert alert-danger" style="position:relative;
        top: 45%;
        left:20%;
        width: 30%;
        text-align:center;
        "  role="alert">
                                Invalid Credentials
                                </div>';
    } else {
        header('location:index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JICRCS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/8a9ed0e933.js"></script>
    <style>
        .row {
            margin-left: 2%;
            margin-right: 2%;
            margin-top: 5%
        }

        .page {
            width: 100%;
            height: auto;
            min-height: 100vh;
            background-color: #ede7e6;
            background-size: 100% 100%;
            background-position: top center;
            padding: 100px;

        }

        .signintext {
            margin-right: 20% !important;
            color: #969799
        }

        .top {
            color: #64C97D;
        }

        input[type="email"],
        input[type="password"] {
            background-color: aliceblue;
        }

        .btn {
            width: 30%;
            margin-top: 5%;
            margin-bottom: 5%;
            
        }

        .ForgotPassBtn {
            background-color: white;
            color: black;
            border-bottom: 1px solid #c7c5c5;
            padding-bottom: 3px;
            text-decoration: none !important;
            margin-right: 20%;
            border-top-color: none
        }

        .LoginBtn {

            border: solid 1px white;
            border: none
        }

        .signupbtn {

            width: 25%;
            margin: auto;

            border: solid 1px white;
            font-size: 10px
        }

        form {
            padding: 0;
            margin-left: 15%
        }

        .signin {
            background-color: white;
            padding: 2%;
            margin: auto
        }

        .signup {
            background-image: url(http://i.imgur.com/S4zmPRw.png);

        }

        .form-control {
            width: 80%;
            margin-bottom: 5%;
            margin-top: 5%;
            background-color: #ebe8e8
        }

        .custom-control {
            margin-bottom: 2%
        }

        h2.HelloFriend {
            color: #fff !important;
            font-weight: 200px;
            margin-top: 30%;
            margin-bottom: 10%
        }

        .SignupText {
            color: #fff;
            margin-bottom: 15%;
            font-size: 16px;
            font-weight: 10px !important;
            font-family: Garamond
        }

        @media only screen and (max-width: 600px) {
            row {
                margin-top: 5%;
                margin-left: 1%;
                margin-right: 1%
            }
        }

        input,
        input:focus {
            border-width: 0px;
            outline: 0;
            -webkit-appearance: none;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none
        }

        .social-btn .btn {
            color: #fff;
            margin: 8px 0 0 30px;
            font-size: 15px;
            width: 45px;
            height: 40px;
            line-height: 25px;
            border-radius: 50%;
            font-weight: normal;
            text-align: center;
            border: solid 0.5px grey;
            transition: all 0.4s
        }

        .social-btn .btn:first-child {
            margin-left: 0
        }

        .social-btn .btn:hover {
            opacity: 0.8
        }

        .social-btn .btn i {
            font-size: 20px
        }

        .social-btn {
            margin-right: 20%;
            margin-bottom: 7%;
            margin-top: 5%
        }
    </style>
</head>

<body>


    <!--For all screen-->
    <div class="page">
        <!--Login & Signup in single row-->
        <div class="row">
            <!--Column for signin-->
            <div class="col-sm-8 text-center signin">
                <!-- Default form login -->
                <form action="" method="POST">


                    <p class="h4 mb-4 text-center signintext top"><strong>Sign in to this Website</strong></p>
                    <!--Login with Social Media Buttons-->
                    <div class="alert alert-danger" style="position:relative;
        top:40%;
        left:30%;
        width: 250px;
        visibility:hidden;
        " role="alert">
                        Invalid Credentials
                    </div>

                    <!-- Email --> <input type="email" name="email" class="form-control mb-4" placeholder="&#xf0e0; Email" style="font-family:Arial, FontAwesome" autocomplete="off">
                    <!-- Password --> <input type="password" name="password" class="form-control mb-4" placeholder="&#xf023; Password" style="font-family:Arial, FontAwesome" autocomplete="off"> <!-- Sign in button -->
                     <button class="btn btn-success LoginBtn" name="submit" type="submit" style="margin-left: 210px;">SIGN
                        IN</button>
                </form>
            </div>
            <!--Column for signin-->
            <div class="col-sm-4 signup text-center bg-success">
                <h2 class="HelloFriend">Hello, Friend!</h2>
                <h4 class="SignupText">Enter your personal details<br>and start journey with us</h4> 
                <a style="text-decoration: none; color:#fff;" class="btn btn-success" href="register.php">SIGN UP</a></button>
            </div>
        </div>
    </div>
</body>

</html>