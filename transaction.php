<!DOCTYPE HTML> 
<html>
<head>
<title>Client's Page</title>
<style>
.error {color: #FF0000;
  background: #FDFDFD
font-family: "Clear Sans", "Helvetica Neue", Arial, sans-serif;
font-size: 11px;}
</style>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#tID").keyup(function (e) {
  
    //removes spaces from tID
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var tID = $(this).val();
    if(tID.length < 4){$("#tID-result").html('');return;}
    
    if(tID.length >= 4){
      $("#tID-result").html('<img src="ajax-loader.gif" />');
      $.post('check_tID.php', {'tID':tID}, function(data) {
        $("#tID-result").html(data);
      });
    }
  }); 
});
</script>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#bID").keyup(function (e) {
  
    //removes spaces from bID
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var bID = $(this).val();
    if(bID.length < 4){$("#bID-result").html('');return;}
    
    if(bID.length >= 4){
      $("#bID-result").html('<img src="ajax-loader.gif" />');
      $.post('check_bID.php', {'bID':bID}, function(data) {
        $("#bID-result").html(data);
      });
    }
  }); 
});
</script>
<style type="text/css">
#registration-form {background: #FDFDFD;width: 400px;padding: 20px;margin-right: auto;margin-left: auto;border: 1px solid #E9E9E9;border-radius: 10px;}
</style>
</head>
<body> 

<?php

$db_host="localhost"; // Host name 
$db_username="root"; // Mysql username 
$db_password=""; // Mysql password 
$db_name="Resfeber_Labs"; // Database name 
$tbl_name="Client"; // Table name 


// Connect to server and select databse.

$con = mysqli_connect("$db_host", "$db_username", "$db_password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name");
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// define variables and set to empty values

$tIDErr = $datErr = $otErr = $ptErr = $dtErr = $cIDErr = $dIDErr = $eIDErr = $tfErr =
$drErr = $fbErr = $hcErr = $wtErr = $psErr = $oaErr = $advErr = $rIDErr = $bIDErr = $comErr = "";

