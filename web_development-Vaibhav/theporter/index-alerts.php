<?php
require('db.php');

$sql = "SELECT * FROM order_details WHERE now() > pickup_datetime ORDER BY pickup_datetime DESC";
$resource = mysqli_query($link, $sql);
$order_details = array();
while($row = mysqli_fetch_assoc($resource)){
	$order_details[] = $row;
}

?>
<html>
<head>
<title>:: Alerts ::</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>
	<script src="js/scroll-pagination.js" type="text/javascript"></script>
	<script src="js/slimScroll.js" type="text/javascript"></script>
	<link href="styles.css" rel="stylesheet" type="text/css" />
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
        'contentPage': 'index.php',
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
            'url' : 'index.php',
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

<body>
	<div class="main_container">
		<div class="feeds_container">
			<h3 class="feed_head">Alerts</h3>
			<div id="feeds" class="feeds">
				<ul>
					<?php foreach($order_details as $item): ?>
					<li id="<?php echo $item['pickup_datetime'] ?>">
						<span class="feedtext"><?php echo $item['pickup_datetime'] ?><br> Order ID: <b><?php echo $item['order_id'] ?></b> has been dispatched for delivery.</span>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="loading">
					<img src="images/loading_transparent.gif"  alt=""/>
				</div>
			</div>
		</div>
	</div>
</body>
</html>