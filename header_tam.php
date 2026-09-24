<?php 
header("cache-control: no-cache, no-store, must-revalidate");  
header("pragma: no-cache");
header('expires: 0');
header('Content-Type:text/html; charset=UTF-8');

header('X-Frame-Options: SAMEORIGIN'); 
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
/* header("Content-Security-Policy: default-src 'self';script-src 'self';script-src 'self'; style-src 'self';img-src 'self';frame-src 'self' ;"); */
header("Content-Security-Policy:".
        "connect-src 'self' ;". // XMLHttpRequest (AJAX request), WebSocket or EventSource.
        // "default-src 'self' data:  'unsafe-hashes' 'unsafe-eval'".// Default policy for loading html elements
        "frame-ancestors 'self' ;". //allow parent framing - this one blocks click jacking and ui redress
      // "frame-src 'self';". // vaid sources for frames // vaid sources for frames
        "media-src 'self' *.example.com;". // vaid sources for media (audio and video html tags src)
        "object-src 'none'; ". // valid object embed and applet tags src
        "report-uri data: 'unsafe-inline' 'unsafe-hashes' 'unsafe-eval'". //A URL that will get raw json data in post that lets you know what was violated and blocked
        "script-src 'self' 'unsafe-inline' https://ssl.google-analytics.com/ga.js ;". // allows js from self, jquery and google analytics.  Inline allows inline js
        "style-src 'self' 'unsafe-inline';");
ini_set( 'session.cookie_httponly', 1 );
ini_set( 'session.cookie_httponly', 1 );
//ini_set ('session.use_trans_sid',0);
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
ini_set('docref_root', '0');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
session_start();
include "config/dbconfig.php";

// Get current page URL 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
$currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; 
 
// Get server related info 
$user_ip_address = $_SERVER['REMOTE_ADDR']; 
$referrer_url = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/'; 
$user_agent = $_SERVER['HTTP_USER_AGENT']; 
 
// Insert visitor log into database 
$stmt = $DB_con->prepare("INSERT INTO visitor_logs (page_url, referrer_url, user_ip_address, user_agent) VALUES (:currentURL,:referrer_url,:user_ip_address,:user_agent)"); 
$stmt->bindparam(":currentURL", $currentURL);			
$stmt->bindparam(":referrer_url", $referrer_url);	 			
$stmt->bindparam(":user_ip_address", $user_ip_address);	 			
$stmt->bindparam(":user_agent", $user_agent);	 				 	
$stmt->execute(); 

/*if(isset($_GET['1a63c8004d716c8b91f5b7af780555b9']))
	 {
		$page_id=$_GET['1a63c8004d716c8b91f5b7af780555b9']; 
	 }
	else
	{*/
		$page_id='current_page_item'; 
	//}
?>
<!DOCTYPE html> 
<html lang="en">
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="title" content="Madras High Court, Home Page" />
<meta name="language" content="english" />
<meta name="keyword" content="Madras High Court, APEX Court of Tamil Nadu and Pondicherry, Official Website of Madras High Court, Official Website of MHC, Cause Lists, Case Status, Judgments, Interim Orders, Daily Orders, Chief Justice, Judges, Display Boards, Transfers and anntions, Indian Judiciary, Indian District Courts, Tamil Nadu Courts, Puducherry Courts" />
<meta name="description" content="Find information related to Cause Lists, Judgments, Daily Orders, Notifications and  Announcements of Madras High Court" />
<meta name="author" content="Madras High Court">
<meta name="robots" content="index, follow">
	<link rel="icon"  href="images/favicon.ico.bmp"/>
	<title>Madras High Court</title>
	

		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
#toggle_id
{
	margin-right: 100px;
}
@media only screen and (max-width: 719px)
{
#toggle_id1
{
	    margin-left: 171px;
}
}

</style>
	<link rel='stylesheet' id='wp-block-library-css'  href='wp-includes/css/dist/block-library/style.min9dff.css?ver=5.3.2' type='text/css' media='all' />
<link rel='stylesheet' id='kontrast-style-css'  href='wp-content/themes/kontrast/style9dff.css?ver=5.3.2' type='text/css' media='all' />
 <link href="css/demo.css" rel="stylesheet" />

<style id='kontrast-style-inline-css' type='text/css'>
body { font-family: "Roboto Condensed", Arial, sans-serif; }

