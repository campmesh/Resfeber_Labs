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
<title>:: The Porter ::</title>
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
        #report th { repeat-x scroll center left; color:#000; padding:15px 15px; text-align:left;}
        #report td { background:#f7f7f7 none repeat-x scroll center left; color:#000; padding:7px 15px; }
        #report tr.odd td { background:#fff repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
    </style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">  
        $(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });
    </script>
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
    <!-- container body --> 
  <div class = "head-trip1">
    MY TRIPS
  </div> 
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
        <tr class="open1">
          <th height="20">Pickup</th>
          <th height="20">Driver</th>    
          <th height="20">Fare</th>
          <th height="20">Vehicle</th>
          <th height="20">Payment Method</th>
        </tr>
      </thead>
      <tbody>
        <tr class="open">
          <td height="50">07/05/14</td>
          <td height="50">Sampath Kumar</td>    
          <td height="50">₹ 162.00</td>
          <td height="50">PorterBLUE</td>
          <td height="50">••••1234</td>
        </tr>
        <tr>
          <td colspan="5">
            <div class="rating">
              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="!Rocks">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
            </div>
              <button type="submit" class="btn--primary">Resend</button>
              <a href="details1.php"><button type="submit" class="btn--secondary">View Detail</button></a>
            <div class="map-img">
              <img src = "http://maps.googleapis.com/maps/api/staticmap?size=250x250&path=color:0x38C4E7ff|weight:3|19.122972,72.848757|19.122425, 72.847757|19.117139, 72.846564|19.118539, 72.836776&sensor=false">
            </div>
            <div class = "text-box">₹ 162.00</div>
            <div class = "money-box">
              <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_logo_new1.jpg" border="0" style="width: 3%; height: 5%"/>
          </div>
          <div class = "money-box1">
              ••••1234
          </div>
          <div class = "det12">
            Saturday, July 5 2014 9:00 PM
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              9:00 PM
          </div>
            14, Mahatma Gandhi Road, FM Cariappa Colony, Shivaji Nagar, Bangalore, Karnataka 560001, India
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              9:31 PM
            </div>
            121/18, Hosur Road, Koramangala 7th Block, Koramangala, Bangalore, Karnataka 560095, India
          </div>
        </td>
        </tr class="open"> 
        <tr class="open">
          <td height="50">07/05/14</td>
          <td height="50">Ramesh</td>    
          <td height="50">₹ 150.00</td>
          <td height="50">PorterX</td>
          <td height="50">••••1234</td>
        </tr>
        <tr class="open">
          <td colspan="5">
            <div class="rating">
              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="!Rocks">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
            </div>
              <button type="submit" class="btn--primary">Resend</button>
              <a href="details2.php"><button type="submit" class="btn--secondary">View Detail</button></a>
            <div class="map-img">
              <img src = "http://maps.googleapis.com/maps/api/staticmap?size=250x250&path=color:0x38C4E7ff|weight:3|19.122972,72.848757|19.122425, 72.847757|19.117139, 72.846564|19.118539, 72.836776&sensor=false">
            </div>
            <div class = "text-box">₹ 150.00</div>
            <div class = "money-box">
              <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_logo_new1.jpg" border="0" style="width: 3%; height: 5%"/>
          </div>
          <div class = "money-box1">
              ••••1234
          </div>
          <div class = "det12">
            Saturday, July 5 2014 4:34 PM
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              4:34 PM
          </div>
            121/18, Hosur Road, Koramangala 7th Block, Koramangala, Bangalore, Karnataka 560095, India
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              5:19 PM
            </div>
            Residency Cross Road, Shanthala Nagar, Ashok Nagar, Bangalore, Karnataka 560001, India
          </div>
        </td>
        </tr> 
        <tr class="open">
          <td height="50">06/30/14</td>
          <td height="50">Thambirajan</td>    
          <td height="50">₹ 222.00</td>
          <td height="50">PorterX</td>
          <td height="50">••••1234</td>
        </tr>
        <tr class="open">
          <td colspan="5">
            <div class="rating">
              <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="!Rocks">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
            </div>
              <button type="submit" class="btn--primary">Resend</button>
              <a href="details3.php"><button type="submit" class="btn--secondary">View Detail</button></a>
            <div class="map-img">
              <img src = "http://maps.googleapis.com/maps/api/staticmap?size=250x250&path=color:0x38C4E7ff|weight:3|19.122972,72.848757|19.122425, 72.847757|19.117139, 72.846564|19.118539, 72.836776&sensor=false">
            </div>
            <div class = "text-box">₹ 222.00</div>
            <div class = "money-box">
              <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_logo_new1.jpg" border="0" style="width: 3%; height: 5%"/>
          </div>
          <div class = "money-box1">
              ••••1234
          </div>
          <div class = "det12">
            Monday, June 30 2014 6:03 PM<br>
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              6:03 PM
          </div>
            103, Challaghatta, Bangalore, Karnataka 560017, India
          </div>
          <div class = "det1">
            <span class="demoSpan1"></span>
            <div class = "money-box2">
              6:48 PM
            </div>
            Rhenius Street, Richmond Town, Bangalore, Karnataka 560025, India
          </div>
        </td>
        </tr> 
      </tbody>
    </table>
    </div>
<div class = "alert-box">
  <div class="main_container">
    <div class="feeds_container">
      <div id="feeds" class="feeds">
        <ul>
          <li><b>Alerts</b></li>
          <?php foreach($order_details as $item): ?>
          <li id="<?php echo $item['pickup_datetime'] ?>">
            <span class="feedtext"><?php echo $item['pickup_datetime'] ?><br> Order ID: <b><?php echo $item['order_id'] ?></b> has been dispatched for delivery.</span>
          </li>
          <?php endforeach; ?>
          <div class = "feeds_end">
            <li><a href="index-alerts.php">See all alerts</a></li>
          </div>
        </ul>
        <div class="loading">
          <img src="images/loading_transparent.gif"  alt=""/>
        </div>
      </div>
    </div>
  </div>
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