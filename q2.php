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

# Illustrates a query with static values
#  and returns a row of value using MySQL

$host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "premiere";
  $con=mysqli_connect($host, $user, $password, $dbname);
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MariaDB: " . mysqli_connect_error();
    exit;
  }


  $querystring= "SELECT a.customername a, b.customername b FROM customer AS a INNER JOIN customer AS b ON a.repnum = b.repnum AND a.customernum < b.customernum GROUP BY a.customernum, b.customernum order by a.customername ASC, b.customername ASC";

  $result = mysqli_query($con, $querystring);

   
  if (!$result) {
    print ( "Could not successfully run query ($querystring) from DB: " . mysqli_error($con));
    exit;
  }

  if (mysqli_num_rows($result) == 0) {
    print ("No rows found for customer number $repnum <br>");
    exit;
  }

  if ( mysqli_num_rows($result) > 0 ) {
    // output the query result
    while($row = $result->fetch_assoc()) {
      echo 
      $row["a"]. " - ". 
      $row["b"]. " " .   
      "<br>";
  }
  
  }
  else {
    // Query not successful
    die("Sorry, Query has some error.");
  }
?>