<?php
session_start();
include("./include/website_config.php");//For Normal Login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>:: The Porter ::</title>
<meta charset="utf-8">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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
<div class="wrapper">
  <div id="slider"> 
    <!-- ############################################################################################################# -->
    <div id="slidewrap">
      <div class="heading"><span id="slidecaption"></span></div>
    </div>
    <!-- ############################################################################################################# --> 
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main id="container" class="clear"> 
    <!-- container body --> 
    <!-- ########################################################################################## -->
    <ul class="nospace push50 center clear">
      <li class="one_quarter first">
        <div class="push30"><span class="circle icon-flag"></span></div>
        <h6 class="push10">Location Tracking</h6>
        <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
        <p class="nospace"><a href="#">Read more &raquo;</a></p>
      </li>
      <li class="one_quarter">
        <div class="push30"><span class="circle icon-book"></span></div>
        <h6 class="push10">Quick Book</h6>
        <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
        <p class="nospace"><a href="#">Read more &raquo;</a></p>
      </li>
      <li class="one_quarter">
        <div class="push30"><span class="circle icon-trophy"></span></div>
        <h6 class="push10">Maecenas libero</h6>
        <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
        <p class="nospace"><a href="#">Read more &raquo;</a></p>
      </li>
      <li class="one_quarter">
        <div class="push30"><span class="circle icon-group"></span></div>
        <h6 class="push10">Blandit elementum</h6>
        <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
        <p class="nospace"><a href="#">Read more &raquo;</a></p>
      </li>
    </ul>
    <hr class="nospace push50">
    <ul class="nospace clear">
      <li class="one_quarter first"><a href="#"><img src="images/demo/gallery/gallery.gif" alt=""></a>
        <div class="borderedbox pad15">
          <h6 class="push10">Blandit elementum</h6>
          <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </div>
      </li>
      <li class="one_quarter"><a href="#"><img src="images/demo/gallery/gallery.gif" alt=""></a>
        <div class="borderedbox pad15">
          <h6 class="push10">Blandit elementum</h6>
          <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </div>
      </li>
      <li class="one_quarter"><a href="#"><img src="images/demo/gallery/gallery.gif" alt=""></a>
        <div class="borderedbox pad15">
          <h6 class="push10">Blandit elementum</h6>
          <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </div>
      </li>
      <li class="one_quarter"><a href="#"><img src="images/demo/gallery/gallery.gif" alt=""></a>
        <div class="borderedbox pad15">
          <h6 class="push10">Blandit elementum</h6>
          <p class="nospace push10">Integer imperdiet vestibulum leo ut tincidunt in sagittis.</p>
          <p class="nospace"><a href="#">Read more &raquo;</a></p>
        </div>
      </li>
    </ul>
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
<!-- JAVASCRIPTS --> 
<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> --> 
<script src="layout/scripts/jquery-latest.min.js"></script> 
<!-- Homepage Slider --> 
<script src="layout/scripts/supersized/supersized.min.js"></script> 
<script>
jQuery(function ($) {
    $.supersized({
        slides: [{
            image: 'images/demo/slider/Banner 1-01.jpg'
        }, {
            image: 'images/demo/slider/Banner 1-02.jpg'
        }, {
            image: 'images/demo/slider/Banner 1-03.jpg'
        }]
    });
});
</script>
</body>
</html>