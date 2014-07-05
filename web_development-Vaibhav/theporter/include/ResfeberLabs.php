<?PHP
require_once("class.phpmailer.php");
require_once("formvalidator.php");
require_once("phpsms_sender.php");
class ResfeberLabs
{
    var $username;
    var $pwd;
	var $db_host;
    var $database;
    var $connection;
    var $error_message;
	var $sitename;
	var $errlog_file;
	var $rand_key;
	
	//-----Initialization -------
    function ResfeberLabs()
    {
        $this->sitename = 'http://theporter.in';
    }
    function InitDB($host,$uname,$pwd,$database)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;        
    }
    function SetErrLogFilePath($file)
	{
		$this->errlog_file = $file;
	}
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
  	function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    //-------Helper functions -------------
    function getSystemTime()
	{
		date_default_timezone_set('Asia/Kolkata');
		return date('d-m-Y H:i');
	}
	function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
	function log_error($str)
	{
		$str=":TIMESTAMP = ".$this->getSystemTime().": ".$str."\r\n";
		file_put_contents($this->errlog_file,$str,FILE_APPEND);
	}
	
	function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    function SafeDisplay_GET($value_name)
    {
        if(empty($_GET[$value_name]))
        {
            return'';
        }
        return htmlentities($_GET[$value_name]);
    }
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    	
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    

    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
	function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
      
    function SanitizeForSQL($str)
    {

        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
	 /*Login & Registration Mudule */
	 //User Registration Main
    function RegisterUserEmail()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }
		
        //$this->SendAdminIntimationEmail($formvars);
        
        return true;
    }
	function RegisterUserMobile()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        //Proceed For Account Confirmation using Mobile
		if(!$this->SendUserConfirmationSMS($formvars))
        {
            return false;
        }
		$confirmcode = $formvars['confirmcode'];        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg_mobile.php?email='.urlencode($formvars['email']).'&code='.urlencode($confirmcode).'&customer_mobile='.urlencode($formvars['customer_mobile']);
		
        return $confirm_url;
    }
