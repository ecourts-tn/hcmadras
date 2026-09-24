	<footer id="footer">

		
		
				<div class="container dark" id="footer-widgets">
			<div class="container-inner">

				<div class="pad group">
				
				<div class="footer-widget-2 grid one-third ">
								<div id="recent-posts-4" class="">				<ul>
											<li>
					
					<img src="images/m1.jpg" alt="50 Years of Celebration" class="attachment-alx-small size-alx-small wp-post-image"  width="170" height="100">
									</li><br>
										<li>
					<a href="#"  title="Government of India" onclick='swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {

	window.open(
  "https://www.india.gov.in/",
  "_blank" 
);
}});' >
					<img src="images/nic.jpg" alt="Government of India"  class="attachment-alx-small size-alx-small wp-post-image" ></a>
									</li><br>
<li>
					<a href="#"  title="Government of Tamil Nadu"  onclick='swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {

	window.open(
  "https://www.tn.gov.in/",
  "_blank" 
);
}});' >
					<img src="images/tn_gov_logo.gif" alt="Government of Tamil Nadu"  class="attachment-alx-small size-alx-small wp-post-image"  ></a>
									</li>									
					</ul>
		</div>					</div> 
											
					<div class="footer-widget-1 grid one-third ">
						<div id="recent-comments-4" class="widget widget_recent_comments">
						<h3 class="group"><span>Related Links</span></h3>
						<ul id="">
						<?php
							 $qry = $DB_con->query("SELECT * FROM mhc_menu WHERE menu='R' AND set_menu='FM' and display='Y' ORDER BY main_menu_order ASC");
while($row = $qry->fetch())
{
	if($row['menu_tab']=='Y')
	{
	$tab='target="_blank" ';
		$onclick_val='onclick';
		$at='swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {

	window.open(
  "https://www.tn.gov.in/",
  "_blank" 
);
}});';
		$alt='="'.$at.'"';
	}
	else
	{
		$tab='';
		$alt='';
		$onclick_val='';
	}
	
if($row['menu_tab']=='Y'&&$row['external']=='Y')
	{			
			?>
			
	<li class=""><i class="fa fa-link"></i>&nbsp;<a href="#" onclick='swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {

	window.open(
  "<?php echo $row['page_url'];?>",
  "_blank" 
);
}});' alt="<?php echo $row['page_name'];?>"><?php echo $row['page_name'];?></a></li>
						<?php
	}
	else if($row['menu_tab']=='Y'&&$row['external']=='N')
	{
		?>
	<li class=""><i class="fa fa-link"></i>&nbsp;<a href="<?php echo $row['page_url'];?>" 
	alt="<?php echo $row['page_name'];?>" target="_blank"><?php echo $row['page_name'];?></a></li>	
	<?php
	}
	else
	{
		?>
	<li class=""><i class="fa fa-link"></i>&nbsp;<a href="<?php echo $row['page_url'];?>" 
	alt="<?php echo $row['page_name'];?>"><?php echo $row['page_name'];?></a></li>	
		<?php
	}
}
?>
						<!--<li class=""><i class="fa fa-link"></i>&nbsp;<a href="http://www.tnlegalservices.tn.gov.in/" target="_blank">Tamil Nadu Legal Services</a></li>
						<li class=""><i class="fa fa-link"></i>&nbsp;<a href="https://www.sci.gov.in/" target="_blank">Supreme Court of India</a></li>
						<li class=""><i class="fa fa-link"></i>&nbsp;<a href="http://indiancourts.nic.in/" target="_blank">Indian Courts</a></li>
						<li class=""><i class="fa fa-link"></i>&nbsp;<a href="#" target="_blank">Other Important Links</a></li>-->
						</ul>
						</div>					
						</div>

																	


																	
					<div class="footer-widget-3 grid one-third last">
					
						<div id="search-4" class="widget widget_search"><h3 class="group"><span><label for="Search">Search</label></span></h3>
<form method="post" class="searchform themeform" action="search.php">
	    <div>	
		<input type="text"  title="To search type and hit enter" class="search" name="search" id="Search"  placeholder="To search type and hit enter" />
		<input type="image" src="images/search.jpg" class="foot_search" alt="Submit">
		</div>	
	
	</form>	
	
	</div>	
	<div id="recent-comments-4" class="widget widget_recent_comments">
	<ul>
		<?php
							 $qry4 = $DB_con->query("SELECT doc_id,doc_title FROM mhc_document WHERE doc_show_page='B' ORDER BY doc_f_date DESC LIMIT 1");
if($row4 = $qry4->fetch())
{
	?>
	<li class=""><i class=""></i>&nbsp;<a href="footer_bribe.php" style="font-size: 20px;"  ><?php echo $row4['doc_title'];  ?></a></li>

		<?php
}
							 $qry3 = $DB_con->query("SELECT create_modify FROM user_logs ORDER BY create_modify DESC");
