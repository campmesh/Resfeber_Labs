<?php
require_once("./include/website_config.php");
if(isset($_POST['reset_pwd_req_submit'])&&isset($_POST['submitted']))
{
	$emailsent = false;
	if($website->EmailResetPasswordLink())
	{
		$website->RedirectToURL("reset-pwd-link-sent.html");
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>ThePorter | Reset Password</title>
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
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="nospace">
        <li><span class="icon-phone"></span> +00 (123) 456 7890</li>
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
      <h1><a href="index.php">ThePorter</a></h1>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li><a href="index.php">Home</a></li>
        <li><a class="drop" href="#">Book Cab</a>
          <ul>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="full-width.html">Full Width</a></li>
            <li><a href="sidebar-left.html">Sidebar Left</a></li>
            <li><a href="sidebar-right.html">Sidebar Right</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Dropdown</a>
          <ul>
            <li><a href="#">Level 2</a></li>
            <li><a class="drop" href="#">Level 2 + Drop</a>
              <ul>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">SignUp</a></li>
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
      <li><a href="reset_password_req.php">Reset Password</a></li>
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
			<form id='resetreq' action='<?php echo $website->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				<fieldset >
					<legend>Reset Password</legend>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<div><span class='error'><?php echo $website->GetErrorMessage(); ?></span></div>
					<br/><br/>
					<div class='container_inside'>
						<input type='text' placeholder="Enter your registered email id" name='email' id='email' value='<?php echo $website->SafeDisplay('email') ?>' maxlength="50" /><br/>
						<span id='resetreq_email_errorloc' class='error'></span>
					</div><br/>
					<h6>A link to reset your password will be sent to your registered email id</h6><br/>
					<div class='container'>
						<input type='submit' name='reset_pwd_req_submit' value='Submit' />
					</div>

				</fieldset>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[

			var frmvalidator  = new Validator("resetreq");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
	
			frmvalidator.addValidation("email","req","Please enter an email address");
			frmvalidator.addValidation("email","email","Please provide a valid email address");

			// ]]>
			
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
			</script>
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
      <h6 class="title">Lorem ipsum dolor</h6>
      <address class="push30">
      Company Name<br>
      Street Name &amp; Number<br>
      Town<br>
      Postcode/Zip
      </address>
      <ul class="nospace">
        <li class="push10"><span class="icon-time"></span> Mon. - Fri. 9:00am - 7:00pm</li>
        <li class="push10"><span class="icon-phone"></span> +00 (123) 456 7890</li>
        <li><span class="icon-envelope-alt"></span> info@domain.com</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Lorem ipsum dolor</h6>
      <ul class="nospace clear">
        <li class="clear push30">
          <div class="imgl"><img src="./images/demo/80x80.gif" alt=""></div>
          <p class="nospace push15">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </li>
        <li class="clear">
          <div class="imgl"><img src="./images/demo/80x80.gif" alt=""></div>
          <p class="nospace push15">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Lorem ipsum dolor</h6>
      <ul class="nospace clear ftgal">
        <li class="one_third first"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="./images/demo/100x100.gif" alt=""></a></li>
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