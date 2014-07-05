<?php
session_start();
include("./include/website_config.php");//For Normal Login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>:: About Us ::</title>
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
        <li class="active"><a href="about-us.php">About</a></li>
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
      <li><a href="#">About Us</a></li>
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
    <b><big><big><big><big>About us</big></big></big></big></b><br><br><br>
    <p><big>Why Choose Us?</big></p>
    <p>ThePorter is a revolutionary approach that makes intra-city pickups and deliveries thoroughly efficient and reliable. We have a varied fleet of vehicles under our command, ranging from Tata Ace to Tata 909, spread all over Mumbai. Big, small, whatever your requirement: You name it, we have it!</p>
    <p>Our partnered drivers are tracked on real-time basis, ensuring that a mini-truck that exactly satisfies the customer’s requirement is made available to him, within 60 minutes. We intend to give structure to this largely unprofessional and unregulated industry.  It’s as simple as calling a cab: Just go ahead and give it a try. </p>
    <ul>
      <li>Real-time tracking: No need to keep calling the driver to know his location, especially for time-sensitive deliveries. Track the vehicle using our state-of-the-art web-interface and get periodical SMS alerts. Let us worry about your delivery and let your mind be at peace.</li>
      <li>Transparent Pricing:  Owing to the unorganization in this industry, there is no thumb rule for pricing as it is largely driven by whims and fancies of the driver.  Stop wasting your time haggling, Start enjoying economical and transparent pricing through us. Rely on us to help you ensure consistent, seamless consumer experiences at the lowest cost.</li>
      <li>Fleet Management: We have developed an end-to-end suite of solutions encompassing the best practices tailor-fit to nuances of logistics business in India. This includes management tools for Live tracking with replay of historic tracks,Periodic SMS/email alerts, Geo-fencing alerts, Scheduled Reports and Client specific customization.</li>
      <li>Branding made more visible: We try and help brands place their print media content over the body of the vehicle. This strategy not only helps brands get cheaper marketing options with greater visibility but also provides the driver with a secondary source of income.</li>
    </ul> 
<hr />
<br>
<div class="row-fluid">
<div class="span4">
<big><big>Get in Touch!</big></big><br><br>
<p>Contact us using any of the following and we'll get back to you shortly.</p>
<h6>Address:</h6>
<p>201, <br>Akhileshwar Apartments,<br> Cross Nagardas Road,<br>Andheri East,<br> Mumbai,<br> Maharashtra.</p>
<hr />
<h6>Phone number:</h6>
<p style="margin-top: -10px;">+918105851480</p>
<hr />
<h6>E-mail:</h6>
<p style="margin-top: -10px;"><script type='text/javascript'>
 <!--
 var prefix = '&#109;a' + 'i&#108;' + '&#116;o';
 var path = 'hr' + 'ef' + '=';
 var addy92862 = '&#105;nf&#111;' + '&#64;';
 addy92862 = addy92862 + 'th&#101;p&#111;rt&#101;r' + '&#46;' + '&#105;n';
 document.write('<a ' + path + '\'' + prefix + ':' + addy92862 + '\'>');
 document.write(addy92862);
 document.write('<\/a>');
 //-->\n </script><script type='text/javascript'>
 <!--
 document.write('<span style=\'display: none;\'>');
 //-->
 </script>This email address is being protected from spambots. You need JavaScript enabled to view it.
 <script type='text/javascript'>
 <!--
 document.write('</');
 document.write('span>');
 //-->
 </script></p>
<hr />
<h6>Social connect </h6>
</div>
<div class="span8">       
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=true"></script>
    
      <script type="text/javascript">
        var myLatlng  = new google.maps.LatLng(19.122972,72.848757);
        function initialize() {
        var mapOptions = {
          zoom: 16,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP        };
        var map = new google.maps.Map(document.getElementById('sp_simple_map_canvas'), mapOptions);
        var marker = new google.maps.Marker({position:myLatlng, map:map});  
        }
        google.maps.event.addDomListener(window, 'load', initialize);
      </script>
      
      <div style="height:400px" id="sp_simple_map_canvas"></div>
        
      </div>
</div>
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
</div>
</body>
</html>