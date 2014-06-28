<!DOCTYPE HTML> 
<html>
<head>
  <style type="text/css">
#registration-form {background: #FDFDFD;width: 400px;padding: 20px;margin-right: auto;margin-left: auto;border: 1px solid #E9E9E9;border-radius: 10px;}
</style>
</head>
<body> 

<?php

  $db_host="localhost"; // Host name 
  $db_username="root"; // Mysql username 
  $db_password=""; // Mysql password 
  $db_name="resfeberlabs"; // Database name 

  $con = mysqli_connect("$db_host", "$db_username", "$db_password")or die("cannot connect"); 
  mysqli_select_db($con, "$db_name");
  if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $trackIDErr = $trackID = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["trackID"])) {
     $trackIDErr = "Please enter a valid number";
   } else {
     $trackID = test_input($_POST["trackID"]);
     } 
   }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

<h2 align = "center"><div id="registration-form">
  Tracking Information
</div></h2>
<div id="registration-form">
  <?php
  $sql = "SELECT * FROM order_details WHERE `order_id` = '$trackID'";
  $resource = mysqli_query($con, $sql);
  $order_details = array();
  while($row = mysqli_fetch_assoc($resource)){
   $order_details[] = $row;
  }
    if (mysqli_num_rows($resource) == 0){
      echo "Please enter a valid number";
    }
    else if (!$trackIDErr && $trackID && $resource){
      if (!mysqli_query($con, $sql)) {
         die('Error: ' . mysqli_error($con));
      }
      foreach($order_details as $item):
        echo "Order Number: ";
        echo $item['order_id'];
        echo "<br>";
        echo "<br>";
        echo "Source Location: ";
        echo $item['start_location'];
        echo "<br>";
        echo "<br>";
        echo "Destination Location: ";
        echo $item['end_destination'];
        echo "<br>";
        echo "<br>";
        echo "Order Date: ";
        echo DATE($item['order_date']);
        echo "<br>";
        echo "<br>";
        echo "Pickup Time: ";
        $sql2 = "SELECT DATE('pickup_datetime') FROM order_details WHERE now() > drop_datetime AND `order_id` = '$trackID'";
        $resource2 = mysqli_query($con, $sql2);
        $order_details2 = array();
        while($row2 = mysqli_fetch_assoc($resource2)){
          $order_details2[] = $row;
        }
        if (mysqli_num_rows($resource2) == 0){
          echo "The order has not been picked up.";
        }
        else{
          echo $item['pickup_datetime'];
        }
        echo "<br>";
        echo "<br>";
        echo "Drop Time: ";
        $sql1 = "SELECT drop_datetime FROM order_details WHERE now() > drop_datetime AND `order_id` = '$trackID'";
        $resource1 = mysqli_query($con, $sql1);
        $order_details1 = array();
        while($row1 = mysqli_fetch_assoc($resource1)){
          $order_details1[] = $row;
        }
        if (mysqli_num_rows($resource1) == 0){
          echo "-";
          echo "<br>";
          echo "<br>";
          echo "Status: In Transit";
        }
        else{
          echo $item['drop_datetime'];
          echo "<br>";
          echo "<br>";
          echo "Status: Delivered";
        }
      endforeach;
   }
   else
    echo "Please enter a valid number";
?>
</div>



</body>
</html>