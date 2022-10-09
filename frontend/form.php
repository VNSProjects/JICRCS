<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if(!isset($_SESSION)){
    header("Location: Error.php");
}

$connect = new PDO("mysql:host=localhost;dbname=JICRCS", "root", "");
$message = '';
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if (isset($_SESSION['name']) && !empty([$_SESSION['name']])) {
    $href = "form.php";
} else {
    $href = "login.php";
}
$fullname = $_SESSION['name'];
if (isset($_POST["mobile_no"])) {
    $_SESSION['skill'] = $_POST['skill'];

    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['dob'] = $_POST["dob"];
    $_SESSION['gender'] = $_POST["gender"];
    $_SESSION['mobile_no'] = $_POST["mobile_no"];
    $_SESSION['address'] = $_POST["address"];
    $_SESSION['sname'] = $_POST["sname"];
    $_SESSION['snumber'] = $_POST["snumber"];
    $_SESSION['jname'] = $_POST["jname"];
    $_SESSION['jnumber'] = $_POST["jnumber"];
    $_SESSION['dname'] = $_POST["dname"];
    $_SESSION['dnumber'] = $_POST["dnumber"];
    $_SESSION['cname'] = $_POST["cname"];
    $_SESSION['cnumber'] = $_POST["cnumber"];
    $_SESSION['bname'] = $_POST["bname"];
    $_SESSION['skill'] = $_POST["skill"];
    $_SESSION['certificate'] = $_POST["certificate"];
    $_SESSION['intership'] = $_POST["intership"];

    sleep(5);
    $query = "
 INSERT INTO user_details 
 (email,password,fullname,fname, lname, dob, gender, mobile_no, address, sname, snumber, jname, jnumber, dname, dnumber, cname, cnumber, bname, skill, certificate, intership) VALUES 
 (:email,:password,:fullname,:fname, :lname, :dob, :gender, :mobile_no, :address, :sname, :snumber, :jname, :jnumber, :dname, :dnumber, :cname, :cnumber, :bname, :skill, :certificate, :intership)
 ";

    $user_data = array(
        ':email' => $email,
        ':password' => $password,
        ':fullname' => $fullname,
        ':fname'  => $_POST["fname"],
        ':lname'  => $_POST["lname"],
        ':dob'  => $_POST["dob"],
        ':gender'   => $_POST["gender"],
        ':mobile_no'  => $_POST["mobile_no"],
        ':address'   => $_POST["address"],
        ':sname'  => $_POST["sname"],
        ':snumber'  => $_POST["snumber"],
        ':jname'  => $_POST["jname"],
        ':jnumber'  => $_POST["jnumber"],
        ':dname'  => $_POST["dname"],
        ':dnumber'  => $_POST["dnumber"],
        ':cname'  => $_POST["cname"],
        ':cnumber'  => $_POST["cnumber"],
        ':bname'  => $_POST["bname"],
        ':skill'  => $_POST["skill"],
        ':certificate'  => $_POST["certificate"],
        ':intership'  => $_POST["intership"],
    );
    $statement = $connect->prepare($query);
    if ($statement->execute($user_data)) {
        $message = '
  <div class="alert alert-success">
  Registration Completed Successfully
  </div>
  ';
    } else {
        $message = '
  <div class="alert alert-success">
  There is an error in Registration
  </div>
  ';
    }
}
?>





<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Application Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/8a9ed0e933.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            overflow-x: hidden;
        }
        #menu{
        }
        #menu > ul{
            background-color: #198754;
        }
        
        #menu ul{
            list-style: none;
            position: relative;
            margin: 0;
            padding: 0;
            float:right;
            width:100%;
            

        }

        #menu li:hover{
            background-color: #94D2B1;
        }

        #menu ul a{
            font-family: sans-serif;
            color: #fff;
            text-decoration:none;
            font-size:15px;
            line-height:32px;
            padding:10px 40px;
            display: block;

            
        }
        #menu ul li{
            float: left;
            position: relative;
            margin:0;
            padding:0;
            
        }
        #menu ul ul{
            position: absolute;
            background-color: #198754;
            color:#fff;
            top:100%;
            display: none;
            z-index: 100;

        }

        #menu ul li:hover > ul{
            display: block;
        }

        #menu ul ul li a{

        }
    </style>
    
</head>

    </style>
</head>

<body>
<div id="menu">
        <ul>
            <li><a style="font-size:20px"><i class="fa fa-briefcase logo-icon" style="margin:10px;"> </i>JICRCS </a></li>
            <div style="float:right;">
            <li> <a href="index.php">Home</a></li>
            <li><a href="#">Recommendation </a>
                <ul>
                    <li><a href="jobs.php">Jobs</a></li>
                    <li><a href="internship_collab.php">Internships</a></li>
                    <li><a href="courses.php">Courses</a></li>      
                </ul>
            </li>
            <li><a href="#">Dashboard </a>
                <ul>
                    <li><a href="jobs_colab.php">Jobs</a></li>
                    <li><a href="internship.php">Internships</a></li>
                    <li><a href="courses_colab.php">Courses</a></li>      
                </ul>
            </li>
            <li><a href="form.php"> Resume</a></li>
            <li><a href="#">About us </a></li>
            <li><a href=<?php echo "$href"; ?>><?php if (isset($_SESSION['name']) && !empty([$_SESSION['name']])) {
                        $name = $_SESSION['name'];
                        echo "$name";
                    } else {
                        echo "Login";
                    } ?></a>
                <ul>
                <li><a href="display_profile.php">View Profile</a></li>
                <li><a href="logout.php">Logut</a></li>
                </ul>
            </li>
                </div>
        </ul>  
    
