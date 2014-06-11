<?php 
###### db ##########
$db_username = 'root';
$db_password = '';
$db_name = 'Resfeber_Labs';
$db_host = 'localhost';
################

///check we have username post var
if(isset($_POST["tID"]))
{
    //check if its ajax request, exit script if its not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
    
    //try connect to db
    $connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
    
    //trim and lowercase username
    $tID =  strtolower(trim($_POST["tID"])); 
    
    //sanitize username
    $tID = filter_var($tID, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    
    //check username in db
    $results = mysqli_query($connecDB,"SELECT Transaction_ID FROM Transaction WHERE Transaction_ID = '$tID'");
    
    //return total count
    $tID_exist = mysqli_num_rows($results); //total records
    
    //if value is more than 0, username is not available
    if($tID_exist || !preg_match("/^[a-zA-Z0-9_-]{1,}$/",$tID)) {
        die('<img src="not-available.png" />');
    }else{
        die('<img src="available.png" />');
    }
    
    //close db connection
    mysqli_close($connecDB);
}
?>
