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
$order_number = isset($_POST['order_number']) ? $_POST['order_number'] : ''; // Reading Input

  if (!($order_number)){
    //Form to enter the user input
 print <<<_HTML_
 <FORM method="POST" action="{$_SERVER['PHP_SELF']}">
 <br>
 Order Number: <input type="text" name="order_number" size="9" value="$order_number">
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

$querystring = "SELECT customernum FROM orders WHERE ordernum = '$order_number'";
$result = mysqli_query($con, $querystring);

if ($obj = @mysqli_fetch_object($result) ) {
    $customernum = $obj->customernum;
    $querystring2 = "SELECT customername FROM customer WHERE customernum = '$customernum'";
    $result2 = mysqli_query($con, $querystring2);
}

if (!$result) {
    print ("Could not successfully run query ($querystring) from DB.");
    exit;
  }

  if (mysqli_num_rows($result) == 0) {
    print ("No customer found for order number {$order_number}.<br>");
    exit;
  }
 
  if ($obj2 = @mysqli_fetch_object($result2) ) {
    $customername = $obj2->customername;
    print("Output for order number: $order_number <br>");
    print(" Customer Name: $customername <br>");
  }

  else {
    // Query not successful
    die("Sorry, Query has some error.<br>");
  }



  $querystring3 = "SELECT COUNT(*) as total FROM orderline WHERE ordernum = '$order_number'";
  $result3 = mysqli_query($con, $querystring3);

  $data=mysqli_fetch_assoc($result3);
  print ("Number of order line items: {$data['total']} <br>" );
 
if (!$result3) {
    print ("Could not successfully run query ($querystring3) from DB.");
    exit;
  }


$querystring4 = "SELECT SUM(numordered * quotedprice) as total1 FROM orderline WHERE ordernum = '$order_number'";
$result4 = mysqli_query($con, $querystring4);

$data2=mysqli_fetch_assoc($result4);
print (" Total bill value: $ {$data2['total1']}" );
 
if (!$result4) {
    print ( "Could not successfully run query ($querystring4) from DB.");
    exit;
  }

}
?>