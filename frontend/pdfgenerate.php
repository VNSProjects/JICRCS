<?Php
session_start();
$email = $_SESSION['email'];
$pass = $_SESSION['password'];

$fullname = $_SESSION['name'];

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$dob=  $_SESSION['dob'];
$gender  =  $_SESSION['gender'];
$mobile_no =  $_SESSION['mobile_no'];
$address  =  $_SESSION['address'];
$sname = $_SESSION['sname'];
$snumber = $_SESSION['snumber'];
$jname = $_SESSION['jname'];
$jnumber = $_SESSION['jnumber'];
$dname = $_SESSION['dname'];
$dnumber = $_SESSION['dnumber'];
$cname = $_SESSION['cname'];
$cnumber = $_SESSION['cnumber'];
$bname = $_SESSION['bname'];
$skill = $_SESSION['skill'];
$certificate = $_SESSION['certificate'];
$intership = $_SESSION['intership'];

require('fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Cell(80,10,"$email");
// $pdf->Cell(100,20,"$pass");
// $pdf->Output('my_file.pdf','I'); // Send to browser and display

// Logo

    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(160,10,'CURRICULUM-VITAE');
 $pdf->Ln(8);
     // Move to the right
   $pdf->Cell(151);
     // Title
//   $pdf->Cell(39,50,'photo',1,0,'C');
     // Line break
 $pdf->Ln(10); 
 
 $pdf->SetFont("Arial","B",14);
 
 
 $pdf->Ln(8);
 $pdf->Cell(40,10,$fullname);
 $pdf->Ln(8);
 $pdf->Cell(40,10,$mobile_no);
 $pdf->Ln(8);
 $pdf->Cell(40,10,$email);
 $pdf->Ln(8);
 
 $pdf->Cell(40,10,$address);
 $pdf->Ln(20); 
 
 $pdf->Cell(40,10,'I am looking forward to an existing and challenging career with ');
 $pdf->Ln(8);
 
 $pdf->Cell(40,10,'an organization that has providing good working environment ');
 $pdf->Ln(8);
 
 
 $pdf->Cell(40,10,'and excellent opportunity for mutual growth and continuous ');
 $pdf->Ln(8);
 $pdf->Cell(40,10,'update my professional skills.');
 $pdf->Ln(20);
 $pdf->Cell(40,10,'10th Details:');
 $pdf->Ln(8);
//  $pdf->Cell(90,10,"10th:",1,0);
//  $pdf->Cell(90,10,"Details",1,1);
 
 $pdf->Cell(90,10,"Year passed :",1,0);
 $pdf->Cell(90,10,"2016",1,1);
 
 
 $pdf->Cell(90,10,"Percentage :",1,0);
 $pdf->Cell(90,10,$snumber,1,1);
 $pdf->Cell(90,10,"School Name:",1,0);
 $pdf->Cell(90,10,$sname,1,1);
 
 
 $pdf->Ln(14);
 
 $pdf->Cell(40,10,'12th Details:');
 $pdf->Ln(8);
//  $pdf->Cell(90,10,"12th:",1,0);
//  $pdf->Cell(90,10,"Details",1,1);
 
 $pdf->Cell(90,10,"Year passed :",1,0);
 $pdf->Cell(90,10,'2018',1,1);
 
 
 $pdf->Cell(90,10,"Percentage :",1,0);
 $pdf->Cell(90,10,$jnumber,1,1);
 
 $pdf->Cell(90,10,"College Name:",1,0);
 $pdf->Cell(90,10,$jname,1,1);
 
 
 $pdf->Ln(16); 
 
 $pdf->Cell(40,10,'Graduation Dtails:');
 $pdf->Ln(8);
//  $pdf->Cell(90,10,"Graduation:",1,0);
//  $pdf->Cell(90,10,"Details",1,1);
 
 $pdf->Cell(90,10,"Year passed :",1,0);
 $pdf->Cell(90,10,'2022',1,1);
 
 
 $pdf->Cell(90,10,"Percentage :",1,0);
 $pdf->Cell(90,10,$cnumber,1,1);
 $pdf->Cell(90,10,"College Name:",1,0);
 $pdf->Cell(90,10,$cname,1,1);
 $pdf->Cell(90,10,"Dept",1,0);
 $pdf->Cell(90,10,$bname,1,1);
 $pdf->Cell(90,10,"Skill",1,0);
 $pdf->Cell(90,10,$skill,1,1);
 $pdf->Cell(90,10,"Internship",1,0);
 $pdf->Cell(90,10,$intership,1,1);
 $pdf->Ln(20);
 
 
 $pdf->Cell(50,10,'Hobies:');
 $pdf->Cell(20,10,'Reading'); 
 $pdf->Cell(10,10,","); 
 $pdf->Cell(10,10,'Cycling');
 $pdf->Ln(10);
//  $pdf->Cell(50,10,'Drawing');
//  $pdf->Cell(10,10,",");
//  $pdf->Cell(10,10,'Swimming');
//  $pdf->Ln(25);
 
 
 $pdf->Ln(20);
 $pdf->Cell(40,10,'PERSONAL DTAILS');
 $pdf->Ln(25);
 $pdf->Cell(50,5,'Full Name:');
 $pdf->Cell(50,5, $fullname);
 $pdf->Ln(15);
 
 $pdf->Cell(70,5,'Permanent address:');
 $pdf->Cell(70,5, $address);
 $pdf->Ln(15);
 
//  $pdf->Cell(50,5,'Hobies:');
//  $pdf->Cell(50,5,'$hobies1');
 
 $pdf->Ln(15);
 $pdf->Cell(50,5,'Dob:');
 $pdf->Cell(50,5, $dob);
 $pdf->Ln(15);
 
 $pdf->Cell(50,5,'Gender:');
 $pdf->Cell(50,5, $gender);
 $pdf->Ln(25);
 $pdf->Cell(50,5,'Date: ');
 $pdf->Ln(8);
 $pdf->Cell(50,5,'Place: ');
 $pdf->Ln(8);
 $pdf->Cell(50,5,'signature: '); 
 
 $pdf->output();

?>
