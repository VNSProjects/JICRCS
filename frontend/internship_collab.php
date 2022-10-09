<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
error_reporting(E_ERROR | E_PARSE);
$email = '';
$email = $_SESSION['email'];
#echo "$email";
$skill = '';
$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$sql = $pdo->prepare('select skill from user_details where email=:email');
$sql->execute(array(':email' => $email));
while ($row = $sql->fetch()) {
    $skill = $row['skill'];
}
// echo "$email";
require_once("./views/component.php");

if (isset($_SESSION['name']) && !empty([$_SESSION['name']])) {
    $href = "form.php";
} else {
    $href = "login.php";
}

$count = 0;
$count2 = 0;

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $pdo->prepare('select * from user_details where email=:email');
$sql->execute(array(':email' => $email));
$count = $sql->rowCount();
#echo "$count";

$pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $pdo->prepare('select * from JobsCollab');
$sql->execute();
$count2 = $sql->rowCount();
#echo "$count2";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended jobs</title>
    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

    <script src="https://use.fontawesome.com/8a9ed0e933.js"></script>
    <!--Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS bundle-->
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;900&display=swap" rel="stylesheet">


    <script src="index.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        #menu {}

        #menu>ul {
            background-color: #198754;
        }

        #menu ul {
            list-style: none;
            position: relative;
            margin: 0;
            padding: 0;
            float: right;
            width: 100%;


        }

        #menu li:hover {
            background-color: #94D2B1;
        }

        #menu ul a {
            font-family: sans-serif;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            line-height: 32px;
            padding: 10px 40px;
            display: block;


        }

        #menu ul li {
            float: left;
            position: relative;
            margin: 0;
            padding: 0;

        }

        #menu ul ul {
            position: absolute;
            background-color: #198754;
            color: #fff;
            top: 100%;
            display: none;
            z-index: 100;

        }

        #menu ul li:hover>ul {
            display: block;
        }

        #menu ul ul li a {}
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
    <div class="container-fluid">
        <div class="row align-items">
            <?php
            // if(!isset($_SESSION)){  //CHECK THIS CONDITION 
            //     echo "<div class=\"alert alert-danger m-4 w-100\" role=\"alert\">
            //     <h3> <strong>Please Login before proceeding </strong> </h3>
            //     <a href=\"login.php\">Login</a>
            //   </div>";
            // }
            // if($count == 0){
            //     echo "<div class=\"alert alert-danger m-4 w-100\" role=\"alert\">
            //     <h3> <strong>Please create Profile before proceeding </strong> </h3>
            //     <a href=\"form.php\">Create Profile</a>
            //     <br>OR <br>
            //     <h3><Strong>Directly search jobs </strong></h3>
            //     <a href=\"index.php\">Search Jobs</a>
            //   </div>";
            // }
            if ($count2 == 0) {
                $link = 'python E:\xampp\htdocs\JICRCS\BackEnd\sources\jobs_colab.py '. $email;
                #echo "$link";
                $output = shell_exec($link);
                echo "$output";
                $pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->query("SELECT * FROM intsCollab");
                while ($row = $stmt->fetch()) {
                    component($row['title'], $row['company'], $row['location'], $row['id']);
                    // $id = $row['id'];
                    // $position = $row['jobstitle'];
                    // $companyName  = $row['companyname'];
                    // $location = $row['location'];
                    // $link = $$row['empType'];
                    
                }
            } else {
                $pdo = new PDO('mysql:host=localhost;dbname=JICRCS', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->query("SELECT * FROM intscollabs");
                while ($row = $stmt->fetch()) {
                    component($row['title'], $row['company'], $row['location'], $row['id']);
                              
                }
            }

            ?>
        </div>
    </div>
    <?php include('views/footer.php') ?>
</body>

</html>