if($row3 = $qry3->fetch())
{
	$date=date('d-m-Y',strtotime($row3['create_modify']))
	
						?>
	<li class="" style="font-size: 20px;">&nbsp;Last Updated on <?php echo $date; ?></li>
	<?php
}
?>
	</ul>
	</div>
			</div>

															</div><!--/.pad-->

			</div><!--/.container-inner-->
		</div><!--/.container-->
		
					<nav class="nav-container group" id="nav-footer">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap"><ul id="menu-footer-1" class="nav container group">
				<?php
							 $qry1 = $DB_con->query("SELECT * FROM mhc_menu WHERE menu='F' AND set_menu='FM' and display='Y' ORDER BY main_menu_order ASC");
while($row1 = $qry1->fetch())
{
	if($row1['menu_tab']=='Y')
	{
	$tab1='target="_blank" ';
		$onclick_val1='onclick';
		$at1="alert('External Website that opens in a new window')";
		$alt1='="'.$at1.'"';
	}
	else
	{
		$tab1='';
		$alt1='';
		$onclick_val1='';
	}
	
	
						?>
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4051"><a <?php echo $tab1 ?>  href="<?php echo $row1['page_url'];?>" > <?php echo $row1['page_name'];?></a></li>
				<?php
}
				?>
<!--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4059"><a href="#">Downloads</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4052"><a href="faq.php">FAQs</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4066"><a href="termcond.php">Terms and Conditions</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4067"><a href="webpolicy.php">Website Policies</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4057"><a href="sitemap.php">Site Map</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4058"><a href="help.php">Help</a></li>

<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-4062"><a href="contact.php">Contact Us</a>-->
<!--
<ul class="sub-menu">
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4060"><a href="#">Typography</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4061"><a href="#">Tables</a></li>
</ul>-->
</li>
</ul></div>
			</nav><!--/#nav-footer-->
		
		<div class="container" id="footer-bottom">
			<div class="container-inner">

			

				<div class="pad group">

					<div class="grid one-half">

						<div id="copyright">
															<p>© Content Owned, Updated and Maintained by Madras High Court.<br>
For any query regarding this website,<br> Please Contact the Web Information Manager:
The Registrar (IT-cum-Statistics) <br> Email : cpc-tn(at)indianjudiciary(dot)gov(dot)in</p>
													</div><!--/#copyright-->

												<div id="credit">
							<p>Designed & <a href="#" rel="nofollow">Developed </a>by <a href="#" rel="nofollow">Madras High Court</a>.</p>
						</div><!--/#credit-->
						
					</div>

					<div class="grid one-half last">
													<ul class="social-links">
																<!--<li><a rel="nofollow" class="social-tooltip" title="Log In" href="login.php" >Log In<i class="fa fa-sign-in" ></i></a></li>-->																
																<li><a rel="nofollow" class="social-tooltip" title="Home" href="index.php" ><i class="fa fa-home" ></i></a></li>																
																<li><a rel="nofollow" class="social-tooltip" title="TelePhone" href="telephone.php" ><i class="fa fa-phone" ></i></a></li>																
																<li><a rel="nofollow" class="social-tooltip" title="Calendar" href="calendar.php" ><i class="fa fa-calendar" ></i></a></li>
																<li><a rel="nofollow" class="social-tooltip" title="Contact Us" href="contact.php" ><i class="fa fa-address-book" ></i></a></li>
																</ul>												</div>

				</div><!--/.pad-->

			</div><!--/.container-inner-->
		</div><!--/.container-->

	</footer><!--/#footer-->
	
<script>
$(document).ready( function () {
	demo.showSwal();
 $('#example').DataTable({
		"ordering":false,
		pagingType: 'simple',
	});
	$('#example2').DataTable({
		"ordering":false,
		pagingType: 'simple',
	});
	$('#table_id1').DataTable({
		"ordering":false,
		pagingType: 'simple',
	});
	
	
	document.getElementsByClassName.onclick = function () 
	{
		/* swal({
  title: "Ajax request example",
  text: "Submit to run ajax request",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
    window.location = "https://www.tn.gov.in/";
  }, 2000);
}); */
		swal({
    title: "Alert",
    text: "External Website that opens in a new window",
    type: "info"
}).then((isOkay)=>{if (isOkay) {
    //window.location = "https://www.tn.gov.in/";
	window.open(
  'https://www.tn.gov.in/',
  '_blank' // <- This is what makes it open in a new window.
);
}});
	}
	
} );


$('li>a').keydown(function(e) {
  if (e.which == 9) {
    //Get the submenu
    var subMenu = $(this).next('ul');
    subMenu.addClass('open');
    //Check if you're on the last subchild and close the menu
    if ($(this).parent('li').is(':last-child:not(".menu>li>a")')) {
      $(this).parent('li').parent('.open').removeClass('open')
    }
  }
});

</script>
	