<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$connect = new PDO("mysql:host=localhost;dbname=JICRCS", "root", "");
$message = '';
$usermame = $_SESSION['name'];
$email = $_SESSION['email'];
$conn = new mysqli("localhost","root","","JICRCS");
if (isset($_SESSION['name']) && !empty([$_SESSION['name']])) {
    $href = "form.php";
} else {
    $href = "login.php";
}
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
$fname = '';
$lname = '';
$dob = '';
$gender = '';
$mobile_no = '';
$address = '';
$sname = '';
$snumber = '';
$jname = '';
$jnumber = '';
$dname = '';
$dnumber = '';
$cname = '';
$cnumber = '';
$bname = '';
$skill = '';
$certificate = '';
$intership = '';
$sql = "SELECT * FROM user_details WHERE email='$email'";   
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row= $result->fetch_assoc()){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $mobile_no = $row['mobile_no'];
        $address = $row['address'];
        $sname = $row['sname'];
        $snumber = $row['snumber'];
        $jname = $row['jname'];
        $jnumber = $row['jnumber'];
        $dname = $row['dname'];
        $dnumber = $row['dnumber'];
        $cname = $row['cname'];
        $cnumber = $row['cnumber'];
        $bname = $row['bname'];
        $skill = $row['skill'];
        $certificate = $row['certificate'];
        $intership = $row['intership'];
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
        .box {
            width: 800px;
            margin: 0 auto;
        }

        .active_tab1 {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        .inactive_tab1 {
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }

        .has-error {
            border-color: #cc0000;
            background-color: #ffff99;
        }

        <style>
        .box {
            width: 800px;
            margin: 0 auto;
        }

        .active_tab1 {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        .inactive_tab1 {
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }

        .has-error {
            border-color: #cc0000;
            background-color: #ffff99;
        }

        <style>
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
                    <li><a href="internship.php">Internships</a></li>
                    <li><a href="courses.php">Courses</a></li>      
                </ul>
            </li>
            <li><a href="#">Dashboard </a>
                <ul>
                    <li><a href="jobs_colab.php">Jobs</a></li>
                    <li><a href="internship_collab.php">Internships</a></li>

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
        <h2 align="center" style="margin-top:70px;"><strong>View your Profile</strong></h2><br />
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
                                <label>First Name</label>
                                <h4><?php echo $fname ?></h4>
                                <span id="error_fname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <h4><?php echo $lname ?></h4>
                                <span id="error_lname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="dob">Date of Birth:</label>
                                        <h5 style="display:inline;"><?php echo $dob ?></h5>
                                        <span id="error_birthday" class="text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Gender</label>
                                        <h5 style="display:inline;"><?php echo $gender ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Mobile No.</label>
                                <h4><?php echo $mobile_no ?></h4>
                                <span id="error_mobile_no" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <h4><?php echo $address ?></h4>
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
                        <div class="panel-heading">Educatinal Details</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>10th School Name</label>
                                <h4><?php echo $sname ?></h4>
                                <span id="error_sname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Percentage</label>
                                <h4><?php echo $snumber ?></h4>
                                <span id="error_snumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>12th Junior College Name </label>
                                <h4><?php echo $jname ?></h4>
                                <span id="error_jname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Percentage</label>
                                <h4><?php echo $jnumber ?></h4>
                                <span id="error_jnumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Diploma College Name</label>
                                <h4><?php echo $dname ?></h4>
                                <span id="error_dname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Percentage</label>
                                <h4><?php echo $dnumber ?></h4>
                                <span id="error_dnumber" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Degree College Name</label>
                                <h4><?php echo $cname?></h4>
                                <span id="error_cname" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Enter CGPA</label>
                                        <h4><?php echo $cnumber ?></h4>
                                        <span id="error_cnumber" class="text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Branch Name</label>
                                        <h4><?php echo $bname ?></h4>
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
                        <div class="panel-heading"> Skills</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Your Skills</label>
                                <h4><?php echo $skill ?></h4>
                                <span id="error_skill" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Your  Certification</label>
                                <h4><?php echo $certificate ?></h4>
                                <span id="error_certificate" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Your Interships</label>
                                <h4><?php echo $intership ?></h4>
                                <span id="error_intership" class="text-danger"></span>
                            </div>
                            <br />
                            <div align="center">
                                <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                <!-- <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg"><a href="" style="text-decoration: none;;">Update</a></button> -->
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

            
                error_fname = '';
                $('#error_fname').text(error_fname);
                $('#fname').removeClass('has-error');
            
                error_lname = '';
                $('#error_lname').text(error_lname);
                $('#lname').removeClass('has-error');
            
                error_mobile_no = '';
                $('#error_mobile_no').text(error_mobile_no);
                $('#mobile_no').removeClass('has-error');    
            
                error_address = '';
                $('#error_address').text(error_address);
                $('#address').removeClass('has-error');

                $('#list_login_details').removeClass('active active_tab1');
                $('#list_login_details').removeAttr('href data-toggle');
                $('#login_details').removeClass('active');
                $('#list_login_details').addClass('inactive_tab1');
                $('#list_personal_details').removeClass('inactive_tab1');
                $('#list_personal_details').addClass('active_tab1 active');
                $('#list_personal_details').attr('href', '#personal_details');
                $('#list_personal_details').attr('data-toggle', 'tab');
                $('#personal_details').addClass('active in');
            
            
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
            
                error_sname = '';
                $('#error_sname').text(error_sname);
                $('#sname').removeClass('has-error');
            
                error_snumber = '';
                $('#error_snumber').text(error_snumber);
                $('#snumber').removeClass('has-error');
            
                error_cname = '';
                $('#error_cname').text(error_cname);
                $('#cname').removeClass('has-error');
            
                error_cnumber = '';
                $('#error_cnumber').text(error_cnumber);
                $('#cnumber').removeClass('has-error');
            
                error_bname = '';
                $('#error_bname').text(error_bname);
                $('#bname').removeClass('has-error');
            

           
                $('#list_personal_details').removeClass('active active_tab1');
                $('#list_personal_details').removeAttr('href data-toggle');
                $('#personal_details').removeClass('active');
                $('#list_personal_details').addClass('inactive_tab1');
                $('#list_contact_details').removeClass('inactive_tab1');
                $('#list_contact_details').addClass('active_tab1 active');
                $('#list_contact_details').attr('href', '#contact_details');
                $('#list_contact_details').attr('data-toggle', 'tab');
                $('#contact_details').addClass('active in');
            
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
            
                error_skill = '';
                $('#error_skill').text(error_skill);
                $('#skill').removeClass('has-error');
            
                $('#btn_contact_details').attr("disabled", "disabled");
                $(document).css('cursor', 'prgress');
                $("#register_form").submit();
            

        });

    });
</script>