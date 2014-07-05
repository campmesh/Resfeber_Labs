<?php
session_start();
include("./include/website_config.php");//For Normal Login
include("./include/setup_google.php");//For Google
include("./include/setup_fb.php");//For FB
//~~~~~~~~~~FACEBOOK LOGIN START~~~~~~~~~~~~~~~
$loginUrl = $facebook->getLoginUrl($params);
//~~~~~~~~~~FACEBOOK LOGIN END~~~~~~~~~~~~~~~
//~~~~~~~~~~GOOGLE LOGIN START~~~~~~~~~~~~~~~
$oauth2 = new apiOauth2Service($client);
//~~~~~~~~~~GOOGLE LOGIN END~~~~~~~~~~~~~~~
if(isset($_POST['register_submit'])&&isset($_POST['submitted']))
{
	if(isset($_POST['acc_verify_type'])&&$_POST['acc_verify_type']=='Email')
	{
		if($website->RegisterUserEmail())
		{
			 $website->RedirectToURL("thank-you.html");
		}
	}else if(isset($_POST['acc_verify_type'])&&$_POST['acc_verify_type']=='Mobile')
	{
		if(($url=$website->RegisterUserMobile())!=false)
		{
			 $website->RedirectToURL($url);
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>ThePorter | SignUp</title>
<meta charset="utf-8">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="layout/styles/fg_membersite.css"/>
<link rel="stylesheet" type="text/css" href="layout/styles/pwdwidget.css"/>
<script type='text/javascript' src='layout/scripts/gen_validatorv31.js'></script>
<script src="layout/scripts/pwdwidget.js" type="text/javascript"></script> 
<noscript>
		<style>html{display:none;}</style>
		<meta http-equiv="refresh" content="0.0;url=nojs/index.html">
	</noscript>
</head>
<body id="top">
  <?php
    $trackIDErr = $trackID = "";
  ?>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="nospace">
        <li><span class="icon-phone"></span> +918105851480</li>
        <li><span class="icon-envelope-alt"></span> info@theporter.in</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="icon-facebook"></i></a></li>
        <li><a class="faicon-pinterest" href="#"><i class="icon-pinterest"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="icon-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="icon-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="icon-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="icon-google-plus"></i></a></li>
        <li><a class="faicon-skype" href="#"><i class="icon-skype"></i></a></li>
        <li><a class="faicon-rss" href="#"><i class="icon-rss"></i></a></li>
      </ul>
    </div>
    <!-- ################################################################################################ --> 
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <img src="images/demo/Porter1.png" alt="">
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="about-us.php">About</a></li>
        <li><a href="solutions.php">Solutions</a></li>
        <li><a href="#">Fares</a></li>
        <li><a class = "drop" href="#">Track Order</a>
          <ul>
            <li><font size = "1"><a><div>Enter Waybill/Order Numbers. To track multiple orders, sperate numbers using space.</font></a></div></li>
            <li>
              <font size = "4">
              <form  method="post" action="check.php">
                <input type="text" name="trackID" id="trackID" size="28" value="">
                <span class="error"><?php echo $trackIDErr;?></span>
              </font></form>
            </li>
            <li><div>
            <font size = "1"><a>Please Select the type of Identification number:</a></div></font>
            </li>
            <li><form action="">
              <span class="trackoption iblock">
                <span class="iblock">
                  <input class="trackradio" type="radio" name="order_type" value = "waybill">
                </span>
                <span class="iblock">
                  <span><font size = "1">Waybill Number</font></span>
                </span>
              </span>
              <span class="trackoption iblock"> 
                <span class="iblock">
                  <input class="trackradio" type="radio" name="order_type" value = "refs_no">
                </span>
                <span class="iblock">
                  <span><font size = "1">Order Number</font></span>
                </span>
              </span>
          </form></li>
        </ul>
        </li>
        <?php
        if(!$website->CheckLogin())
    {
    ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">SignUp</a></li>
        <?php
    }
    else
    {
    ?>
        <li><a href="./dashboard/login-home.php">My Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php
    }
    ?>
      </ul>
    </nav>
    <!-- ################################################################################################ --> 
  </header>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <div id="breadcrumb"> 
    <!-- ########################################################################################## -->
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
    <!-- ########################################################################################## --> 
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main id="container" class="clear"> 
    <!-- container body --> 
    <div id="fg_membersite" align="center">
	<form id="register" action='<?php echo $website->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
		<fieldset>
			<table>
					<legend>Join Us</legend>
					<div class='short_explanation'>All fields are required</div><br/>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type='text'  class='spmhidip' name='<?php echo $website->GetSpamTrapInputName(); ?>' />
		
					<div><span class='error'><?php echo $website->GetErrorMessage(); ?></span></div>
					<tr><td>
					<div class='container_inside'>
						<input type='text' placeholder="First Name" name='first_name' id='first_name' value='<?php echo $website->SafeDisplay('first_name') ?>' maxlength="32" /><br/>
						<span id='register_first_name_errorloc' class='error'></span>
					</div>
                    </td><td>
					<div class='container_inside'>
						<input type='text' placeholder="Last Name"name='last_name' id='last_name' value='<?php echo $website->SafeDisplay('last_name') ?>' maxlength="32" /><br/>
						<span id='register_last_name_errorloc' class='error'></span>
					</div>
                    </td></tr>
                    <tr><td>
					<div class='container_inside'>
						<input type='text' placeholder="Email" name='email' id='email' value='<?php echo $website->SafeDisplay('email') ?>' maxlength="50" /><br/>
						<span id='register_email_errorloc' class='error'></span>
					</div>
                    </td><td>
					<div class='container_inside'>
						<input type="text" name="customer_mobile" id="customer_mobile" placeholder="Mobile Number" autocomplete="off"/>
						<br/>
						<span id='register_customer_mobile_errorloc' class='error'></span>
					</div>
                    </td></tr>
                    <tr><td>
					<div class='pwdcontainer'>
						<div class='pwdwidgetdiv' id='thepwddiv' ></div>
						<noscript>
							<input type='password' name='password' id='password' placeholder='Password' maxlength="50" />
						</noscript><br />
						<div id='register_password_errorloc' class='error' style="clear:both"></div>
					</div>
                    </td></tr>  
                                   
				</table>
                <!--
                <div class='container_inside'>
                    Account Verification using :
                      <label>
                          <input type="radio" name="acc_verify_type" value="Email"  id="acc_verify_type"/>
                          Email</label>
                      <label>
                      
                          <input type="radio" name="acc_verify_type" value="Mobile" id="acc_verify_type" />
                          Mobile</label><br />
                          <span id='register_acc_verify_type_errorloc' class='error'></span>
					</div><br />-->
                    <input type="hidden" name="acc_verify_type" id="acc_verify_type" value="Mobile" />
               <div class='container_inside'>
					<input type='submit' name='register_submit' value='Join' id="join"/>
				</div><br/>				
    	</fieldset>
	</form>
    <br/>
	<h6>Or SignUp using 
		<a href="<?php echo $loginUrl; ?>" class="fbLoginButton"><img border="0" alt="FB Login" title="Login with facebook" src="images/fb.jpg"></img></a>
		<!-- Code for FB Sign IN Ends --> or 
		<!-- Code for Google Sign IN Starts-->
		<a href="<?php echo $client->createAuthUrl()?>" class="googleLoginButton"><img border="0" alt="Google Login" title="Login with Google" src="images/google.jpg"></img></a>
		<!-- Code for Google Sign IN Ends --></h6>
		
           	
			<script type='text/javascript'>

			// <![CDATA[
			var pwdwidget = new PasswordWidget('thepwddiv','password');
			pwdwidget.MakePWDWidget();
		
			var frmvalidator  = new Validator("register");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
		
			frmvalidator.addValidation("first_name","req","Please provide your First name");
			frmvalidator.addValidation("last_name","req","Please provide your Last name");
	
			frmvalidator.addValidation("email","req","Please provide your email address");
			frmvalidator.addValidation("email","email","Please provide a valid email address");
				
			frmvalidator.addValidation("customer_mobile","req","Please Enter a Mobile Number");
			frmvalidator.addValidation("customer_mobile","maxlen=10","Mobile No. (Max 10 digits)");
			frmvalidator.addValidation("customer_mobile","numeric","Mobile No. must be numeric");
    		
			//frmvalidator.addValidation("acc_verify_type","selone_radio","Please Select One");
			
			frmvalidator.addValidation("password","req","Please provide a password");
			frmvalidator.addValidation("password","minlen=6","Min length for Password is 6");
			frmvalidator.addValidation("password","maxlen=25","Max length for Password is 25");

			function supports_input_placeholder() {
				var i = document.createElement('input');
				return 'placeholder' in i;
			}

			if (!supports_input_placeholder()) {
				var fields = document.getElementsByTagName('INPUT');
				for (var i = 0; i < fields.length; i++) {
					if (fields[i].hasAttribute('placeholder')) {
						fields[i].defaultValue = fields[i].getAttribute('placeholder');
						fields[i].onfocus = function () { if (this.value == this.defaultValue) this.value = ''; }
						fields[i].onblur = function () { if (this.value == '') this.value = this.defaultValue; }
					}
				}
			}
			// ]]>
			</script>
			<!-- Form Code End -->
    </div>
    </div>
    <!-- ########################################################################################## --> 
    <!-- / container body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="title">RESFEBER LABS PVT LTD</h6>
      <address class="push30">
      201, <br>
      Akhileshwar Apartments,<br>
      Cross Nagardas Road,<br>
      Andheri East - 400069,<br>
      Mumbai.
      </address>
      <ul class="nospace">
        <li class="push10"><span class="icon-time"></span> 24 X 7</li>
        <li class="push10"><span class="icon-phone"></span> +91-8105851480</li>
        <li><span class="icon-envelope-alt"></span> info@theporter.in</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Legal</h6>
      <ul class="nospace clear">
        <li class="clear push30">
          <div class="imgl"><img src="images/demo/80x80.gif" alt=""></div>
          <p class="nospace push15">Privacy</p>
          <p class="nospace"><a href="privacy.php">Read more &raquo;</a></p>
        </li>
        <li class="clear">
          <div class="imgl"><img src="images/demo/80x80.gif" alt=""></div>
          <p class="nospace push15">Services</p>
          <p class="nospace"><a href="services.php">Read more &raquo;</a></p>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Careers</h6>
      <ul class="nospace clear ftgal">
        <li class="one_third first"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/100x100.gif" alt=""></a></li>
      </ul>
    </div>
    <!-- ################################################################################################ --> 
  </footer>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">ThePorter.in</a></p>
    <p class="fl_right">Developed by <a target="_blank" href="http://www.theporter.in/" title="Website Templates">ThePorter.in</a></p>
    <!-- ################################################################################################ --> 
  </div>
</div>
</body>
</html>