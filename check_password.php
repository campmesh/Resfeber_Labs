<?php 
###### db ##########
$db_username = 'root';
$db_password = '';
$db_name = 'Resfeber_Labs';
$db_host = 'localhost';
################

///check we have password post var
if(isset($_POST["password"]))
{
    //check if its ajax request, exit script if its not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }
    
    //try connect to db
    $connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
    
    //trim and lowercase password
    $password =  $_POST["password"]; 
    
    //sanitize password
    //$password = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    
    //check password in db
    //$results = mysqli_query($connecDB,"SELECT clientID FROM Client WHERE Password='$password'");
    
    //return total count
    //$password_exist = mysqli_num_rows($results); //total records
    
    //if value is more than 0, password is not available
    if(!preg_match("/(?=^(?:[^A-Z]*[A-Z]){2})(?=^(?:[^a-z]*[a-z]){2})(?=^(?:\D*\d){2})(?=^(?:\w*\W){2})^[A-Za-z\d\W]{8,}$/",$password)) {
        die('<img src="not-available.png" />');
    }else{
        die('<img src="available.png" />');
    }
    
    //close db connection
    mysqli_close($connecDB);
}
?>