$tID = $dat = $ot = $pt = $dt = $cID = $dID = $eID = $tf =
$dr = $fb = $hc = $wt = $ps = $oa = $adv = $rID = $bID = $com = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["cID"])) {
     $cIDErr = "Client ID is required";
   } else {
     $cID = test_input($_POST["cID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$cID)) {
       $cIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["dID"])) {
     $dIDErr = "Driver ID is required";
   } else {
     $dID = test_input($_POST["dID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$dID)) {
       $dIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["rID"])) {
     $rIDErr = "Route ID is required";
   } else {
     $rID = test_input($_POST["rID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$rID)) {
       $rIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["eID"])) {
     $eIDErr = "Employee ID is required";
   } else {
     $eID = test_input($_POST["eID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$eID)) {
       $eIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["bID"])) {
     $bIDErr = "Bill ID is required";
   } else {
     $bID = test_input($_POST["bID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$bID)) {
       $bIDErr = "Only letters, digits and underscores allowed"; 
     }
   }
   
   if (empty($_POST["tID"])) {
     $tIDErr = "Transaction ID is required";
   } else {
     $tID = test_input($_POST["tID"]);

     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$tID)) {
       $tIDErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["dat"])) {
     $datErr = "Date is required";
   } else {
     $dat = test_input($_POST["dat"]);
     
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$dat)) {
       //$datErr = "Only letters, digits and underscores allowed"; 
     //}
   }

   if (empty($_POST["ot"])) {
     $otErr = "Order TimeStamp is required";
   } else {
     $ot = test_input($_POST["ot"]);
     
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$ot)) {
       //$otErr = "Only letters, digits and underscores allowed"; 
     //}
   }

   if (empty($_POST["pt"])) {
     $ptErr = "Pickup Time is required";
   } else {
     $pt = test_input($_POST["pt"]);
     
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$it)) {
       //$itErr = "Only letters, digits and underscores allowed"; 
     //}
   }

   if (empty($_POST["dt"])) {
     $dtErr = "Drop Time is required";
   } else {
     $dt = test_input($_POST["dt"]);
     
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$it)) {
       //$itErr = "Only letters, digits and underscores allowed"; 
     //}
   }

   if (empty($_POST["tf"])) {
     $tfErr = "Trip Fare is required";
   } else {
     $tf = test_input($_POST["tf"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$tf)) {
       $tfErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["dr"])) {
     $drErr = "Driver Rating is required";
   } else {
     $dr = test_input($_POST["dr"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1}$/",$dr)) {
       $drErr = "Only letters, digits and underscores allowed"; 
     }
   }

   if (empty($_POST["fb"])) {
     $fbErr = "Feedback is required";
   } else {
     $fb = test_input($_POST["fb"]);
     
     // check if fb only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fb)) {
       $fbErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["hc"])) {
     $hcErr = "Helper Count is required";
   } else {
     $hc = test_input($_POST["hc"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1}$/",$hc)) {
       $hcErr = "Only digits are allowed"; 
     }
   }

   if (empty($_POST["wt"])) {
     $wtErr = "Weight is required";
   } else {
     $wt = test_input($_POST["wt"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$wt)) {
       $wtErr = "Only digits are allowed"; 
     }
   }

   if (empty($_POST["ps"])) {
     $psErr = "Payment Status is required";
   } else {
     $ps = test_input($_POST["ps"]);
     
     // check if ps only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{3,}+[a-zA-Z ]*$/",$ps)) {
       $psErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["oa"])) {
     $oaErr = "Outstanding Amount is required";
   } else {
     $oa = test_input($_POST["oa"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$oa)) {
       $oaErr = "Only digits are allowed"; 
     }
   }

   if (empty($_POST["adv"])) {
     $advErr = "Advance is required";
   } else {
     $adv = test_input($_POST["adv"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$adv)) {
       $advErr = "Only digits are allowed"; 
     }
   }


   if (empty($_POST["com"])) {
     $comErr = "comance is required";
   } else {
     $com = test_input($_POST["com"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{1,}$/",$com)) {
       $comErr = "Only digits are allowed"; 
     }
   }


   /*if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{3,}+[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }

   if (empty($_POST["cAddr"])) {
     $cAddrErr = "Customer Address is required";
   } else {
     $cAddr = test_input($_POST["cAddr"]);
     
     // check if name only contains letters and whitespace
   }
   
   if (empty($_POST["cCity"])) {
     $cCityErr = "Customer City is required";
   } else {
     $cCity = test_input($_POST["cCity"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{2,}+[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["routes"])) {
     $routesErr = "Route is required";
   } else {
     $routes = test_input($_POST["routes"]);
     
     // check if name only contains letters and whitespace
     //if (!preg_match("/^[a-zA-Z]([a-zA-Z-]+\s)+\d{1,4}$/",$cAddr)) {
       //$cAddr = "Only letters and white space allowed"; 
     //}
   }
   
   if (empty($_POST["cPerson"])) {
     $cPersonErr = "Contact person name is required";
   } else {
     $cPerson = test_input($_POST["cPerson"]);
     
     //check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$cPerson)) {
       $cPersonErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["cpMobile"])) {
     $cpMobileErr = "Contact's phone number is required";
   } else {
     $cpMobile = test_input($_POST["cpMobile"]);
     
     //check if name only contains letters and whitespace
     if (!preg_match("/^[1-9]{1}+[0-9]{9}$/",$cpMobile)) {
       $cpMobileErr = "Please check your mobile number"; 
     }
   }
   
   if (empty($_POST["aPhone"])) {
     $aPhoneErr = "Contact's phone number is required";
   } else {
     $aPhone = test_input($_POST["aPhone"]);
     
     //check if name only contains letters and whitespace
     if (!preg_match("/^[1-9]{1}+[0-9]{6,9}$/",$aPhone)) {
       $aPhoneErr = "Please check your phone number"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     
     // check if e-mail address syntax is valid
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
       $emailErr = "Invalid email format";
     }
   }
   
   if (empty($_POST["username"])) {
     $usernameErr = "username ID is required";
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$username)) {
       $usernameErr = "Only letters, digits and underscores allowed"; 
     }
   }
   
   if (empty($_POST["vehicle"])) {
     $vehicleErr = "vehicle is required";
   } else {
     $vehicle = test_input($_POST["vehicle"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{3,}+[a-zA-Z ]*$/",$vehicle)) {
       $vehicleErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["pan"])) {
     $panErr = "PAN Card is required";
   } else {
     $pan = test_input($_POST["pan"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]{5}+[0-9]{4}+[a-zA-Z]{1}$/",$pan)) {
       $panErr = "The format is 5 letters, 4 digits and 1 letter"; 
     }
   }
   
   if (empty($_POST["accName"])) {
     $accNameErr = "Bank Account Name is required";
   } else {
     $accName = test_input($_POST["accName"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ,]*$/",$accName)) {
       $accNameErr = "Only letters, commas and white space allowed"; 
     }
   }
   
   if (empty($_POST["accNum"])) {
     $accNumErr = "Bank Account number is required";
   } else {
     $accNum = test_input($_POST["accNum"]);
     
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{8,13}/",$accNum)) {
       $accNumErr = "Only 8-13 digits allowed"; 
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
   
   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = test_input($_POST["password"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/(?=^(?:[^A-Z]*[A-Z]){2})(?=^(?:[^a-z]*[a-z]){2})(?=^(?:\D*\d){2})(?=^(?:\w*\W){2})^[A-Za-z\d\W]{8,}$/",$password)) {
       $passwordErr = "Password should contain at least 2 upper case letters, lower case letters, digits, special characters and 8 characters in length"; 
     }
   }
   
   if (empty($_POST["amtpay"])) {
     $amtpayErr = "Amount Payable is required";
   } else {
     $amtpay = test_input($_POST["amtpay"]);
     
     //check if name only contains letters and whitespace
     if (!preg_match("/[0-9]{1,13}/",$amtpay)) {
       $amtpayErr = "Only numbers allowed"; 
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
   
   if (empty($_POST["categorys"])) {
     $categorysErr = "Category is required";
   } else {
     $categorys = test_input($_POST["categorys"]);
     
     //check if name only contains letters and whitespace
     //if (!preg_match("/\d{1,13}/",$lastU)) {
       //$lastUErr = "Only numbers allowed"; 
     //}
   }
   
   if (empty($_POST["TINum"])) {
     $TINumErr = "TIN Number is required";
   } else {
     $TINum = test_input($_POST["TINum"]);
     
     //check if name only contains letters and whitespace
     //if (!preg_match("/\d{1,13}/",$lastU)) {
       //$lastUErr = "Only numbers allowed"; 
     //}
   }*/
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2 align = "center">
<div id="registration-form">Transaction Page
</div>
</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <div id="registration-form">
   <p><span class="error">* required field.</span></p>
   <label for="tID">Transaction ID : 
   <input type="text" name="tID" id="tID" autocomplete = "off" maxlength="15" value="<?php echo $tID;?>">
   <span class="error">* <?php echo $tIDErr;?></span>
   <span id="tID-result"></span>
   <br><br> 
   <label for="dat">Date : 
   <input type="text" name="dat" id="dat" maxlength="15" value="<?php echo $dat;?>">
   <span class="error">* <?php echo $datErr;?></span>
   <br><br>
   <label for="ot">Order Timestamp : 
   <input type="text" name="ot" id="ot" maxlength="15" value="<?php echo $ot;?>">
   <span class="error">* <?php echo $otErr;?></span>
   <br><br>
   <label for="pt">Pickup Time : 
   <input type="text" name="pt" id="pt" maxlength="15" value="<?php echo $pt;?>">
   <span class="error">* <?php echo $ptErr;?></span>
   <br><br>
   <label for="dt">Drop Time : 
   <input type="text" name="dt" id="dt" maxlength="15" value="<?php echo $dt;?>">
   <span class="error">* <?php echo $dtErr;?></span>
   <br><br>
   <label for="cID">Client ID : 
   <input type="text" name="cID" id="cID" maxlength="15" value="<?php echo $cID;?>">
   <span class="error">* <?php echo $cIDErr;?></span>
   <br><br> 
   <label for="dID">Driver ID : 
   <input type="text" name="dID" id="dID" maxlength="15" value="<?php echo $dID;?>">
   <span class="error">* <?php echo $dIDErr;?></span>
   <br><br>
   <label for="eID">Employee ID : 
   <input type="text" name="eID" id="eID" maxlength="15" value="<?php echo $eID;?>">
   <span class="error">* <?php echo $eIDErr;?></span>
   <br><br>
   <label for="tf">Trip Fare :
   <input name="tf" type="text" id="tf" maxlength="15" value="<?php echo $tf;?>">
   <span class="error">* <?php echo $tfErr;?></span>
   <br><br>
   <label for="dr">Driver Rating :
   <input name="dr" type="text" autocomplete = "off" id="dr" maxlength="15" value="<?php echo $dr;?>">
   <span class="error">* <?php echo $drErr;?></span>
   <span id="user-result"></span>
   <br><br>
   <label for="fb">Feedback :
   <input name="fb" type="text" id="fb" maxlength="150" value="<?php echo $fb;?>">
   <span class="error">* <?php echo $fbErr;?></span>
   <br><br>
   <label for="hc">Helper Count : 
   <input type="text" name="hc" id="hc" maxlength="15" value="<?php echo $hc;?>">
   <span class="error">* <?php echo $hcErr;?></span>
   <br><br>
   <label for="wt">Weight : 
   <input type="text" name="wt" id="wt" maxlength="15" value="<?php echo $wt;?>">
   <span class="error">* <?php echo $wtErr;?></span>
   <br><br>
   <label for="ps">Payment Status : 
   <input type="text" name="ps" id="ps" maxlength="15" value="<?php echo $ps;?>">
   <span class="error">* <?php echo $psErr;?></span>
   <br><br>
   <label for="oa">Outstanding Amount : 
   <input type="text" name="oa" id="oa" maxlength="15" value="<?php echo $oa;?>">
   <span class="error">* <?php echo $oaErr;?></span>
   <br><br>
   <label for="adv">Advance : 
   <input type="text" name="adv" id="adv" maxlength="25" value="<?php echo $adv;?>">
   <span class="error">* <?php echo $advErr;?></span>
   <br><br>
   <label for="rID">Route ID : 
   <input type="text" name="rID" id="rID" maxlength="15" value="<?php echo $rID;?>">
   <span class="error">* <?php echo $rIDErr;?></span>
   <br><br>
   <label for="bID">Bill ID : 
   <input type="text" name="bID" id="bID" autocomplete = "off" maxlength="15" value="<?php echo $bID;?>">
   <span class="error">* <?php echo $bIDErr;?></span>
   <span id="bID-result"></span>
   <br><br>
   <label for="com">Commission : 
   <input type="text" name="com" id="com" maxlength="15" value="<?php echo $com;?>">
   <span class="error">* <?php echo $comErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
   <br><br>
   </label>
   </div>
   
   <br><br><br><br><br><br><br><br><br><br>
</form>

<?php
   if (!$tIDErr && !$datErr && !$otErr && !$ptErr && !$dtErr && !$cIDErr && !$dIDErr && !$eIDErr && !$tfErr &&
   !$drErr && !$fbErr && !$hcErr && !$wtErr && !$psErr && !$oaErr && !$advErr && !$rIDErr && !$bIDErr && !$comErr
   && $tID && $dat && $ot && $pt && $dt && $cID && $dID && $eID && $tf &&
   $dr && $fb && $hc && $wt && $ps && $oa && $adv && $rID && $bID && $com){


      $sql = "INSERT INTO Transaction 
      VALUES ('$tID', '$dat', '$ot', '$pt', '$dt', '$cID', '$dID', '$eID', '$tf', '$dr', '$fb', '$hc', '$wt', '$ps', '$oa', '$adv', '$rID', '$bID', '$com')";
      if (!mysqli_query($con, $sql)) {
         die('Error: ' . mysqli_error($con));
      }
      echo "1 Row Added";
   }

   //$a[] = "SELECT username_ID FROM Client";


   mysqli_close($con);

?>

<?php

/*$result = mysqli_query($con,"SELECT * FROM Client");
if (!mysqli_query($con, $sql)) {
         die('Error: ' . mysqli_error($con));
      }

      echo "<table border='1'>
      <tr>
      <th>client ID</th>
      <th>Name</th>
      <th>Company Address</th>
      <th>Company City</th>
      <th>Routes</th>
      <th>Contact Person</th>
      <th>Contact Person Mobile</th>
      <th>Alternate Phone Number</th>
      <th>Contact Person Email</th>
      <th>username ID</th>
      <th>Assigned Vehicles</th>
      <th>PAN Card</th>
      <th>Bank Account Name</th>
      <th>Bank Account Number</th>
      <th>IFSC Code</th>
      <th>Password</th>
      <th>Amount Payable</th>
      <th>Last Updated</th>
      <th>Category</th>
      <th>TIN Number</th>
      </tr>";

      while($row = mysqli_fetch_array($result)) {
         echo "<tr>";
         echo "<td>" . $row['$cID'] . "</td>";
         echo "<td>" . $row['$name'] . "</td>";
         echo "<td>" . $row['$cAddr'] . "</td>";
         echo "<td>" . $row['$cCity'] . "</td>";
         echo "<td>" . $row['routes'] . "</td>";
         echo "<td>" . $row['cPerson'] . "</td>";
         echo "<td>" . $row['cpMobile'] . "</td>";
         echo "<td>" . $row['aPhone'] . "</td>";
         echo "<td>" . $row['email'] . "</td>";
         echo "<td>" . $row['username'] . "</td>";
         echo "<td>" . $row['vehicle'] . "</td>";
         echo "<td>" . $row['pan'] . "</td>";
         echo "<td>" . $row['accName'] . "</td>";
         echo "<td>" . $row['accNum'] . "</td>";
         echo "<td>" . $row['ifsc'] . "</td>";
         echo "<td>" . $row['password'] . "</td>";
         echo "<td>" . $row['amtpay'] . "</td>";
         echo "<td>" . $row['lastU'] . "</td>";
         echo "<td>" . $row['categorys'] . "</td>";
         echo "<td>" . $row['TINum'] . "</td>";
         echo "</tr>";
      }

      echo "</table>";*
      <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
$(function()
{
$('.username').keyup(function()
{
var checkname=$(this).val();
var availname=remove_whitespaces(checkname);
if(availname!=''){
$('.check').show();
$('.check').fadeIn(400).html('<img src="ajax-loading.gif" /> ');</p>
<p style="text-align: justify;">var String = 'username='+ availname;
$.ajax({
type: "POST",
url: "available.php",
data: String,
cache: false,
success: function(result){
var result=remove_whitespaces(result);
if(result==''){
$('.check').html('<img src="tick.png" /> This Username Is Avaliable');
$(".check").removeClass("red");
$('.check').addClass("green");
$(".user_name").removeClass("yellow");
$(".user_name").addClass("white");
}else{
$('.check').html('<img src="cross.png" /> This Username Is Already Taken');
$(".check").removeClass("green");
$('.check').addClass("red")
$(".user_name").removeClass("white");
$(".user_name").addClass("yellow");
}
}
});
}else{
$('.check').html('');
 
}
});
 
//$('.passwd').password_strength(); // to check password strength
});

function remove_whitespaces(str){
var str=str.replace(/^\s+|\s+$/,'');
return str;
}
</script>
*/

?>

<!-- javascript placed at bottom to make page load faster -->




</body>
</html>