</div>

    <br />
    <div class="container box">
        <br />
        <h2 align="center" style="margin-top:10px;">Detail Application Form</h2><br />
        <?php echo $message; ?>
        <form method="post" id="register_form">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Educational Qualification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Skill & Certification</a>
                </li>
            </ul>
            <div class="tab-content" style="margin-top:16px;">
                <div class="tab-pane active" id="login_details">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#198754; color:#fff">Personal Information</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Enter First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" />
                                <span id="error_fname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" />
                                <span id="error_lname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" id="dob" name="dob">
                                        <span id="error_birthday" class="text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Gender</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="Male" checked> Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="Female"> Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Enter Mobile No.</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" />
                                <span id="error_mobile_no" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter Address</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                                <span id="error_address" class="text-danger"></span>
                            </div>
                            <br />
                            <div align="center">
                                <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-success btn-lg">Next</button>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="personal_details">
                    <div class="panel panel-default">
                        <div class="panel-heading">Fill Educatinal Details</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>10th School Name</label>
                                <input type="text" name="sname" id="sname" class="form-control" />
                                <span id="error_sname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter CGPA</label>
                                <input type="text" name="snumber" id="snumber" class="form-control" />
                                <span id="error_snumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter 12th Junior College Name </label>
                                <input type="text" name="jname" id="jname" class="form-control" />
                                <span id="error_jname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter CGPA</label>
                                <input type="text" name="jnumber" id="jnumber" class="form-control" />
                                <span id="error_jnumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Diploma College Name</label>
                                <input type="text" name="dname" id="dname" class="form-control" />
                                <span id="error_dname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter CGPA</label>
                                <input type="text" name="dnumber" id="dnumber" class="form-control" />
                                <span id="error_dnumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Enter College Name</label>
                                <input type="text" name="cname" id="cname" class="form-control" />
                                <span id="error_cname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Enter CGPA</label>
                                        <input type="text" name="cnumber" id="cnumber" class="form-control" />
                                        <span id="error_cnumber" class="text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Enter Branch Name</label>
                                        <input type="text" name="bname" id="bname" class="form-control" />
                                        <span id="error_bname" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div align="center">
                                <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
                                <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-success btn-lg">Next</button>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact_details">
                    <div class="panel panel-default">
                        <div class="panel-heading">Fill Skills</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Add your Skills</label>
                                <input type="text" name="skill" id="skill" class="form-control" />
                                <span id="error_skill" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Add your Certification</label>
                                <input type="text" name="certificate" id="certificate" class="form-control" />
                                <span id="error_certificate" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Add your Interships</label>
                                <input type="text" name="intership" id="intership" class="form-control" />
                                <span id="error_intership" class="text-danger"></span>
                            </div>
                            <br />
                            <div align="center">
                                <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("./views/footer.php"); ?>
</body>

</html>

