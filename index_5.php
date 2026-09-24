<?php 
include "config/dbconfig.php";
?>
<style>

*,:before,:after{
-moz-box-sizing:border-box;
-webkit-box-sizing:border-box;
box-sizing:border-box;
}

h1 {
  text-align: center;
  line-height: 20px;
  color: rgba(0,0,0,.8);
}

.social-container-wrap {width:100%;height:600px;margin:auto;background:#ffffff;padding:50px 0;-webkit-transition: all .2s ease-out;
-moz-transition: all .2s ease-out;
-ms-transition: all .2s ease-out;
-o-transition: all .2s ease-out;
transition: all .2s ease-out;}
        .social-container {
            margin: 0 auto;
            width: 645px;
            height: 500px;
            padding-left: 30px;
            -webkit-transition: all .2s ease-in;
            -moz-transition: all .2s ease-in;
            -ms-transition: all .2s ease-in;
            -o-transition: all .2s ease-in;
            transition: all .2s ease-in;
            text-align: center;
            -webkit-transition: -webkit-transform .7s;
            -moz-transition: -moz-transform .7s;
            -ms-transition: -ms-transform .7s;
            -o-transition: -o-transform .7s;
            transition: transform .7s;
            
        }


/* Button Styles */
.social-container a {
display: block;
position:relative;
	height: 8em;
	width: 8em;
    line-height: 8em;
    float:left;
	margin-right:20px;
	margin-top:20px;
	text-align: center;    
    border: 1px solid rgba(255,255,255,.3);
    color: rgba(255,255,255,.6);
                -webkit-transition: -webkit-transform .7s;
	-moz-transition: -moz-transform .7s;
	-ms-transition: -ms-transform .7s;
	-o-transition: -o-transform .7s;
	transition: transform .7s;
	
	
	
}
.social-container .twitter{color: #ffffffz;border-color: #f1f0f0;background-color: #ffffff;}
.social-container .facebook{color: #ffffff;border-color: black;background-color: black;}
.social-container .googleplus{color: #ffffff;border-color:black;background-color: black;}
.social-container .pinterest{color: #ffffff;border-color: black;background-color: black;}
.social-container .codepen{color: #ffffff;border-color:black;background-color: black;}
.social-container .dribbble{color: #ffffff;border-color: black;background-color:black;}
.social-container .instagram{color: #ffffff;border-color:black;background-color: black;}
.social-container .linkedin{color: #ffffff;border-color: black;background-color: black;}
.social-container .envelope{color: #ffffff;border-color: black;background-color: black;}
.social-container .recruitment{color: #ffffff;border-color: black;background-color: black;}
.social-container .ecourts{color: #ffffff;border-color: black;background-color: black;}
.social-container .sitting{color: #ffffff;border-color: black;background-color: black;}
.social-container .visitor{color: #ffffff;border-color:black;background-color: black;}

.social-container a i {
//-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	//transform: rotate(-45deg);
	font-size:40px;
}

.social-container a:hover  {
    background:transparent;
    border: 1px solid black;
    color: black;
  -webkit-transform: scale(1.3,1.3);
	-moz-transform: scale(1.3,1.3);
  -ms-transform: scale(1.3,1.3);
	-o-transform: scale(1.3,1.3);
  transform: scale(1.3,1.3) ;
}
.social-container .codepen:hover {color:rgba(0,0,0,.8);border-color:rgba(0,0,0,.8);}
/* Hover background colors */
.color-twitter {background-color: #00aced !important;}
.color-facebook {background-color: #3b5998 !important;}
.color-pinterest {background-color: #cc2127 !important;}
.color-googleplus {background-color: #dd4b39 !important;}
.color-codepen{background-color:rgba(255,255,255,1) !important;}
.color-dribbble {background-color: #ea4c89 !important;}
.color-instagram {background-color: #5c3d2e !important;}
.color-linkedin{background-color:#007fb1 !important;}
.color-envelope{background-color:#aaca62 !important;}


        .color-twitter,.color-facebook,.color-pinterest,.color-googleplus,.color-dribbble,.color-instagram {
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }
		.title{
			position: absolute;
    margin-left: -60px;
    padding-top: 21px;
   
		}
@media only screen and (max-width: 600px) {
  .social-container {
            margin: 0 auto;
             width: 376px;
            height: 260px;
            padding-left: 30px;
            -webkit-transition: all .2s ease-in;
            -moz-transition: all .2s ease-in;
            -ms-transition: all .2s ease-in;
            -o-transition: all .2s ease-in;
            transition: all .2s ease-in;
            text-align: center;
            -webkit-transition: -webkit-transform .7s;
            -moz-transition: -moz-transform .7s;
            -ms-transition: -ms-transform .7s;
            -o-transition: -o-transform .7s;
            transition: transform .7s;
            
        }
		.social-container a {
display: block;
position:relative;
	height: 4em;
	width: 4em;
    line-height: 4em;
    float:left;
	margin-right:20px;
	margin-top:20px;
	text-align: center;    
    border: 1px solid rgba(255,255,255,.3);
    color: rgba(255,255,255,.6);
                -webkit-transition: -webkit-transform .7s;
	-moz-transition: -moz-transform .7s;
	-ms-transition: -ms-transform .7s;
	-o-transition: -o-transform .7s;
	transition: transform .7s;
}
.social-container .twitter{color: #ffffff;border-color: black;background-color: black;}
.social-container .facebook{color: #ffffff;border-color: black;background-color: black;}
.social-container .googleplus{color: #ffffff;border-color:black;background-color: black;}
.social-container .pinterest{color: #ffffff;border-color: black;background-color: black;}
.social-container .codepen{color: #ffffff;border-color:black;background-color: black;}
.social-container .dribbble{color: #ffffff;border-color: black;background-color:black;}
.social-container .instagram{color: #ffffff;border-color:black;background-color: black;}
.social-container .linkedin{color: #ffffff;border-color: black;background-color: black;}
.social-container .envelope{color: #ffffff;border-color: black;background-color: black;}
.social-container .recruitment{color: #ffffff;border-color: black;background-color: black;}
.social-container .ecourts{color: #ffffff;border-color: black;background-color: black;}
.social-container .sitting{color: #ffffff;border-color: black;background-color: black;}
.social-container .visitor{color: #ffffff;border-color:black;background-color: black;}
.social-container a i {
//-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	//transform: rotate(-45deg);
	font-size:20px;
}
.social-container a:hover  {
    background:transparent;
    border: 1px solid black;
    color: black;
  -webkit-transform: scale(1.3,1.3);
	-moz-transform: scale(1.3,1.3);
  -ms-transform: scale(1.3,1.3);
	-o-transform: scale(1.3,1.3);
  transform: scale(1.3,1.3) ;
}
.social-container .codepen:hover {color:rgba(0,0,0,.8);border-color:rgba(0,0,0,.8);}
/* Hover background colors */
.color-twitter {background-color: #00aced !important;}
.color-facebook {background-color: #3b5998 !important;}
.color-pinterest {background-color: #cc2127 !important;}
.color-googleplus {background-color: #dd4b39 !important;}
.color-codepen{background-color:rgba(255,255,255,1) !important;}
.color-dribbble {background-color: #ea4c89 !important;}
.color-instagram {background-color: #5c3d2e !important;}
.color-linkedin{background-color:#007fb1 !important;}
.color-envelope{background-color:#aaca62 !important;}

.title {
    position: absolute;
    margin-left: -31px;
    padding-top: 21px;
    font-size: 11px;
}
</style>
	<div class="page-title pad group">

			<h2>&nbsp;&nbsp;Welcome to Madras High Court</h2>

	
</div><!--/.page-title-->
	<div class="pad group">
		
		

	<div class="featured flexslider" id="flexslider-featured">
		<ul class="slides">
		<?php 
		$qry = $DB_con->query("select slider_id from mhc_sliders where slider_display='Y' order by slider_order asc");
		while($row = $qry->fetch())
		{
		?>
				<li>
					<article id="post-3810" class="group post-3810 post type-post status-publish format-image has-post-thumbnail hentry category-travel post_format-post-format-image">	
						<div class="post-inner post-hover">		
							<div class="post-thumbnail">
								<a href="index.php">
									<img width="720" height="340" title="Madras High Court" src="admin/view_image.php?img_id=<?php echo$row['slider_id'];?>&page=S"/>
								</a>							
							</div><!--/.post-thumbnail-->
						</div><!--/.post-thumbnail-->
					</article><!--/.post-->
				</li>
				
		<?php
		}
		?>						
		</ul>
	</div><!--/.featured-->

		
					
						<div class="post-list group">
				<div class="post-row">						
				
				  <div class="social-container-wrap">
       
        <div class="social-container">
            <a href="present_judges.php?page_id=2" class="twitter"><i class="fa fa fa-group"></i><span class="title">Present Judges</span></a>
            <a href="cause_list_mhc.php?page_id=3" class="facebook"><i class="fa fa-newspaper-o"></i><span class="title">Cause List</span></a>
            <a href="case_status_mas.php?page_id=7" class="googleplus"><i class="fa fa-balance-scale"></i><span class="title">Case Status</span></a>
			
            <a href="cause_judment_mas.php?page_id=10" class="pinterest"><i class="fa fa-gavel"></i><span class="title">Judgement</span></a>
            <a href="display_board_mhc.php?page_id=12" class="codepen"><i class="fa fa-tv"></i><span class="title">Display Board</span></a>
            <a href="https://efiling.ecourts.gov.in/" class="dribbble"><i class="fa fa-fax"></i><span class="title">e-Filing</span></a>
            <a href="vc_mas.php?page_id=32" class="instagram"><i class="fa fa-video-camera"></i><span class="title">Virtual Courts</span></a>
            <a href="registrars.php?page_id=8" class="linkedin"><i class="fa fa-user-secret"></i><span class="title">Administration</span></a>
            <a href="https://www.mhc.tn.gov.in/recruitment/login" class="recruitment"><i class="fa fa-graduation-cap"></i><span class="title">Recruitment</span>
			</a>
			 <a href="https://ecourts.gov.in/ecourts_home/" class="ecourts"><i class="fa fa-cogs"></i><span class="title">e-Court Services</span>
			 </a> <a href="https://ecommitteesci.gov.in/" class="sitting"><i class="fa fa-compass"></i><span class="title">e-Committee</span></a> 
			 <a href="https://www.mhc.tn.gov.in/eservices/hcvcpass/" class="visitor"><i class="fa fa-address-card-o"></i><span class="title">e-Visitor Pass</span></a>
            
        </div>
    </div>
				</div><!--/.post-list-->
						
			</div><!--/.pagination-->
			
				
	</div><!--/.pad-->
<script type='text/javascript' src='wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
<script type='text/javascript' src='wp-content/themes/kontrast/js/jquery.flexslider.min9dff.js?ver=5.3.2'></script>
	<script type='text/javascript'>

			jQuery(document).ready(function(){
				var firstImage = jQuery("#flexslider-featured").find("img").filter(":first"),
				   checkforloaded = setInterval(function() {
					   var image = firstImage.get(0);
					   /* if (image.complete || image.readyState == "complete" || image.readyState == 4) { */
						   clearInterval(checkforloaded);
						   jQuery("#flexslider-featured").flexslider({
							   animation: "slide",
								useCSS: false, // Fix iPad flickering issue
								directionNav: true,
								controlNav: true,
								pauseOnHover: true,
								animationSpeed: 400,
								smoothHeight: true,
								touch: false,
								slideshow: true,
								slideshowSpeed: 7000,
						   });
					   /* } */
				   }, 20);
				   
				   
				   
			   });
			
</script>