<?php 
###### db ##########
$db_username = 'root';
$db_password = '';
$db_name = 'Resfeber_Labs';
$db_host = 'localhost';
################

///check we have username post var
if(isset($_POST["carrier"]))
{
    //check if its ajax request, exit script if its not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
    
    //try connect to db
    $connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
    
    //trim and lowercase username
    $carrier =  strtolower(trim($_POST["carrier"])); 
    
    //sanitize username
    $carrier = filter_var($carrier, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    
    //check username in db
    $results = mysqli_query($connecDB,"SELECT Name FROM Driver WHERE Carrier_Registration_Number = '$carrier'");
    
    //return total count
    $carrier_exist = mysqli_num_rows($results); //total records
    
    //if value is more than 0, username is not available
    if($carrier_exist) {
        die('<img src="not-available.png" />');
    }else{
        die('<img src="available.png" />');
    }
    
    //close db connection
    mysqli_close($connecDB);
}
?>
