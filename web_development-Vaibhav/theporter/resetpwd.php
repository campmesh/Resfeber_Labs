<?php
require_once("./include/website_config.php");
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
    <div id='fg_membersite_content'>
			<?php
				$success = false;
				if($website->ResetPassword())
				{
					$success=true;
				}
				if($success)
				{
			?>
					<br/><br/>
					<h4>Your password has been reset.</h4>
					<h5>Your new password has been sent to your registered email address.</h5>
			<?php
				}else
				{
			?>
					<h2>Error</h2>
					<span class='error'><?php echo $website->GetErrorMessage(); ?></span>
			<?php
				}
			?>
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