</style>
<link rel='stylesheet' id='kontrast-responsive-css'  href='wp-content/themes/kontrast/responsive9dff.css?ver=5.3.2' type='text/css' media='all' />
<link rel='stylesheet' id='kontrast-font-awesome-css'  href='wp-content/themes/kontrast/fonts/font-awesome.min9dff.css?ver=5.3.2' type='text/css' media='all' />
<link rel='stylesheet' id='roboto-condensed-css'  href='css/fonts1.css' type='text/css' media='all' />
<link rel='stylesheet' id='roboto-condensed-css'  href='css/ressponsiveDatatablenew.css' type='text/css' media='all' />
<!--<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/main.css">
	<link rel="alternate stylesheet" type="text/css" href="css/main_maroon.css" title="styles1" />
	<link rel="alternate stylesheet" type="text/css" href="css/main_green.css" title="styles2" />
	<link rel="alternate stylesheet" type="text/css" href="css/main_blue.css" title="styles3" />
	<link rel="alternate stylesheet" type="text/css" href="css/main_yellow.css" title="styles4" />-->
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">  
<script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.responsive.js"></script>
<script src="js/bootstrap.min.js"></script>


<script src="js/jquery-3.5.1.js" type="text/javascript"></script>
<script src="js/pdf.min.js"></script>
<script src="js/sweetalert2.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/core.js"></script>
<script src="js/demo.js"></script>
<script src="https://ssl.google-analytics.com/ga.js"></script>
<script src="js/right.js"></script>
<!--<script type='text/javascript' src='wp-includes/js/jquery/jquery4a5f.js?ver=1.12.4-wp'></script>-->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="" />
<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style><style id="kirki-inline-styles"></style></head>

<body class="home blog wp-custom-logo col-3cm full-width topbar-enabled">

<div id="wrapper">

	<header id="header">
		
				
					<nav class="nav-container group" id="nav-topbar">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container">
		<ul id="menu-topbar" class="nav container-inner group">
		<li id="menu-item-4000" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4000">
		<a href="index.php" tabindex="0" alt="Home" >Home</a></li>
<li id="menu-item-4048" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4048"><a  href="screenreaderac.php" alt="Screen readers access" >Screen readers access</a>

</li>

<li id="menu-item-3999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3999">
<a class="small" title="font increase icon" style="color:#333; text-decoration: none;" href="#" onclick="font_incr()" >A<sup>+</sup></a>
</li>

<li id="menu-item-3999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3999">
<a class="small" style="color:#333; text-decoration: none;" href="#" onclick="font_decr()" title="font decrease icon">A<sup>-</sup></a> 
</li>

<li id="menu-item-3999" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3999">
<a class="small" style="color:#333; text-decoration: none;" href="#" onclick="font_default()" title="font none icon">A<sup></sup></a> 
</li>





</ul>