//User Registration Main End
    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10||empty($_GET['email']))
        {
            $this->HandleError("Please provide the confirm code & email");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        /*
        $this->SendAdminIntimationOnRegComplete($user_rec);
        */
        return true;
    }    
    
	function ConfirmUserMobile()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10||empty($_GET['email'])||empty($_GET['customer_mobile'])||empty($_GET['verification_code']))
        {
            $this->HandleError("Please provide the confirm code, email & mobile no");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmationMobile($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        /*
        $this->SendAdminIntimationOnRegComplete($user_rec);
        */
        return true;
    }    
    
	function ConfirmUserMobile_Google_FB_Users()
    {
        if(empty($_GET['confirmcode'])||strlen($_GET['confirmcode'])<=10||empty($_GET['email'])||empty($_GET['customer_mobile'])||empty($_GET['verification_code']))
        {
            $this->HandleError("Please provide the confirm code, email & mobile no");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmationMobile_Google_FB_Users($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        /*
        $this->SendAdminIntimationOnRegComplete($user_rec);
        */
        return true;
    } 
	
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar])||empty($_SESSION['customer_id']))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return $_SESSION['first_name'].' '.$_SESSION['last_name'];
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email'])?$_SESSION['email']:'';
    }
    
    function LogOut()
    {
        session_start();
        $sessionvar = $this->GetLoginSessionVar();
        unset($_SESSION[$sessionvar]);
		if($_SESSION['login']=='FB')
		{unset($_SESSION['fb_uid']);
		unset($_SESSION['fb_access_token']);}
		unset($_SESSION['login']);//login=FB,Google,ThePorter
		unset($_SESSION['customer_id']);
		unset($_SESSION['name']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);
		unset($_SESSION['customer_mobile']);
		unset($_SESSION['email']);
		session_destroy();
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
			//$this->HandleError('Invalid Email Address/Email not registered');
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
			$this->HandleError('Password Reset Link delivery failed.');
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("Reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad Reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpassword']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['password']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpassword']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['password']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
	 
	 function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL(trim($username));
        $pwdmd5 = md5($password);
        $qry = 'Select customer_id, first_name, last_name, email, customer_mobile, confirmcode, verification_code from customer where email="'.$username.'" and password="'.$pwdmd5.'"';        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("The username or password is incorrect");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
		if($row['confirmcode']!='y'&&$row['verification_code']!='y')
		{
			$this->HandleError("Please activate your account before logging in");
			return false;
		}		
        $_SESSION['customer_id'] = $row['customer_id'];
		$_SESSION['login']='ThePorter';
		$_SESSION['name']  = $row['first_name'].' '.$row['last_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] =$row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['customer_mobile'] = $row['customer_mobile'];
		return true;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        $email = $this->SanitizeForSQL($_GET['email']);
        
		$qry='Select first_name, last_name, email from customer where confirmcode="'.$confirmcode.'" and email="'.$email.'"';
		$result = mysql_query($qry,$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code Given.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['first_name'] = $row['first_name'];
        $user_rec['last_name'] = $row['last_name'];
        $user_rec['email']= $row['email'];
        
        $qry = 'Update customer set confirmcode="y" where  confirmcode="'.$confirmcode.'" and email="'.$email.'"';
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
	
	function UpdateDBRecForConfirmationMobile(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        $email = $this->SanitizeForSQL($_GET['email']);
        $verification_code = $this->SanitizeForSQL($_GET['verification_code']);
        $customer_mobile = $this->SanitizeForSQL($_GET['customer_mobile']);		
		
		$qry='Select first_name, last_name, email from customer where customer_mobile="'.$customer_mobile.'" and confirmcode="'.$confirmcode.'" and verification_code="'.$verification_code.'" and email="'.$email.'"';
		$result = mysql_query($qry,$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code Given.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['first_name'] = $row['first_name'];
        $user_rec['last_name'] = $row['last_name'];
        $user_rec['email']= $row['email'];
        
        $qry = 'Update customer set verification_code="y" where  verification_code="'.$verification_code.'" and confirmcode="'.$confirmcode.'" and  customer_mobile="'.$customer_mobile.'" and email="'.$email.'"';
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);
        
        $qry = 'Update customer Set password="'.md5($newpwd).'" Where  email="'.$user_rec['email'].'"';
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query('Select * from customer where email="'.$email.'"',$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Email id $email is not registered with us");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);
		if($user_rec['password']=='')
        {
			$this->HandleError("Kindly login with your Facebook or Google credentials");
            return false;
        }        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();

        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ThePorter.in!";
        
        $mailer->Body ="Hello ".$user_rec['first_name'].",\r\n\r\n".
        "Your account is now activated and you are good to go.\r\n\r\n".
	"Like us on Facebook or Follow us on Google/Twitter to get latest updates and connect with us.\r\n\r\n".
        "Warm Regards,\r\n".
        "ThePorter.in Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['first_name']." ".$user_rec['last_name'];
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['first_name']." ".$user_rec['last_name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['first_name'].",\r\n\r\n".
        "You seem to have forgotten your password. Please click on the link below to reset your password. \r\n\r\n".$link."\r\n\r\n".
        "Warm Regards,\r\n".
        "ThePorter.in Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['first_name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;
        
        $mailer->Body ="Hello ".$user_rec['first_name'].",\r\n\r\n".
        "Your password has been successfully reset. Your new password is: ".$new_password." \r\n\r\n".
        "Please use this password when you login next. You can change your password by clicking on your name (displayed on the top right corner) once you login.\r\n\r\n".
        "Warm Regards,\r\n".
        "ThePorter.in Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    //Validation of Submitted Registration/SignUP Form by User On Server Side--Starts
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("first_name","req","Please fill in Name");
        $validator->addValidation("last_name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
		$validator->addValidation("email","req","Please fill in Email");
		$validator->addValidation("customer_mobile","numeric","The input for Phone No. should be a valid Number");
        $validator->addValidation("customer_mobile","req","Please fill in Phone No.");
	    $validator->addValidation("password","req","Please fill in Password");
        $validator->addValidation("password","minlen=6","Min length for Password is 6");
        $validator->addValidation("password","maxlen=25","Max length for Password is 25");
		$validator->addValidation("acc_verify_type","req","Select Verification Method");

        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    //Validation of Submitted Registration/SignUP Form by User On Server Side--END
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['first_name'] = $this->Sanitize($_POST['first_name']);
        $formvars['last_name'] = $this->Sanitize($_POST['last_name']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['customer_mobile'] = $this->Sanitize($_POST['customer_mobile']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['first_name']);
        
        $mailer->Subject = "Activate your account on ".$this->sitename;

        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?email='.$formvars['email'].'&code='.$confirmcode.'&change_reg=true';
        
        $mailer->Body ="Hello ".$formvars['first_name'].",\r\n\r\n".
        "We are very pleased that you decided to join us. Please click on the link below to activate your account.\r\n\r\n".
        "$confirm_url\r\n\r\n".
        "Warm Regards,\r\n".
        "ThePorter.in\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
	function SendUserConfirmationSMS(&$formvars)
	{
		$sms_sender = new SMS_Sender();
		
		$sms_sender->AddReceipient($formvars['customer_mobile']);

		$sms_sender->AddMessage('You are on DND list. '.$formvars['customer_mobile'].' wants to add you as customer. If you do wish to receive their calls, give a missed call to '.$formvars['verification_code']);
	
		if(($response=$sms_sender->Send())!='200')
		{
			$this->log_error("File : phpsms_sender.php : SMS SENDING FAILED FOR : ".$formvars['customer_mobile']." Error Code : ".$response);
			return false;
		}
		return true;
	}
	function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];
       
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['first_name']." ".$formvars['last_name']."\r\n".
        "Email address: ".$formvars['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    //SAVE values in formvars array to database
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = 'select email from customer where '.$fieldname.'="'.$field_val.'"';
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
     function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function MakeConfirmationCodeMobile($mobile)
    {
		$bignum = hexdec(substr(sha1($mobile.uniqid()), 0, 8));
        return substr($bignum,0,5);
    }

   function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);
		$verification_code = $this->MakeConfirmationCodeMobile($formvars['customer_mobile']);
        
        $formvars['confirmcode'] = $confirmcode;
		$formvars['verification_code'] = $verification_code;
        
        $insert_query = 'insert into customer (
                first_name,
                last_name,
                email,
				customer_mobile,
                password,
                confirmcode,
				verification_code
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['first_name']) . '",
                "' . $this->SanitizeForSQL($formvars['last_name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['customer_mobile']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '",
				"' . $verification_code. '"
                )';      
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        return true;
    }
       
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }
	
	/* Function for Facebook & Google SignUp  */
	
	function Check_InDB_Google_FB($email,$login)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL(trim($email));
        $qry = 'Select customer_id, first_name, last_name, email, customer_mobile from customer where email="'.$username.'" and confirmcode="y"';
        $result = mysql_query($qry,$this->connection);
        if(!$result || mysql_num_rows($result) <= 0)
        {
            //$this->HandleError("Error logging in. The User NOT Found"); :Supress Error
            return false;
        }
        $row = mysql_fetch_assoc($result);
		$_SESSION['customer_id']=$row['customer_id'];
		$_SESSION['login']=$login;
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] =$row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['customer_mobile'] = $row['customer_mobile'];
		$_SESSION[$this->GetLoginSessionVar()]=$row['email'];
		return true;
    }
	
	function InsrtInDB_Google($info)	
    {
		// Set the properties that are to be inserted in the db
		$name = $info['name'];$pos = strpos($name,' ');
		$first_name = trim(substr($name,0,$pos));
		$last_name=trim(substr($name,$pos+1));
		$email=$this->SanitizeForSQL($info['email']);
		$confirmcode = $this->MakeConfirmationMd5($email);
        $insert_query = 'insert into customer (
                first_name,
                last_name,
                email,
		        confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($first_name).'",
                "' . $this->SanitizeForSQL($last_name). '",
                "' . $email. '",
                "' . $confirmcode . '"
                )';      
        if(!mysql_query($insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
		$qry = 'Select customer_id, first_name, last_name, email, customer_mobile, confirmcode from customer where email="'.$email.'"';
        $result = mysql_query($qry,$this->connection);
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The User NOT Found");
            return false;
        }
        $row = mysql_fetch_assoc($result);       
        return $row;
    }
	
	function InsrtInDB_FB($user_profile)
    {
		$first_name=$user_profile['first_name'];
		$last_name=$user_profile['last_name'];
		$email=$user_profile['email'];
		$confirmcode = $this->MakeConfirmationMd5($email);
        $insert_query = 'insert into customer (
                first_name,
                last_name,
                email,
		        confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($first_name) . '",
                "' . $this->SanitizeForSQL($last_name) . '",
                "' . $this->SanitizeForSQL($email) . '",
                "' . $confirmcode . '"
                )';      
        if(!mysql_query($insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
		$qry = 'Select customer_id, first_name, last_name, email, customer_mobile, confirmcode from customer where email="'.$email.'"';
        $result = mysql_query($qry,$this->connection);
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The User NOT Found");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        return $row;
    }
	function UpdateDBForMobile_SendSMS()
	{
		$formvars = array();
		if(!$this->UpdateDBRecForMobile_VerificationCode_Google_FB($formvars))
		{
			$this->HandleError("Mobile No. Update Failed!");
            return false;
		}
		if(!$this->SendUserConfirmationSMS($formvars))
        {
			$this->HandleError("SMS Sending Failed!");
            return false;
        }
		return true;
	}
	
	function UpdateDBRecForMobile_VerificationCode_Google_FB(&$formvars)
	{
		//Generate Verification_code & save to DB
		if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		// Server Side Validations
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_GET[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("confirmcode","req","Bad Email Code");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
		$validator->addValidation("email","req","Bad Email ID");
		$validator->addValidation("customer_mobile","numeric","The input for Phone No. should be a valid Number");
        $validator->addValidation("customer_mobile","req","Please fill in Phone No.");


        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
		/* Server Side Validation Ends */
		$formvars['customer_mobile']=$this->SanitizeForSQL($_GET['customer_mobile']);
		$formvars['verification_code']=$this->MakeConfirmationCodeMobile($formvars['customer_mobile']);
		$formvars['confirmcode']=$this->SanitizeForSQL($_GET['confirmcode']);
		$formvars['email']=$this->SanitizeForSQL($_GET['email']);
		$qry = 'Update customer set verification_code="'.$formvars['verification_code'].'", customer_mobile="'.$formvars['customer_mobile'].'" where confirmcode="'.$formvars['confirmcode'].'" and email="'.$formvars['email'].'"';

        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        return true;
	}
	
	function UpdateDBRecForConfirmationMobile_Google_FB_Users(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
		// Server Side Validations
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_GET[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("verification_code","req","Please fill in Verification Code");
        $validator->addValidation("confirmcode","req","Bad Email Code");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
		$validator->addValidation("email","req","Bad Email ID");
		$validator->addValidation("customer_mobile","numeric","The input for Phone No. should be a valid Number");
        $validator->addValidation("customer_mobile","req","Please fill in Phone No.");


        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
		/* Server Side Validation Ends */     
        $confirmcode = $this->SanitizeForSQL($_GET['confirmcode']);
        $email = $this->SanitizeForSQL($_GET['email']);
        $verification_code = $this->SanitizeForSQL($_GET['verification_code']);
        $customer_mobile = $this->SanitizeForSQL($_GET['customer_mobile']);		
		
		$qry='Select customer_id, first_name, last_name, email, customer_mobile from customer where customer_mobile="'.$customer_mobile.'" and confirmcode="'.$confirmcode.'" and verification_code="'.$verification_code.'" and email="'.$email.'"';
		$result = mysql_query($qry,$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code Given.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['first_name'] = $row['first_name'];
        $user_rec['last_name'] = $row['last_name'];
        $user_rec['email']= $row['email'];
        
        $qry = 'Update customer set verification_code="y", confirmcode="y" where  verification_code="'.$verification_code.'" and confirmcode="'.$confirmcode.'" and  customer_mobile="'.$customer_mobile.'" and email="'.$email.'"';
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating data to the table\nquery:$qry");
            return false;
        }
		$_SESSION['customer_id']=$row['customer_id'];
		$_SESSION['login']=$this->SanitizeForSQL($_GET['login']);
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] =$row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['customer_mobile'] = $row['customer_mobile'];
        $_SESSION[$this->GetLoginSessionVar()]=$email;      
        return true;
    }
}
?>