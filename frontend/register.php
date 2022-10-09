<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        input[type="password"],
        input[type="text"] {
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

    <script>
        var myInput = document.getElementById("psw");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
    </script>
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
                    <?php

                    if (isset($_POST['submit'])) {

                        $pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        if (isset($_POST['name']) && isset($_POST['email']) && $_POST['password'] && $_POST['cpassword']) {
                            if ($_POST['password'] == $_POST['cpassword']) {
                                $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
                                $stmt->execute([$_POST['email']]);
                                $row = $stmt->fetch();
                                $count = 0;
                                while ($row = $stmt->fetch()) {
                                    $count++;
                                }
                                if ($count > 0) {
                                    echo '<div class="alert alert-danger" role="alert">
                                Email Already taken
                                </div>';
                                } else {
                                    $sql = "INSERT INTO users(email,password,fullname) values(:email,:pass,:fullname)";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(array(
                                        ':email' => $_POST['email'],
                                        ':pass' => $_POST['password'],
                                        ':fullname' => $_POST['name']
                                    ));
                                    echo '<div class="alert alert-success m-4" role="alert">
                                Register successful
                                </div>';
                                }
                            }
                        }
                        $link = 'python E:\xampp\htdocs\JICRCS\BackEnd\sources\add_user.py ' . $_POST['email'];
                        #echo "$link";
                        $output = shell_exec($link);
                        echo "$output";
                    }

                    ?>

                    <?php
                    if (isset($_POST['submit'])) {
                        

                        if ($_POST['name'] == "") {
                            echo '<div class="alert alert-danger" role="alert">
                        Full Name missing
                        </div>';
                        }
                    }
                    if (isset($_POST['submit'])) {

                        if ($_POST['email'] == "") {
                            echo '<div class="alert alert-danger" role="alert">
                        Email missing
                        </div>';
                        }
                    }
                    if (isset($_POST['submit'])) {

                        if ($_POST['password'] == "") {
                            echo '<div class="alert alert-danger" role="alert">
                        Password missing
                        </div>';
                        }
                    }
                    if (isset($_POST['submit'])) {

                        if ($_POST['cpassword'] == "") {
                            echo '<div class="alert alert-danger" role="alert">
                        Confirm Password missing
                        </div>';
                        }
                    }
                    if (isset($_POST['submit'])) {

                        if ($_POST['cpassword'] != $_POST['password']) {
                            echo '<div class="alert alert-danger" role="alert">
                        Password does not match
                        </div>';
                        }
                    }
                    ?>

                    <p class="h4 mb-4 text-center signintext top"><strong>Register to this Website</strong></p>
                    <!--Login with Social Media Buttons-->

                    <!-- Email -->
                    <input type="text" name="name" class="form-control mb-4" placeholder="&#xf0e0; Full Name" style="font-family:Arial, FontAwesome">
                    <input type="email" name="email" class="form-control mb-4" placeholder="&#xf0e0; Email" style="font-family:Arial, FontAwesome">

                    <!-- Password -->
                    <input type="password" name="password" class="form-control mb-4" placeholder="&#xf023; Password" id="psw" style="font-family:Arial, FontAwesome" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input type="password" name="cpassword" class="form-control mb-4" placeholder="&#xf023; Confirm Password" style="font-family:Arial, FontAwesome">
                    <!-- Sign in button -->

                    <button class="btn btn-success LoginBtn" name="submit" type="submit" style="margin-left: 220px;">Register
                    </button>
                    <!-- <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div> -->
                </form>
            </div>
            <!--Column for signin-->
            <div class="col-sm-4 signup text-center bg-success">
                <h2 class="HelloFriend">Hello, Friend!</h2>
                <h4 class="SignupText">Already a user?<br>then sign in </h4> 
                
                <a href="login.php" class="btn btn-success text-center">Sign In</a>
            </div>
        </div>
    </div>
</body>

</html>