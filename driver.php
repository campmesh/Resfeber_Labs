<!DOCTYPE HTML> 
<html>
<head>
<title>Driver's Page</title>
<style>
.error {color: #FF0000;
font-family: "Clear Sans", "Helvetica Neue", Arial, sans-serif;
font-size: 11px;}
</style>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#vNum").keyup(function (e) {
  
    //removes spaces from username
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var vNum = $(this).val();
    if(vNum.length < 4){$("#vNum-result").html('');return;}
    
    if(vNum.length >= 4){
      $("#vNum-result").html('<img src="ajax-loader.gif" />');
      $.post('check_vNum.php', {'vNum':vNum}, function(data) {
        $("#vNum-result").html(data);
      });
    }
  }); 
});
</script>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#vregno").keyup(function (e) {
  
    //removes spaces from username
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var vregno = $(this).val();
    if(vregno.length < 4){$("#vregno-result").html('');return;}
    
    if(vregno.length >= 4){
      $("#vregno-result").html('<img src="ajax-loader.gif" />');
      $.post('check_vregno.php', {'vregno':vregno}, function(data) {
        $("#vregno-result").html(data);
      });
    }
  }); 
});
</script>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#carrier").keyup(function (e) {
  
    //removes spaces from username
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var carrier = $(this).val();
    if(carrier.length < 4){$("#carrier-result").html('');return;}
    
    if(carrier.length >= 4){
      $("#carrier-result").html('<img src="ajax-loader.gif" />');
      $.post('check_carrier.php', {'carrier':carrier}, function(data) {
        $("#carrier-result").html(data);
      });
    }
  }); 
});
</script>
</head>
<body> 

<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="Resfeber_Labs"; // Database name 
$tbl_name="Driver"; // Table name 


// Connect to server and select databse.

$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name");
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// define variables and set to empty values

$vNumErr = $nameErr = $cAddrErr = $cCityErr = $vregnoErr = $carrierErr = $regcomErr =
$pAddrErr = $ppnErr = $spnErr = $licErr = $vehicleErr = $scoreErr =
$accNameErr = $accNumErr = $ifscErr = $cpnoErr = $photoErr = $nuorErr =
$lastUErr = $lastredaErr = $lastreamErr = $inumErr = $ambaErr = "";

