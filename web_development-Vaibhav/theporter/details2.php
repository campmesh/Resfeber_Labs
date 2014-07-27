<?php
session_start();
include("./include/website_config.php");//For Normal Login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>:: Dashboard ::</title>
<meta charset="utf-8">
  <link href="styles.css" rel="stylesheet" type="text/css" />
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
        body { font-family:Helvetica, Sans-Serif; font-size:0.8em;}
        #report td { none repeat-x scroll center left; color:#000; padding:7px 15px; }
    </style>
</head>
<body id="top">
  <?php
    $trackIDErr = $trackID = "";
  ?>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->

<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row11">
  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left1">
      <a href="index.php"><img src="images/demo/Porter_White-01.jpg" alt=""></a>
    </div>
    <!-- ################################################################################################ --> 
  </header>
</div>


<div class="wrapper row31">
  <main id="container" class="clear">
  <div class = "head-trip">
    YOUR TRIP<br>
    <div class = "heady">
      9:00 PM on July 5 2014
    </div>
  </div> 
    <!-- container body --> 
    <!-- ########################################################################################## -->
    <div class="sidebar one_quarter1 first"> 
      <!-- #####################
##################################################################### -->
      <nav class="sdb_holder">
        <ul>
          <li><a href="#">Dashboard</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Vehicles</a>
          <li><a href="#">Billing</a>
          <li><a href="#">Activity History</a></li>
          <li><a href="#">Account Settings</a>
        </ul>
      </nav>
    </div>
  <div id="content" class="three_quarter"> 
      <table id = "report" style="width:802px">
        <thead>
        <tr>
          <th><button type="submit" class="btn--primary1">Find Lost Item</button></th>
          <th><button type="submit" class="btn--primary1">Get a Fare Review</button></th>
          <th><button type="submit" class="btn--primary1">Resend Receipt</button></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="3">
            <div class="map-img2">
              <img src = "http://maps.googleapis.com/maps/api/staticmap?size=400x400&maptype=roadmap&path=color:0x38C4E7ff|weight:3|19.122972,72.848757|19.122425, 72.847757|19.117139, 72.846564|19.118539, 72.836776&sensor=false&zoom=15">
            </div>
            <div class = "text-box2">FARE BREAKDOWN</div>
            <div class = "money-box">
          </div>
          <div class = "info-box1">
              Base Fare
            </div>
            <div class = "info-box2">
              50.00
            </div>
            <div class = "info-box1">
              Distance
          </div>
          <div class = "info-box2">
              73.66
            </div>
          <div class = "info-box1">
              Time
          </div>
          <div class = "info-box2">
              26.65
            </div>
            <div class = "info-box11">
              Subtotal
          </div>
          <div class = "info-box22">
              ₹ 150.31
            </div>
          <div class = "det2">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              4:34 PM
          </div>
            121/18, Hosur Road, Koramangala 7th Block, Koramangala, Bangalore, Karnataka 560095, India
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              5:19 PM
            </div>
            Residency Cross Road, Shanthala Nagar, Ashok Nagar, Bangalore, Karnataka 560001, India
          </div>
          <div class = "det21">
            VEHICLE
          </div>
          <div class = "det22">
            KILOMETERS
          </div>
          <div class = "det23">
            TRIP TIME
          </div>
          <div class = "det211">
            PORTERX
          </div>
          <div class = "det221">
            4.91
          </div>
          <div class = "det231">
            00:26:39
          </div>
        </td>
        </tr> 
      </tbody>
    </table>
    <div class = "driver-info"><div class="rating">
              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="!Rocks">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
            </div>
      You rode with Ramesh
            
    </div>
</div>
 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<!-- JAVASCRIPTS --> 
<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> --> 
<script src="layout/scripts/jquery-latest.min.js"></script> 
<!-- Homepage Slider --> 
<script src="layout/scripts/supersized/supersized.min.js"></script> 
<script>
jQuery(function ($) {
    $.supersized({
        slides: [{
            image: 'images/demo/slider/1.png',
            title: 'Overlay text for image 1<br><small>smaller subline text</small>'
        }, {
            image: 'images/demo/slider/2.png',
            title: 'Overlay text for image 2'
        }, {
            image: 'images/demo/slider/3.png',
            title: 'Overlay text for image 3'
        }]
    });
});
</script>
</body>
</html>