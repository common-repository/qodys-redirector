<?php
ob_start();
require_once( dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))).'/wp-load.php' );
ob_end_clean();

$post_id = $_GET['post_id'];

// global settings
$redirect_url 			= $qodys_redirector->get_option( 'redirect_url' );
$redirect_home 			= $qodys_redirector->get_option( 'redirect_home' );
$redirect_delay 		= $qodys_redirector->get_option( 'redirect_delay' );
$redirect_again 		= $qodys_redirector->get_option( 'redirect_again' );
//$redirect_detection 	= $qodys_redirector->get_option( 'redirect_detection' );
$mouse_direction 		= $qodys_redirector->get_option( 'mouse_direction' );

$redirect_padding 		= $qodys_redirector->get_option( 'redirect_padding' );
$redirect_left_margin 	= $qodys_redirector->get_option( 'redirect_left_margin' );
$redirect_right_margin 	= $qodys_redirector->get_option( 'redirect_right_margin' );

$ignore_specifics 		= $qodys_redirector->get_option( 'ignore_specifics' );


// If it's a blog page
if( $post_id && $post_id != -1 )
{
	$custom = $qodys_redirector->get_post_custom( $post_id );
	
	$post_redirect_url = html_entity_decode( $custom['redirect_url'] );
	
	if( $post_redirect_url && $ignore_specifics != 'yes' )
		$redirect_url = $post_redirect_url;
	
	/*if( isset( $custom['redirect_again'][0] ) )
		$redirect_again = $custom['redirect_again'][0];*/
	
	if( isset( $custom['redirect_delay'] ) && $ignore_specifics != 'yes' )
		$redirect_delay = $custom['redirect_delay'];
}
else // If it's the home / front page
{
	if( $redirect_home )
		$redirect_url = $redirect_home;
}

// fail-safe default settings
if( !$redirect_delay )
	$redirect_delay = 0;

if( !$redirect_detection )
	$redirect_detection = 1;

if( !$redirect_padding )
	$redirect_padding = 15;

//if( !$redirect_again )
//	$redirect_again = 1;

if( !$redirect_left_margin )
	$redirect_left_margin = 0;

if( !$redirect_right_margin )
	$redirect_right_margin = 0;

if( !$mouse_direction )
	$mouse_direction = 'up';


$redirect_padding += 1; // compensate for mouse at 0 not being detectable off-screen

function qody_javascriptLine($input) {
   $input = preg_replace("/'/", "\'", $input); // Escape slashes
   $lines = preg_split("/[\r\n]+/si", $input);    // Separate into each line
   $lines = implode("", $lines); // Turn back into a string

   return $lines;
}

?>
<?php ob_start(); ?>
<?php header("Content-type:text/javascript"); ?>
var oldBody = document.body.innerHTML;
<?php
$host = $_SERVER["HTTP_HOST"];
$refer = $_SERVER["HTTP_REFERER"];

?>
function show()
{
	if( !Cookie.get("already_went") <?php if( $redirect_again == '1' ) echo '|| 1 == 1'; ?> )
    {
		var url = '<?php echo $redirect_url; ?>';
		var post_id = '<?php echo $post_id; ?>';
		StoreInDatabase( url,post_id );
		Cookie.set("already_went", 'yes');
    }
}

function StoreInDatabase( url,post_id )
{
	var url = '<?php echo $redirect_url; ?>';
	//var delay = ;
	
	setTimeout(function(){
		window.location = url;
		//window.open( url );
	}, 50 );
		
	var queryString = "redirect_url=<?php echo urlencode($redirect_url); ?>&post_id=" + post_id;
	
	jQuery.ajax({
		type	: 	"GET",
		url		: 	"<?php echo $qodys_redirector->GetAsset( 'ajax', 'log_redirect', 'url' ); ?>",
		data	: 	queryString,
	});
}

