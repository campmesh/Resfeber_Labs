<?php
session_start();
include("./include/website_config.php");//For Normal Login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>:: Solutions ::</title>
<meta charset="utf-8">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
  <?php
    $trackIDErr = $trackID = "";
  ?>
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
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <img src="images/demo/Porter1.png" alt="">
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li><a href="index.php">Home</a></li>
        <li><a href="about-us.php">About</a></li>
        <li class="active"><a href="solutions.php">Solutions</a></li>
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
      <li><a href="#">Solutions</a></li>
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
    <!-- ########################################################################################## -->
    <b><big><big><big><big>Solutions</big></big></big></big></b><br><br><br>
    <p><big><big><big>Unified Platform for Logistics Support</big></big></big></p>
    <p>India’s evolving economic landscape requires all sellers to continuously create more robust, efficient and technically advanced support for their business ranging from marketing to logistics. Maximizing the potential of your business requires re-defining business strategy and adapting to continuously evolving customer demands every day.</p>
    <big>Logistics Partner</big><br>
    <p>Logistics is the backbone of supply-chain management. Our suite of mini-truck offerings for intra-city logistics coupled with web-based tracking and periodical alerts have been designed to provide seamless consumer experience. We specialize in intra-city logistics and enjoy advantages to high economy of scale, enabling us to provide transparent and economical price.  Book a mini-truck without going through the hassle of calling multiple vendors and haggling for prices.</p>
    <p><b>Logistics Management</b>: Efficient Management, Web Tracking, SMS Alerts.</p>
    <p><b>Order Management</b>: Ease and Convenience, Mini-Truck within 60 minutes, Dedicated Support Staff.</p>
    <p><b>Economies of Scale</b>: Widespread Network, Economical Pricing, Safety and Reliability, Advertisement.</p><br>
    <big>Tracking Integrated Platform</big><br>
    <p>We provide a unified tracking solution for fleet management, helping owners maximize their capacity utilization. Our reporting and business intelligence tools provide real-time and periodic business performance metrics. Increase deployment efficiency by dispatching the closest vehicle to any job site; reduce phone calls to the drivers in the field and better customer satisfaction by enhanced response time and periodical alerts.</p>
    <p><b>Fleet Management</b>: Geo-Fencing, Optimization Analytics, Historical Track Replays, SMS alerts</p>
    <p><b>Capacity Utilization</b>: Dispatching and Routing Efficiency, Warranted usage</p>
<hr />
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