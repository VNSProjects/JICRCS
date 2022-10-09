<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_SESSION['name']) && !empty([$_SESSION['name']])) {
    $href = "form.php";
} else {
    $href = "login.php";
}

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table jobsdata";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table intsdata";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table courses";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table jobsR";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table internsR";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table courseR";
$statement = $pdo->prepare($sql);
$statement->execute();

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "truncate table JobsCollab";
$statement = $pdo->prepare($sql);
$statement->execute();



if (isset($_POST['submit'])) {

    //$_SESSION['title'] = $_POST['title'];
    //$_SESSION['category'] = $_POST['category'];
    //$_SESSION['location'] = $_POST['location'];

    $t = $_POST['title'];
    $title = str_replace(" ", "%", $t);
    $location = $_POST['location'];
    $category = $_POST['category'];


    if (strcmp("Jobs", $category) == 0) {
        $link = 'python E:\xampp\htdocs\JICRCS\FrontEnd\jobs.py ' . $title . " " . $location;
        $output = shell_exec($link);
        echo "$output";
    }

    if (strcmp("Internships", $category) == 0) {
        $link = 'python E:\xampp\htdocs\JICRCS\FrontEnd\internshipss.py ' . $title . " " . $location;
        $output = shell_exec($link);
        echo "$output";
    }

    if (strcmp("Courses", $category) == 0) {

        $link = 'python E:\xampp\htdocs\JICRCS\FrontEnd\linkedin.py ' . $title;
        $output = shell_exec($link);
        echo $output;
    }
    header("Location:dashboard.php?id=" . $category);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JICRCS</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

    <script src="https://use.fontawesome.com/8a9ed0e933.js"></script>
    <!--Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS bundle-->
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <script>
        function changeFunc() {
        var selectBox = document.getElementById("category");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue === "Courses"){
        document.getElementById("location").disabled = true;
        }
}
    </script>

    <script src="index.js"></script>

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
            <li><a href="pdfgenerate.php"> Resume</a></li>
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


        <div class="container-fluid">
            <div class="search-img row">
                <div class="col-md-6 header-content">
                    <h1><strong>Find your job & make sure goal.</strong></h1>
                    <h4>Your dream job is waiting for you</h4>
                    <form action="" method="POST">
                        <div class="input-bg">
                            <input type="text" class="ip1" name="title" placeholder="Title">
                            <input type="text" class="ip2" name="location" placeholder="Location" id="location">
                            
                                <select onchange="changeFunc();" style="background-color:#198754;color:white;margin-left:15px;height:40px;text-align:center;" name="category" id="category">
                                    <option value="" hidden>Select Category</option>
                                    <option value="Jobs">Jobs</option>
                                    <option value="Internships">Internships</option>
                                    <option value="Courses">Courses</option>
                                </select>
                                                                                                     

                            <button class="btn btn-success" style="display:inline;background-color:#198754" type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 overflow-hidden">
            <div class="container ">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner mt-5">
      <div class="item active">
        <img src="./images/job.gif" alt="Los Angeles" style="width:70%;height:500px;">
      </div>

      <div class="item">
        <img src="./images/intern.gif" alt="Chicago" style="width:70%;height:500px;">
      </div>
    
      <div class="item">
        <img src="./images/courses.gif" alt="New york" style="width:70%;height:500px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
      <!-- <span class="sr-only">Previous</span> -->
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <!-- <span class="glyphicon glyphicon-chevron-right"></span> -->
      <!-- <span class="sr-only">Next</span> -->
    </a>
  </div>
</div>

        </div>
    </section>



    <section id="cards-info">
        <div class="container-fluid">
            <div class="row cards">
                <div class="col-md-3 text-center">
                    <img src="./images/pikcon.png" alt="" style="display: inline;">
                    <h2 class="card-title mt-3" style="margin-left: 50px;">Account</h2>
                    <h6 class="card-text">First you have to create a account in there</h6>
                </div>
                <div class="col-md-3 text-center">
                    <img src="./images/bl.png" alt="">
                    <h2 class="card-title mt-3" style="margin-left: 50px;">CV/Resume</h2>
                    <h6 class=" card-text">For a job you have to create a Resume</h6>
                </div>
                <div class="col-md-3 text-center">
                    <img src="./images/GR.png">
                    <h2 class="card-title mt-3" style="margin-left: 50px;">Quick Jobs</h2>

                    <h6 class=" card-text">You will be recommended jobs and you can also search for jobs</h6>
                </div>
                <div class="col-md-3 text-center">
                    <img src="./images/purple.png" alt="" srcset="">
                    <h2 class="card-title mt-3" style="margin-left: 50px;">Apply them</h2>
                    <h6 class=" card-text">Finally you can apply to the job and enjoy work</h6>
                </div>
            </div>
        </div>
    </section>

    <section id="" style="background-color: #e7e9f0; height: 600px;">
        <h1 class="text-center" style="padding: 50px;"> TRENDING JOBS</h1>
        <div class="row text-left" style="padding: 3% 15%;">
            <div class="col-md-4">
                <div class="card" style="width: 30rem;padding:20px;">

                    <div class="card-body">
                        <h5 class="card-title">Software Engineer, iOS Mobile Apps</h5>
                        <p class="card-text">Company:Google <br>Location:Banglore,India</p>
                        <a href="https://www.linkedin.com/jobs/view/2701310327/?alternateChannel=search&refId=IxrrwmRwhTUf%2BEf%2FDiBLfw%3D%3D&trackingId=AbmwJ1MuoVn72HIxSs5aYQ%3D%3D" class="btn btn-success">View Job</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 30rem;padding:20px;">

                    <div class="card-body">
                        <h5 class="card-title">Software Development Engineer</h5>
                        <p class="card-text">Company:Amazon <br>Location:Bengluru,India </p>
                        <a href="https://www.linkedin.com/jobs/view/2726800615/?alternateChannel=search&refId=KmIWGzskWwmDX%2B4LiYSKng%3D%3D&trackingId=4HhiPEEruilBynfeJGWz0g%3D%3D" class="btn btn-success">View Job</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 30rem;padding:20px;">

                    <div class="card-body">
                        <h5 class="card-title">Software Engineer I A - GBS IND</h5>
                        <p class="card-text">Company:Bank of America <br>Location:Mumbai,India</p>
                        <a href="https://www.linkedin.com/jobs/view/2766835802/?alternateChannel=search&refId=tznjBq1dzme%2BbVocNZ%2FNhQ%3D%3D&trackingId=UbY5J9zmb6Fn9PMXr2KdKA%3D%3D" class="btn btn-success">View Job</a>
                    </div>
                </div>

            </div>

    </section>

    <?php include('views/footer.php') ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
</body>



</html>