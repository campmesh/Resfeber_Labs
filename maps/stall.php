<!DOCTYPE HTML> 
<html>
<head>
  <style type="text/css">
#registration-form {background: #FDFDFD;width: 400px;padding: 20px;margin-right: auto;margin-left: auto;border: 1px solid #E9E9E9;border-radius: 10px;}
</style>
</head>
<body> 
<div id="registration-form">
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

  $sql1 = "SELECT * FROM dummy_loc ORDER BY id DESC LIMIT 1";
  $sql2 = "SELECT * FROM dummy_loc ORDER BY id DESC LIMIT 5, 1";
  $resource1 = mysqli_query($con, $sql1);
  $order_details1 = array();
  while($row1 = mysqli_fetch_assoc($resource1)){
   $order_details1[] = $row1;
  }
  $resource2 = mysqli_query($con, $sql2);
  $order_details2 = array();
  while($row2 = mysqli_fetch_assoc($resource2)){
   $order_details2[] = $row2;
  }
  foreach($order_details2 as $item2):
    foreach($order_details1 as $item1):
      if (floor(100 * $item2['latitude']) == floor(100 * $item1['latitude'])) {
  	   echo "The vehicle is stalled";
  	   echo "<br>";
      }
      else {
        echo "The vehicle is just fine";
        echo "<br>";
      }
    endforeach;
  endforeach;

?>
</div>

</body>
</html>