$vNum = $name = $cAddr = $cCity = $vregno = $carrier = $regcom =
$pAddr = $ppn = $spn = $lic = $vehicle = $score = $accName = $accNum = $ifsc = $cpno = $photo = $nuor = 
$lastU = $lastreda = $lastream = $inum = $amba = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["vNum"])) {
     $vNumErr = "Vehicle Number is required";
   } else {
     $vNum = test_input($_POST["vNum"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$vNum)) {
       $vNumErr = "Only letters, digits and underscores allowed"; 
     }
   }
   
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["cAddr"])) {
     $cAddrErr = "Current Address is required";
   } else {
     $cAddr = test_input($_POST["cAddr"]);
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }
   
   if (empty($_POST["pAddr"])) {
     $cAddrErr = "Permanent Address is required";
   } else {
     $pAddr = test_input($_POST["pAddr"]);
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }

   if (empty($_POST["cCity"])) {
     $cCityErr = "City is required";
   } else {
     $cCity = test_input($_POST["cCity"]);
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }
   
   if (empty($_POST["vregno"])) {
     $vregnoErr = "Vehicle Registration Number is required";
   } else {
     $vregno = test_input($_POST["vregno"]);
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }
   
   if (empty($_POST["carrier"])) {
     $carrierErr = "Carrier Registration Number is required";
   } else {
     $carrier = test_input($_POST["carrier"]);
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }

   if (empty($_POST["regcom"])) {
     $regcomErr = "Registered Complaints is required";
   } else {
     $regcom = test_input($_POST["regcom"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$regcom)) {
       $regcomErr = "Only letters, commas and white space allowed"; 
     }
   }
   
   if (empty($_POST["ppn"])) {
     $ppnErr = "Primary phone number is required";
   } else {
     $ppn = test_input($_POST["ppn"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,10}/",$ppn)) {
       $ppnErr = "Only numbers allowed"; 
     }
   }
   
   if (empty($_POST["spn"])) {
     $spnErr = "Secondary phone number is required";
   } else {
     $spn = test_input($_POST["spn"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,10}/",$spn)) {
       $spnErr = "Only numbers allowed"; 
     }
   }
   
   if (empty($_POST["lic"])) {
     $licErr = "License is required";
   } else {
     $lic = test_input($_POST["lic"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_]{1,}$/",$vNum)) {
       $licErr = "Only letters, digits and underscores allowed"; 
     }
   }
   
   if (empty($_POST["vehicle"])) {
     $vehicleErr = "Vehicle is required";
   } else {
     $vehicle = test_input($_POST["vehicle"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$vehicle)) {
       $vehicleErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["score"])) {
     $scoreErr = "Score is required";
   } else {
     $score = test_input($_POST["score"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]$/",$score)) {
       $scoreErr = "Only letters and digits allowed"; 
     }
   }
   
   if (empty($_POST["nuor"])) {
     $nuorErr = "Number of Refusals is required";
   } else {
     $nuor = test_input($_POST["nuor"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]$/",$score)) {
       $nuorErr = "Only letters and digits allowed"; 
     }
   }

   if (empty($_POST["accName"])) {
     $accNameErr = "Bank Account Name is required";
   } else {
     $accName = test_input($_POST["accName"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$accName)) {
       $accNameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["accNum"])) {
     $accNumErr = "Bank Account number is required";
   } else {
     $accNum = test_input($_POST["accNum"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,13}/",$accNum)) {
       $accNumErr = "Only numbers allowed"; 
     }
   }
   
   if (empty($_POST["ifsc"])) {
     $ifscErr = "IFSC Code is required";
   } else {
     $ifsc = test_input($_POST["ifsc"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{5}+[0-9]{4}+[a-zA-Z]{1}$/",$ifsc)) {
       $ifscErr = "The format is: 5 letters - 4 digits - 1 letter"; 
     }
   }
   
   if (empty($_POST["cpno"])) {
     $cpnoErr = "Company Phone Number is required";
   } else {
     $cpno = test_input($_POST["cpno"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,13}/",$cpno)) {
       $cpnoErr = "Only numbers allowed"; 
     }
   }

   if (empty($_POST["lastU"])) {
     $lastUErr = "Last Updated is required";
   } else {
     $lastU = test_input($_POST["lastU"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/",$lastU)) {
       $lastUErr = "The format is DD-MM-YYYY"; 
     }
   }
   
   if (empty($_POST["lastreda"])) {
     $lastredaErr = "Last Recharge Date is required";
   } else {
     $lastreda = test_input($_POST["lastU"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/",$lastreda)) {
       $lastredaErr = "The format is DD-MM-YYYY"; 
     }
   }
   
   if (empty($_POST["lastream"])) {
     $lastreamErr = "Last Recharge Amount is required";
   } else {
     $lastream = test_input($_POST["lastream"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,}/",$lastream)) {
       $lastreamErr = "The format is DD-MM-YYYY"; 
     }
   }
   
   if (empty($_POST["inum"])) {
     $inumErr = "Insurance Number is required";
   } else {
     $inum = test_input($_POST["inum"]);
     //check if name only contains letters and whitespace
     //if (!preg_match("/\d{1,13}/",$lastU)) {
       //$lastUErr = "Only numbers allowed"; 
     //}
   }
   
   if (empty($_POST["amba"])) {
     $ambaErr = "Amount Balance is required";
   } else {
     $amba = test_input($_POST["amba"]);
     //check if name only contains letters and whitespace
     //if (!preg_match("/\d{1,13}/",$lastU)) {
       //$lastUErr = "Only numbers allowed"; 
     //}
   }

   if (empty($_POST["photo"])) {
     $photoErr = "Photo is required";
   } else {
     $photo = test_input($_POST["photo"]);
     //check if name only contains letters and whitespace
     //if (!preg_match("/\d{1,13}/",$photo)) {
     //$photoErr = "Only numbers allowed"; 
     //}
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Driver Page</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Vehicle Number: <input type="text" autocomplete = "off" name="vNum" id = "vNum" value="<?php echo $vNum;?>">
   <span class="error">* <?php echo $vNumErr;?></span>
   <span id="vNum-result"></span>
   <br><br>
   Driving License: <input type="text" name="lic" value="<?php echo $lic;?>">
   <span class="error">* <?php echo $licErr;?></span>
   <br><br>
   Photo: <input type="text" name="photo" value="<?php echo $photo;?>">
   <span class="error">* <?php echo $photoErr;?></span>
   <br><br>
   Vehicle Registration Number: <input type="text" autocomplete = "off" name="vregno" id = "vregno" value="<?php echo $vregno;?>">
   <span class="error">* <?php echo $vregnoErr;?></span>
   <span id="vregno-result"></span>
   <br><br>
   Carrier Registration Number: <input type="text" autocomplete = "off" name="carrier" id = "carrier" value="<?php echo $carrier;?>">
   <span class="error">* <?php echo $carrierErr;?></span>
   <span id="carrier-result"></span>
   <br><br>
   Current Address: <input type="text" name="cAddr" value="<?php echo $cAddr;?>">
   <span class="error">* <?php echo $cAddrErr;?></span>
   <br><br>
   Permanent Address: <input type="text" name="pAddr" value="<?php echo $pAddr;?>">
   <span class="error">* <?php echo $pAddrErr;?></span>
   <br><br>
   Bank Account Name: <input type="text" name="accName" value="<?php echo $accName;?>">
   <span class="error">* <?php echo $accNameErr;?></span>
   <br><br>
   Bank Account Number: <input type="text" name="accNum" value="<?php echo $accNum;?>">
   <span class="error">* <?php echo $accNumErr;?></span>
   <br><br>
   IFSC Code: <input type="text" name="ifsc" value="<?php echo $ifsc;?>">
   <span class="error">* <?php echo $ifscErr;?></span>
   <br><br>
   Primary Phone Number: <input type="text" name="ppn" value="<?php echo $ppn;?>">
   <span class="error">* <?php echo $ppnErr;?></span>
   <br><br>
   Secondary Phone Number: <input type="text" name="spn" value="<?php echo $spn;?>">
   <span class="error">* <?php echo $spnErr;?></span>
   <br><br>
   Number of Refusals: <input type="text" name="nuor" min="1" max="10" value="<?php echo $nuor;?>">
   <span class="error">* <?php echo $nuorErr;?></span>
   <br><br>
   Score (1-6): <input type="text" name="score" min = "1" max = "6" value="<?php echo $score;?>">
   <span class="error">* <?php echo $scoreErr;?></span>
   <br><br>
   Registered Complaints: <input type="text" name="regcom" value="<?php echo $regcom;?>">
   <span class="error">* <?php echo $regcomErr;?></span>
   <br><br>
   Vehicle Type: <input type="text" name="vehicle" value="<?php echo $vehicle;?>">
   <span class="error">* <?php echo $vehicleErr;?></span>
   <br><br>
   Insurance Number: <input type="text" name="inum" value="<?php echo $inum;?>">
   <span class="error">* <?php echo $inumErr;?></span>
   <br><br>
   Amount Balance: <input type="text" name="amba" value="<?php echo $amba;?>">
   <span class="error">* <?php echo $ambaErr;?></span>
   <br><br>
   Last Updated: <input type="text" name="lastU" value="<?php echo $lastU;?>">
   <span class="error">* <?php echo $lastUErr;?></span>
   <br><br>
   Last Recharge Date: <input type="text" name="lastreda" value="<?php echo $lastreda;?>">
   <span class="error">* <?php echo $lastredaErr;?></span>
   <br><br>
   Last Recharge Amount: <input type="text" name="lastream" value="<?php echo $lastream;?>">
   <span class="error">* <?php echo $lastreamErr;?></span>
   <br><br>
   Company Phone Number: <input type="text" name="cpno" value="<?php echo $cpno;?>">
   <span class="error">* <?php echo $cpnoErr;?></span>
   <br><br>
   City: <input type="text" name="cCity" value="<?php echo $cCity;?>">
   <span class="error">* <?php echo $cCityErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
/*echo "<h2>Your Input:</h2>";
echo $vNum;
echo "<br>";
echo $name;
echo "<br>";
echo $cAddr;
echo "<br>";
echo $cCity;
echo "<br>";
echo $vregno;
echo "<br>";
echo $regcom;
echo "<br>";
echo $ppn;
echo "<br>";
echo $spn;
echo "<br>";
echo $regcom;
echo "<br>";
echo $lic;
echo "<br>";
echo $vehicle;
echo "<br>";
echo $score;
echo "<br>";
echo $accName;
echo "<br>";
echo $accNum;
echo "<br>";
echo $ifsc;
echo "<br>";
echo $cpno;
echo "<br>";
echo $lastU;
echo "<br>";
echo $inum;*/

if (!$vNumErr && !$nameErr && !$cAddrErr && !$cCityErr && !$vregnoErr && !$carrierErr && !$regcomErr &&
!$pAddrErr && !$ppnErr && !$spnErr && !$licErr && !$vehicleErr && !$scoreErr && 
!$accNameErr && !$accNumErr && !$ifscErr && !$cpnoErr && !$photoErr && !$nuorErr &&
!$lastUErr && !$lastredaErr && !$lastreamErr && !$inumErr && !$ambaErr && $vNumErr && $nameErr && 
$cAddrErr && $cCityErr && $vregnoErr && $carrierErr && $regcomErr &&
$pAddrErr && $ppnErr && $spnErr && $licErr && $vehicleErr && $scoreErr && 
$accNameErr && $accNumErr && $ifscErr && $cpnoErr && $photoErr && $nuorErr &&
$lastUErr && $lastredaErr && $lastreamErr && $inumErr && $ambaErr){

  $sql = "INSERT INTO Driver 
      VALUES ('$name' , '$vNum' , '$lic' , '$photo' , '$vregno' , '$carrier' , '$cAddr' , '$pAddr' , 
              '$accName' , '$accNum' , '$ifsc' , '$ppn' , '$spn' , '$nuor', '$score' , '$regcom' ,'$vehicle' , 
              '$inum' , '$amba', '$lastU' , '$lastreda' , '$lastream' , '$cpno' , '$cCity')";
      if (!mysqli_query($con, $sql)) {
         die('Error: ' . mysqli_error($con));
      }
      echo "1 Row Added";
   }

   mysqli_close($con);

?>

</body>
</html>