</div>
				
									<div class="container">
									
						<div class="container-inner">	
						
						    <div class="toggle-search" id="toggle_id">
							
							  <div id="colorpicker" >
								<a id="default" rel="default" href="#"  class="styleswitch" title="Default Theme" ><img src="images/theme_default.jpg" alt="Default Theme" ></a>&nbsp;&nbsp;&nbsp;
								<a id="blue" href="#" rel="styles3"  class="styleswitch"title="Blue Theme" ><img src="images/theme_blue.jpg" alt="Blue Theme" ></a>&nbsp;&nbsp;&nbsp;
								<a id="orange" href="#" rel="styles1" class="styleswitch"title="Orange Theme"><img src="images/theme_orange.jpg" alt="Orange Theme" ></a>&nbsp;&nbsp;&nbsp;
								<a id="green" rel="styles4" href="#"  class="styleswitch"title="Green Theme"><img src="images/theme_green.jpg" alt="Green Theme" ></a>&nbsp;&nbsp;&nbsp;
								<!--<a id="darkblue" rel="styles2" href="#"  class="styleswitch"><img src="assets/images/theme_darkblue.jpg" alt="" title=""></a>&nbsp;&nbsp;&nbsp;-->
								<a id="yellow" rel="styles2" href="#"  class="styleswitch" title="Yellow Theme"><img src="images/theme_yellow.jpg" alt="Yellow Theme" ></a>
								&nbsp;&nbsp;&nbsp;
								<a id="black" rel="styles5" href="#" title="Blind Black Theme" class="styleswitch"><img src="images/theme_black.jpg" alt="Blind Blck Theme" ></a>
							</div>
							</div>
						
							<div class="toggle-search" id="toggle_id1"><font size="2px">Search&nbsp;&nbsp;</font><i class="fa fa-search"></i></div>
							<div class="search-expand">
								<div class="search-expand-inner">
									<form method="post" class="searchform themeform" action="search.php">
	    <div>	
		<input type="text"  title="To search type and hit enter" class="search" name="search" id="Search"  placeholder="To search type and hit enter" />
		<input type="image" src="images/search.jpg" class="foot_search" alt="Submit" style="width: 30px;">
		</div>	
	
	</form>	
                                 </div>
							</div>
						</div><!--/.container-inner-->
						
					</div><!--/.container-->
								
			</nav><!--/#nav-topbar-->
				
				
		<div class="container-inner group">
			
							<div class="group pad">
					<h1 class="site-title"><a href="index.php" rel="home" title="Home Pages"><img src="wp-content/uploads/sites/6/2019/03/logo2.png"  title="Madras High Court" alt="MHC"></a></h1>
											<p class="site-description"></p>
																<ul class="social-links">
																<!--<li><a rel="nofollow" class="social-tooltip" title="Log In" href="admin/index.php" >Log In<i class="fa fa-sign-in" ></i></a></li>-->																
																<li><a href="index.php"  class="social-tooltip" title="home page" role="button" alt="MHC page" ><i class="fa fa-home" ></i></a></li>																
																<li><a rel="nofollow" class="social-tooltip" title="TelePhone" href="telephone.php" ><i class="fa fa-phone" ></i></a></li>																
																<li><a rel="nofollow" class="social-tooltip" title="Calendar" href="calendar.php" ><i class="fa fa-calendar" ></i></a></li>
																<li><a rel="nofollow" class="social-tooltip" title="Contact Us" href="contact.php" ><i class="fa fa-address-book" ></i></a></li>
																</ul>									</div>
						
			
							<nav class="nav-container group" id="nav-header">
					<div class="nav-toggle"><i class="fa fa-bars"></i></div>
					<div class="nav-text"><!-- put your mobile menu text here --></div>
					<div class="nav-wrap container">
					
					<?php include 'menu.php'; ?>
					
					
					</div>
			</div>
				</nav><!--/#nav-header https://codepen.io/kvana/pen/ZbENqr-->
						
							<nav class="nav-container group" id="nav-subheader">
					<div class="nav-toggle"><i class="fa fa-bars"></i></div>
					<div class="nav-text"><!-- put your mobile menu text here --></div>
					<div class="nav-wrap container">
					
					<?php include 'menu_s.php'; ?>
					<!--<li id="menu-item-4034" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4034"><a href="#">Registrars</a>
<ul class="sub-menu">
	<li id="menu-item-4049" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4049"><a href="registrars.php">Principal Seat</a></li>
	<li id="menu-item-4047" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4047">
	<a href="#">Madruai Bench</a></li>
	<li id="menu-item-4047" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4047">
	<a href="reg_entry.php">Add</a></li>
	<li id="menu-item-4047" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4047">
	<a href="#">Modify</a></li>
	<li id="menu-item-4047" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4047">
	<a href="reg_delete.php">Transfer / Releived</a></li>
	<li id="menu-item-4047" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4047">
	<a href="reg_desig_add.php">Add Designation</a></li></ul>
</li>
	<li id="menu-item-4036" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4036"><a href="rules.php">Judicial Officers</a></li>			


<li id="menu-item-4057" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4057"><a target="_blank" href="https://ecourts.gov.in/ecourts_home/">e-Court Services</a>

</li>

<li id="menu-item-4057" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4057"><a href="https://www.mhc.tn.gov.in/recruitment/login" target="_blank">Recruitment</a>

</li>-->
</div>
				</nav><!--/#nav-subheader-->
						
		</div><!--/.container-->
		
	</header><!--/#header-->
	
	
	
	</div><!--/#wrapper-->

<script type='text/javascript' src='wp-content/themes/kontrast/js/jquery.fitvids9dff.js?ver=5.3.2'></script>
<script type='text/javascript' src='wp-content/themes/kontrast/js/scripts9dff.js?ver=5.3.2'></script>

<script type='text/javascript' src='wp-includes/js/wp-embed.min9dff.js?ver=5.3.2'></script>
<script type='text/javascript' src='js/pageload.js'></script>

<!-- COLOR CHANGE SCRIPTS-->
<script src="js/styleswitch.js"></script>
<link rel="alternate stylesheet" type="text/css" href="css/main_maroon.css" title="styles1" />
<link rel="alternate stylesheet" type="text/css" href="css/main_green.css" title="styles2" />
<link rel="alternate stylesheet" type="text/css" href="css/main_blue.css" title="styles3" />
<link rel="alternate stylesheet" type="text/css" href="css/main_yellow.css" title="styles4" />
<link rel="alternate stylesheet" type="text/css" href="css/main_black.css" title="styles5" />



</body>

<!-- Mirrored from demo.alx.media/kontrast/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Jan 2020 07:43:13 GMT -->
</html>