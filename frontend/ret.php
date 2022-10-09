<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sinfo";
//$conn = new PDO("mysql:host=localhost;dbname=sinfo", "root", "");
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  * FROM sdetails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo  " - Details: " . $row["fname"]. " " . $row["lname"]. " " . $row["dob"]. " " . $row["gender"]. " " . $row["address"]. " " . $row["sname"]. " " . $row["snumber"]. " " . $row["jname"]. " " . $row["jnumber"]. " " . $row["dname"]. " " . $row["dnumber"]. " " . $row["cname"]. " " . $row["cnumber"]. " " . $row["bname"]. " " . $row["skill"]. " " . $row["certificate"]. " " . $row["intership"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>
