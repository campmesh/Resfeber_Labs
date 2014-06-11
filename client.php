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
  $("#username").keyup(function (e) {
  
    //removes spaces from username
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var username = $(this).val();
    if(username.length < 4){$("#user-result").html('');return;}
    
    if(username.length >= 4){
      $("#user-result").html('<img src="ajax-loader.gif" />');
      $.post('check_username.php', {'username':username}, function(data) {
        $("#user-result").html(data);
      });
    }
  }); 
});
</script>
<script type="text/javascript" src="jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#password").keyup(function (e) {
  
    //removes spaces from password
    $(this).val($(this).val().replace(/\s/g, ''));
    
    var password = $(this).val();
    if(password.length < 4){$("#password-result").html('');return;}
    
    if(password.length >= 4){
      $("#password-result").html('<img src="ajax-loader.gif" />');
      $.post('check_password.php', {'password':password}, function(data) {
        $("#password-result").html(data);
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

$clientIDErr = $nameErr = $cAddrErr = $cCityErr = $routesErr = $cPersonErr =
$cpMobileErr = $aPhoneErr = $emailErr = $usernameErr = $vehicleErr = $panErr =
$accNameErr = $accNumErr = $ifscErr = $passwordErr = $amtpayErr = 
$lastUErr = $categorysErr = $TINumErr = "";

$clientID = $name = $cAddr = $cCity = $routes = $cPerson =
$cpMobile = $aPhone = $email = $username = $vehicle = $pan =
$accName = $accNum = $ifsc = $password = $amtpay = 
$lastU = $categorys = $TINum = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["clientID"])) {
     $clientIDErr = "Client ID is required";
   } else {
     $clientID = test_input($_POST["clientID"]);
     
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z0-9_-]{1,}$/",$clientID)) {
       $clientIDErr = "Only letters, digits and underscores allowed"; 
     }
   }
   
   if (empty($_POST["name"])) {
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
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2 align = "center">
<div id="registration-form">Client's Page
</div>
</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <div id="registration-form">
   <p><span class="error">* required field.</span></p>
   <label for="clientID">Client ID : 
   <input type="text" name="clientID" id="clientID" maxlength="15" value="<?php echo $clientID;?>">
   <span class="error">* <?php echo $clientIDErr;?></span>
   <br><br> 
   <label for="name">Name : 
   <input type="text" name="name" id="name" maxlength="15" value="<?php echo $name;?>" placeholder = "Enter your name here">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   <label for="cAddr">Company Address : 
   <input type="text" name="cAddr" id="cAddr" maxlength="15" value="<?php echo $cAddr;?>">
   <span class="error">* <?php echo $cAddrErr;?></span>
   <br><br>
   <label for="cCity">Company City : 
   <input type="text" name="cCity" id="cCity" maxlength="15" value="<?php echo $cCity;?>">
   <span class="error">* <?php echo $cCityErr;?></span>
   <br><br>
   <label for="routes">Routes : 
   <input type="text" name="routes" id="routes" maxlength="15" value="<?php echo $routes;?>">
   <span class="error">* <?php echo $routesErr;?></span>
   <br><br>
   <label for="cPerson">Contact Person : 
   <input type="text" name="cPerson" id="cPerson" maxlength="15" value="<?php echo $cPerson;?>">
   <span class="error">* <?php echo $cPersonErr;?></span>
   <br><br> 
   <label for="cpMobile">Contact Person Mobile : 
   <input type="text" name="cpMobile" id="cpMobile" maxlength="15" value="<?php echo $cpMobile;?>">
   <span class="error">* <?php echo $cpMobileErr;?></span>
   <br><br>
   <label for="aPhone">Alternate Phone Number : 
   <input type="text" name="aPhone" id="aPhone" maxlength="15" value="<?php echo $aPhone;?>">
   <span class="error">* <?php echo $aPhoneErr;?></span>
   <br><br>
   <label for="email">Contact Person Email :
   <input name="email" type="email" id="email" maxlength="40" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   <label for="username">Enter Username :
   <input name="username" type="text" autocomplete = "off" id="username" maxlength="15" value="<?php echo $username;?>">
   <span class="error">* <?php echo $usernameErr;?></span>
   <span id="user-result"></span>
   <br><br>
   <label for="vehicle">Assigned Vehicles :
   <input name="vehicle" type="text" id="vehicle" maxlength="20" value="<?php echo $vehicle;?>">
   <span class="error">* <?php echo $vehicleErr;?></span>
   <br><br>
   <label for="pan">PAN Card : 
   <input type="text" name="pan" id="pan" maxlength="15" value="<?php echo $pan;?>">
   <span class="error">* <?php echo $panErr;?></span>
   <br><br>
   <label for="accName">Bank Account Name : 
   <input type="text" name="accName" id="accName" maxlength="15" value="<?php echo $accName;?>">
   <span class="error">* <?php echo $accNameErr;?></span>
   <br><br>
   <label for="accNum">Bank Account Number : 
   <input type="text" name="accNum" id="accNum" maxlength="15" value="<?php echo $accNum;?>">
   <span class="error">* <?php echo $accNumErr;?></span>
   <br><br>
   <label for="ifsc">IFSC Code : 
   <input type="text" name="ifsc" id="ifsc" maxlength="15" value="<?php echo $ifsc;?>">
   <span class="error">* <?php echo $ifscErr;?></span>
   <br><br>
   <label for="password">Password : 
   <input type="password" name="password" id="password" maxlength="25" value="<?php echo $password;?>">
   <span class="error">* <?php echo $passwordErr;?></span>
   <span id="password-result"></span>
   <br><br>
   <label for="amtpay">Amount Payable : 
   <input type="text" name="amtpay" id="amtpay" maxlength="15" value="<?php echo $amtpay;?>">
   <span class="error">* <?php echo $amtpayErr;?></span>
   <br><br>
   <label for="lastU">Last Updated : 
   <input type="text" name="lastU" id="lastU" maxlength="15" value="<?php echo $lastU;?>">
   <span class="error">* <?php echo $lastUErr;?></span>
   <br><br>
   <label for="categorys">Category : 
   <input type="text" name="categorys" id="categorys" maxlength="15" value="<?php echo $categorys;?>">
   <span class="error">* <?php echo $categorysErr;?></span>
   <br><br>
   <label for="TINum">TIN Number : 
   <input type="text" name="TINum" id="TINum" maxlength="15" value="<?php echo $TINum;?>">
   <span class="error">* <?php echo $TINumErr;?></span>
   <br><br> 
   <input type="submit" name="submit" value="Submit"> 
   <br><br>
   </label>
   </div>
   
   <br><br><br><br><br><br><br><br><br><br>
</form>

<?php
   if (!$clientIDErr && !$nameErr && !$cAddrErr && !$cCityErr && !$routesErr && !$cPersonErr &&
   !$cpMobileErr && !$aPhoneErr && !$emailErr && !$usernameErr && !$vehicleErr && !$panErr &&
   !$accNameErr && !$accNumErr && !$ifscErr && !$passwordErr && !$amtpayErr && 
   !$lastUErr && !$categorysErr && !$TINumErr && $clientID && $name && $cAddr && $cCity && $routes && $cPerson &&
   $cpMobile && $aPhone && $email && $username && $vehicle && $pan &&
   $accName && $accNum && $ifsc && $password && $amtpay && 
   $lastU && $categorys && $TINum){


      $sql = "INSERT INTO Client 
      VALUES ('$clientID', '$name', '$cAddr', '$cCity', '$routes', '$cPerson', '$cpMobile', '$aPhone', '$email', '$username', '$vehicle', '$pan', '$accName', '$accNum', 
      '$ifsc', '$password', '$amtpay', '$lastU', '$categorys', '$TINum')";
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
         echo "<td>" . $row['$clientID'] . "</td>";
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