<?php
 /*
========================================================
Name: Joseph Pietroluongo
Panther-ID: 590-17-49
Course: COP 4722
Assignment#: 3
Due: Tue, Oct 27, 2020
I hereby certify that this work is my own and none of
it is the work of any other person.
Signature: Joseph Pietroluongo
=========================================================
*/   
$rep_number = isset($_POST['rep_number']) ? $_POST['rep_number'] : ''; // Reading Input

  if (!($rep_number))
  {
    // printing the form to enter the user input
 print <<<_HTML_
 <FORM method="POST" action="{$_SERVER['PHP_SELF']}">
 <br>
 Rep Number: <input type="text" name="rep_number" size="9" value="$rep_number">
 <br/>
 <br>
 <INPUT type="submit" value=" Submit ">
 </FORM>
_HTML_;
  }

  else {
    $host = "localhost";
    $user="root";
    $password="";
    $dbname = "premiere";
    $con=mysqli_connect($host, $user, $password, $dbname);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MariaDB: " . mysqli_connect_error();
      exit;
    }

$querystring = "SELECT firstname, lastname FROM rep WHERE repnum = '$rep_number'";
$result = mysqli_query($con, $querystring);

if (!$result) {
    print ( "Could not successfully run query ($querystring) from DB.");
    exit;
  }
 
 if (mysqli_num_rows($result) == 0) {
    print ("No rep is found for rep number {$rep_number}.<br>");
    exit;
  }

  if ( $obj = @mysqli_fetch_object($result) ) {
    $lastname = $obj->lastname;
    $firstname = $obj->firstname;
    print(" Rep's name: $firstname $lastname <br>");
  }

  else {
    // Query not successful
    die("Sorry, Query has some error.<br>");
  }


$querystring2 = "SELECT customername FROM customer WHERE repnum = '$rep_number'";
$result2 = mysqli_query($con, $querystring2);

$post=array();
while($row = mysqli_fetch_assoc($result2)){
  $posts[]=$row;
}

printf("Customers: <br>");
foreach ($posts as $row){
  foreach ($row as $element){
    echo $element."<br>";
  }
}


$querystring3 = "SELECT customernum FROM customer WHERE repnum = '$rep_number'";
$result3 = mysqli_query($con, $querystring3);

$post1=array();
while($row1 = mysqli_fetch_assoc($result3)){
  $posts1[]=$row1;
}

$querystring4 = "SELECT SUM(numordered * quotedprice) as total FROM orderline where ordernum = 21614 or ordernum = 21613";
$result4 = mysql_fetch_assoc($querystring4);
echo $result4["tagID"];
print("Total revenue: $result4" );


}
?>