<script>
    $(document).ready(function() {

        $('#btn_login_details').click(function() {

            var error_fname = '';
            var error_lname = '';
            var error_address = '';
            var error_mobile_no = '';
            var mobile_validation = /^\d{10}$/;
            // var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($.trim($('#fname').val()).length == 0) {
                error_fname = 'First Name is required';
                $('#error_fname').text(error_fname);
                $('#fname').addClass('has-error');
            } else {
                error_fname = '';
                $('#error_fname').text(error_fname);
                $('#fname').removeClass('has-error');
            }

            if ($.trim($('#lname').val()).length == 0) {
                error_lname = 'Last Name is required';
                $('#error_lname').text(error_lname);
                $('#lname').addClass('has-error');
            } else {
                error_lname = '';
                $('#error_lname').text(error_lname);
                $('#lname').removeClass('has-error');
            }

            if ($.trim($('#mobile_no').val()).length == 0) {
                error_mobile_no = 'Mobile Number is required';
                $('#error_mobile_no').text(error_mobile_no);
                $('#mobile_no').addClass('has-error');
            } else {
                if (!mobile_validation.test($('#mobile_no').val())) {
                    error_mobile_no = 'Invalid Mobile Number';
                    $('#error_mobile_no').text(error_mobile_no);
                    $('#mobile_no').addClass('has-error');
                } else {
                    error_mobile_no = '';
                    $('#error_mobile_no').text(error_mobile_no);
                    $('#mobile_no').removeClass('has-error');
                }
            }
            if ($.trim($('#address').val()).length == 0) {
                error_address = 'Address is required';
                $('#error_address').text(error_address);
                $('#address').addClass('has-error');
            } else {
                error_address = '';
                $('#error_address').text(error_address);
                $('#address').removeClass('has-error');
            }
            if (error_fname != '' || error_lname != '' || error_address != '' || error_mobile_no != '') {
                return false;
            } else {
                $('#list_login_details').removeClass('active active_tab1');
                $('#list_login_details').removeAttr('href data-toggle');
                $('#login_details').removeClass('active');
                $('#list_login_details').addClass('inactive_tab1');
                $('#list_personal_details').removeClass('inactive_tab1');
                $('#list_personal_details').addClass('active_tab1 active');
                $('#list_personal_details').attr('href', '#personal_details');
                $('#list_personal_details').attr('data-toggle', 'tab');
                $('#personal_details').addClass('active in');
            }
        });

        $('#previous_btn_personal_details').click(function() {
            $('#list_personal_details').removeClass('active active_tab1');
            $('#list_personal_details').removeAttr('href data-toggle');
            $('#personal_details').removeClass('active in');
            $('#list_personal_details').addClass('inactive_tab1');
            $('#list_login_details').removeClass('inactive_tab1');
            $('#list_login_details').addClass('active_tab1 active');
            $('#list_login_details').attr('href', '#login_details');
            $('#list_login_details').attr('data-toggle', 'tab');
            $('#login_details').addClass('active in');
        });

        $('#btn_personal_details').click(function() {
            var error_sname = '';
            var error_snumber = '';
            var error_jname = '';
            var error_jnumber = '';
            var error_cname = '';
            var error_cnumber = '';
            var error_bname = '';
            if ($.trim($('#sname').val()).length == 0) {
                error_sname = '10th School Name is required';
                $('#error_sname').text(error_sname);
                $('#sname').addClass('has-error');
            } else {
                error_sname = '';
                $('#error_sname').text(error_sname);
                $('#sname').removeClass('has-error');
            }

            if ($.trim($('#snumber').val()).length == 0) {
                error_snumber = 'CGPA is required';
                $('#error_snumber').text(error_snumber);
                $('#snumber').addClass('has-error');
            } else {
                error_snumber = '';
                $('#error_snumber').text(error_snumber);
                $('#snumber').removeClass('has-error');
            }

            if ($.trim($('#cname').val()).length == 0) {
                error_cname = 'College Name is required';
                $('#error_cname').text(error_cname);
                $('#cname').addClass('has-error');
            } else {
                error_cname = '';
                $('#error_cname').text(error_cname);
                $('#cname').removeClass('has-error');
            }

            if ($.trim($('#cnumber').val()).length == 0) {
                error_cnumber = 'CGPA is required';
                $('#error_cnumber').text(error_cnumber);
                $('#cnumber').addClass('has-error');
            } else {
                error_cnumber = '';
                $('#error_cnumber').text(error_cnumber);
                $('#cnumber').removeClass('has-error');
            }

            if ($.trim($('#bname').val()).length == 0) {
                error_bname = 'Branch is required';
                $('#error_bname').text(error_bname);
                $('#bname').addClass('has-error');
            } else {
                error_bname = '';
                $('#error_bname').text(error_bname);
                $('#bname').removeClass('has-error');
            }

            if (error_sname != '' || error_snumber != '' || error_jname != '' || error_jnumber != '' || error_cname != '' || error_cnumber != '' || error_bname != '') {
                return false;
            } else {
                $('#list_personal_details').removeClass('active active_tab1');
                $('#list_personal_details').removeAttr('href data-toggle');
                $('#personal_details').removeClass('active');
                $('#list_personal_details').addClass('inactive_tab1');
                $('#list_contact_details').removeClass('inactive_tab1');
                $('#list_contact_details').addClass('active_tab1 active');
                $('#list_contact_details').attr('href', '#contact_details');
                $('#list_contact_details').attr('data-toggle', 'tab');
                $('#contact_details').addClass('active in');
            }
        });

        $('#previous_btn_contact_details').click(function() {
            $('#list_contact_details').removeClass('active active_tab1');
            $('#list_contact_details').removeAttr('href data-toggle');
            $('#contact_details').removeClass('active in');
            $('#list_contact_details').addClass('inactive_tab1');
            $('#list_personal_details').removeClass('inactive_tab1');
            $('#list_personal_details').addClass('active_tab1 active');
            $('#list_personal_details').attr('href', '#personal_details');
            $('#list_personal_details').attr('data-toggle', 'tab');
            $('#personal_details').addClass('active in');
        });

        $('#btn_contact_details').click(function() {
            var error_skill = '';
            var error_certificate = '';
            var error_intership = '';
            if ($.trim($('#skill').val()).length == 0) {
                error_skill = 'Skill is required';
                $('#error_skill').text(error_skill);
                $('#skill').addClass('has-error');
            } else {
                error_skill = '';
                $('#error_skill').text(error_skill);
                $('#skill').removeClass('has-error');
            }


            if (error_skill != '') {
                return false;
            } else {
                $('#btn_contact_details').attr("disabled", "disabled");
                $(document).css('cursor', 'prgress');
                $("#register_form").submit();
            }

        });

    });
    </script>