<?php
session_start();
include("./include/website_config.php");//For Normal Login
?>
<?php
require('db.php');

$sql = "SELECT * FROM order_details WHERE now() > pickup_datetime ORDER BY pickup_datetime DESC LIMIT 3";
$resource = mysqli_query($link, $sql);
$order_details = array();
while($row = mysqli_fetch_assoc($resource)){
  $order_details[] = $row;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>:: Dashboard ::</title>
<meta charset="utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>
  <script src="js/scroll-pagination.js" type="text/javascript"></script>
  <script src="js/slimScroll.js" type="text/javascript"></script>
  <link href="styles.css" rel="stylesheet" type="text/css" />
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
         span{height:40px; width:40px; display:block; position:relative;} 

.demoSpan1{height:8px; width:8px; display:block; border:1px solid #333; border-radius:25px;-webkit-border-radius:25px;-moz-border-radius:25px; top: 15px; right: 20px;}

.demoSpan1:after{content:''; height:4px; width:4px; display:block; background:#333; border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px; position:relative
; top:2px; left:2px;}
        body { font-family:Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse;}
        #report h4 { margin:0px; padding:0px;}
        #report img { float:right;}
        #report ul { margin:10px 0 10px 40px; padding:0px;}
        #report th { color:#000; padding:15px 15px; text-align:left;}
        #report td { none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td { background:#fff repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
$(function(){
  /**
  * Integrating slim scroll
  **/
  $("#feeds ul").slimScroll({
        height: '520px'
    });
  /**
  * Integrating Scroll Pagination
  **/
  var feeds = $("#feeds ul");
  var last_time = feeds.children().last().attr('id');
    feeds.scrollFeedPagination({
        'contentPage': 'dash-home.php',
        'contentData': {
            'last_time' : pickup_datetime
        },
        'scrollTarget': feeds, 
        'beforeLoad': function(){
            feeds.parents('#feeds').find('.loading').fadeIn();
        },
        'afterLoad': function(elementsLoaded){
            last_time = feeds.children().last().attr('id');
            feeds.scrollFeedPagination.defaults.contentData.last_time = last_time;
            feeds.parents('#feeds').find('.loading').fadeOut();
            var i = 1;
            $(elementsLoaded).fadeInWithDelay();
        }
    });
    $.fn.fadeInWithDelay = function(){
        var delay = 0;
        return this.each(function(){
            $(this).delay(delay).animate({
                opacity:1
            }, 200);
            delay += 100;
        });
    };
  //calling the function to update news feed
    setTimeout('updateFeed()', 1000);
});
/**
* Function to update the news feed
**/
function updateFeed(){
    var id = 0;
    id = $('#feeds li :first').attr('id');
        $.ajax({
            'url' : 'dash-home.php',
            'type' : 'POST',
            'data' : {
                'latest_news_time' : id  
            },
            success : function(data){
        setTimeout('updateFeed()', 1000);
        if(id != 0){
                  $(data).prependTo("#feeds ul");
        }
            }
        }) 
  }
</script>
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
              88.94
            </div>
          <div class = "info-box1">
              Time
          </div>
          <div class = "info-box2">
              24.05
            </div>
            <div class = "info-box11">
              Subtotal
          </div>
          <div class = "info-box22">
              ₹ 162.99
            </div>
          <div class = "det2">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              9:00 PM
          </div>
            14, Mahatma Gandhi Road, FM Cariappa Colony, Shivaji Nagar, Bangalore, Karnataka 560001, India
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              9:31 PM
            </div>
            121/18, Hosur Road, Koramangala 7th Block, Koramangala, Bangalore, Karnataka 560095, India
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
            5.93
          </div>
          <div class = "det231">
            00:24:03
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
      You rode with Sampath Kumar
            
    </div>
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