<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;
font-family: "Clear Sans", "Helvetica Neue", Arial, sans-serif;
font-size: 11px;}
</style>
</head>
<body> 

<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="Resfeber_Labs"; // Database name 
$tbl_name="Tracking"; // Table name 

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", "Resfeber_Labs")or die("cannot connect"); 
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// define variables and set to empty values

$rlatErr = $rlongErr = $rlocErr = $tridErr = $traidErr =
$tstErr = "";

$rlat = $rlong = $rloc = $trid = $traid =
$tst = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["trid"])) {
     $tridErr = "Tracking ID is required";
   } else {
     $trid = test_input($_POST["trid"]);
     //Tracking IDck if name only contains lettkersTracing IDace
     if (!preg_match("/^[a-zA-Z0-9_]{1,}$/",$trid)) {
       $tridErr = "Only letters, digits and underscores allowed";
     }
   }

   if (empty($_POST["rid"])) {
     $ridErr = "Route ID is required";
   } else {
     $traid = test_input($_POST["traid"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_]{1,}$/",$traid)) {
       $traidErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["rlat"])) {
     $rlatErr = "Latitude(s) required";
   } else {
     $rlat = test_input($_POST["rlat"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9,. ]{1,}$/",$rlat)) {
       $rlatErr = "Only digits, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["rlong"])) {
     $rlongErr = "Longitude(s) required";
   } else {
     $rlong = test_input($_POST["rlong"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9,. ]{1,}$/",$rlong)) {
       $rlongErr = "Only digits, commas and underscores allowed"; 
     }
   }


   if (empty($_POST["rloc"])) {
     $rlocErr = "Location(s) required";
   } else {
     $rloc = test_input($_POST["rloc"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_,. ]{1,}$/",$rloc)) {
       $rlocErr = "Only letters, digits, commas and underscores allowed"; 
     }
   }

   $rloc = test_input($_SERVER['REQUEST_TIME']);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Tracking Page</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Tracking ID: <input type="text" name="trid" value="<?php echo $trid;?>">
   <span class="error">* <?php echo $tridErr;?></span>
   <br><br>
   Transaction ID: <input type="text" name="traid" value="<?php echo $traid;?>">
   <span class="error">* <?php echo $traidErr;?></span>
   <br><br> 
   Latitude: <input type="text" name="rlat" value="<?php echo $rlat;?>">
   <span class="error">* <?php echo $rlatErr;?></span>
   <br><br>
   Longitude: <input type="text" name="rlong" value="<?php echo $rlong;?>">
   <span class="error">* <?php echo $rlongErr;?></span>
   <br><br>
   Location: <input type="text" name="rloc" value="<?php echo $rloc;?>">
   <span class="error">* <?php echo $rlocErr;?></span>
   <br><br>
   TimeStamp: 
</form>

</body>
</html>