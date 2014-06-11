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
$tbl_name="Route"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");


// define variables and set to empty values

$ridErr = $clientIDErr = $nodrErr = $rlatErr = $rlongErr = $rlocErr =
$dridErr = $distErr = $maddrErr = $smsphErr = "";

$rid = $clientID = $nodr = $rlat = $rlong = $rloc =
$drid = $dist = $maddr = $smsph = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["clientID"])) {
     $clientIDErr = "Client ID is required";
   } else {
     $clientID = test_input($_POST["clientID"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_]{1,}$/",$clientID)) {
       $clientIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["rid"])) {
     $ridErr = "Route ID is required";
   } else {
     $rid = test_input($_POST["rid"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_]{1,}$/",$rid)) {
       $ridErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["nodr"])) {
     $nodrErr = "Number of Dropouts is required";
   } else {
     $nodr = test_input($_POST["nodr"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$nodr)) {
       $nodrErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["rlat"])) {
     $rlatErr = "Route Latitude(s) required";
   } else {
     $rlat = test_input($_POST["rlat"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9,. ]{1,}$/",$rlat)) {
       $rlatErr = "Only digits, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["rlong"])) {
     $rlongErr = "Route Longitude(s) required";
   } else {
     $rlong = test_input($_POST["rlong"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9,. ]{1,}$/",$rlong)) {
       $rlongErr = "Only digits, commas and underscores allowed"; 
     }
   }


   if (empty($_POST["rloc"])) {
     $rlocErr = "Route Location(s) required";
   } else {
     $rloc = test_input($_POST["rloc"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_,. ]{1,}$/",$rloc)) {
       $rlocErr = "Only letters, digits, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["drid"])) {
     $dridErr = "Driver ID required";
   } else {
     $drid = test_input($_POST["drid"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_,. ]{1,}$/",$drid)) {
       $dridErr = "Only letters, digits, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["dist"])) {
     $distErr = "Distance required";
   } else {
     $dist = test_input($_POST["dist"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9,. ]{1,}$/",$dist)) {
       $distErr = "Only letters, digits, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["maddr"])) {
     $maddrErr = "Mailing Adress required";
   } else {
     $maddr = test_input($_POST["maddr"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9-_,. ]{1,}$/",$rloc)) {
       $maddrErr = "Only letters, digits, dashes, commas and underscores allowed"; 
     }
   }

   if (empty($_POST["smsph"])) {
     $smsphErr = "SMS Phone Number(s) required";
   } else {
     $smsph = test_input($_POST["smsph"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9-, ]{1,}$/",$sms)) {
       $smsphErr = "Only digits, commas, dashes and whitespaces allowed"; 
     }
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Route Page</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Route ID: <input type="text" name="rid" value="<?php echo $rid;?>">
   <span class="error">* <?php echo $ridErr;?></span>
   <br><br>
   Client ID: <input type="text" name="clientID" value="<?php echo $clientID;?>">
   <span class="error">* <?php echo $clientIDErr;?></span>
   <br><br>
   Number of Dropouts: <input type="number" name="nodr" min = "0" max = "15" value="<?php echo $nodr;?>">
   <span class="error">* <?php echo $nodrErr;?></span>
   <br><br> 
   Route Latitude: <input type="text" name="rlat" value="<?php echo $rlat;?>">
   <span class="error">* <?php echo $rlatErr;?></span>
   <br><br>
   Route Longitude: <input type="text" name="rlong" value="<?php echo $rlong;?>">
   <span class="error">* <?php echo $rlongErr;?></span>
   <br><br>
   Route Location: <input type="text" name="rloc" value="<?php echo $rloc;?>">
   <span class="error">* <?php echo $rlocErr;?></span>
   <br><br>
   Driver ID: <input type="text" name="drid" value="<?php echo $drid;?>">
   <span class="error">* <?php echo $dridErr;?></span>
   <br><br>
   Distance: <input type="text" name="dist" value="<?php echo $dist;?>">
   <span class="error">* <?php echo $distErr;?></span>
   <br><br>
   Mailing Addresses: <input type="text" name="maddr" value="<?php echo $maddr;?>">
   <span class="error">* <?php echo $maddrErr;?></span>
   <br><br>
   SMS Phone Numbers: <input type="tel" name="smsph" value="<?php echo $smsph;?>">
   <span class="error">* <?php echo $smsphErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>