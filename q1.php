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

$customer_number = isset($_POST['customer_number']) ? $_POST['customer_number'] : ''; // Reading Input

  if (!($customer_number)){
    //Form to enter the user input
 print <<<_HTML_
 <FORM method="POST" action="{$_SERVER['PHP_SELF']}">
 <br>
 Customer Number: <input type="text" name="customer_number" size="9" value="$customer_number">
 <br/>
 <br>
 <INPUT type="submit" value=" Submit ">
 </FORM>
_HTML_;
  }

  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "premiere";
  $con=mysqli_connect($host, $user, $password, $dbname);
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MariaDB: " . mysqli_connect_error();
    exit;
  }

  $querystring= "SELECT c.customername, r.firstname, r.lastname, count(DISTINCT ordernum) FROM rep r, customer c, orders o WHERE c.customernum = $customer_number and c.repnum = r.repnum and o.customernum = c.customernum";
  $result = mysqli_query($con, $querystring);

  print("Output for customer number: $customer_number \n");
   
  if (!$result) {
    
    exit;
  }

  else if (mysqli_num_rows($result) == 0) {
    print ("No rows found for customer number $customer_number <br>");
    exit;
  }

  else if ( mysqli_num_rows($result) > 0 ) {
    while($row = $result->fetch_assoc()) {
      echo "<br> 
      Customer name: ". $row["customername"]. "<br> " . 
      "Rep's name: ". $row["firstname"] . " " . $row["lastname"] . "<br> " .
      "Total number of orders: ". $row["count(DISTINCT ordernum)"]  . "<br> " .      
      "<br>";
  }
  
  }
  else {
    // Query not successful
    die("Sorry, Query has some error.");
  }
?>