var Cookie = {

	set : function(name, value, days)
	{
		if( days == undefined )
		{
			days = 30;
		}
	
		var date = new Date();
		date.setTime(date.getTime() + (days * 86400000));
	
		document.cookie = name + "=" + value + "; expires=" + date.toGMTString() + "; path=/";
	},
	
	get : function(name)
	{
		var results = document.cookie.match(
			new RegExp("(?:^|; )" + name + "=" + "(.*?)(?:$|;)")
		);
	
		if (results && results.length > 1) return results[1];
			return undefined;
	},
	
	clear : function(name)
	{
		setCookie(name, "", -1);
	}
};


var Move = {

   delay : 1,

   previousX : null,
   previousY : null,

   movements : new Array(),

   box : null,
   coast : true,

   initX : null,
   initY : null,

   realX : null,
   realY : null,

   isMoving : false,

   init : function(name) {
	  Move.reset();
      Move.box = document.getElementById(name);
      Move.find();
   },


   clear : function() {
      Move.onMoveEnd = null;

      document.onmousedown = null;
      document.onmouseup = null;
      document.onmousemove = Cursor.getCursor;

   },

   find : function() {

      if (Move.realX == null) {
         Move.realX = parseInt(Move.box.style.left);
         Move.initX = Move.realX;
      }
      if (Move.realY == null) {
         Move.realY = parseInt(Move.box.style.top);
         Move.initY = Move.realY;
      }
   },
   
   getVerticalScroll : function() {
      if (window.pageYOffset) return parseInt(window.pageYOffset);
      return document.body.scrollTop;
   },
   
   getHorizontalScroll : function() {
      if (window.pageXOffset) return parseInt(window.pageXOffset);
      return document.body.scrollLeft;
   },

   screenTop : function() {
      return Move.getVerticalScroll();
   },
   
   screenLeft : function() {
      return Move.getHorizontalScroll();
   },

};

var Cursor = {
   x : null,
   y : null,

   lastX : null,
   lastY : null,

   archive : function() {
	   Cursor.lastX = Cursor.x;
	   Cursor.lastY = Cursor.y;
   },

   getCursor : function(e) {
      var e = e ? e:event;

      if (e != undefined && e.pageX && e.pageY) {
		   Cursor.archive();
         Cursor.x = parseInt(e.pageX);
         Cursor.y = parseInt(e.pageY);
      }
      else if (e && e.clientX && e.clientY) {
         Cursor.archive();
         Cursor.x = parseInt(e.clientX + document.body.scrollLeft);
         Cursor.y = parseInt(e.clientY + document.body.scrollTop);
      }
   }
};

function GetWindowWidth()
{
	if (document.body && document.body.offsetWidth) {
	 winW = document.body.offsetWidth;
	 winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' &&
		document.documentElement &&
		document.documentElement.offsetWidth ) {
	 winW = document.documentElement.offsetWidth;
	 winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	
	return winW;
}

function handleMove(mouseEvent) {
   Cursor.getCursor(mouseEvent);
   
   var distanceFromTop = Cursor.y - Move.screenTop();
   var distanceFromLeft = Cursor.x - Move.screenLeft();
   
   var windowWidth = GetWindowWidth();
   
   //alert( "Width: " + windowWidth );
   
   	<?php
	if( $mouse_direction == 'up' )
		$condition_Y = 'Cursor.y < Cursor.lastY && ';
	else if( $mouse_direction == 'down' )
		$condition_Y = 'Cursor.y > Cursor.lastY && ';
	else
		$condition_Y = '';
	?>
	
	<?php
	if( $redirect_left_margin > 0 )
		$condition_x .= 'Cursor.x > '.$redirect_left_margin.' && ';
	
	if( $redirect_right_margin > 0 )
		$condition_x .= 'Cursor.x < (windowWidth - '.$redirect_right_margin.') && ';
	?>
	
	//alert( "From left: " + distanceFromLeft );
	
	if( <?php echo $condition_Y; ?> <?php echo $condition_x; ?> distanceFromTop <= <?php echo $redirect_padding; ?>) {
	  document.onmousemove = null;
	  show();
	}
}

setTimeout(function() {
	document.onmousemove = handleMove;
}, <?php echo $redirect_delay * 1000 + 50; ?>);
<?php
$buffer = ob_get_contents();
ob_end_clean();

echo $qodys_redirector->JavascriptCompress( $buffer );
?>